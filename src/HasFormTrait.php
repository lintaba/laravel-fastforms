<?php


namespace Lintaba\Fastforms;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use function snake_case;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use function json_decode;

trait HasFormTrait
{
    abstract protected function getForm($id = null) : array;
    
    /**
     * @param Request   $request
     * @param array     $extraRules
     * @param int|Model $id
     *
     * @return array
     */
    protected function getValidInput(Request $request, array $extraRules = [], $id = null): array
    {
        if($id && $id instanceof Model){
            $id = $id->getKey();
        }
        $unchecked = ['action', '_token', '_method', 'item'];

        $form = $this->getForm($id);
        
        $subs = Arr::pluck($form, 'sub');
        $form = array_filter(array_merge($form, $subs), 'is_array');
        $form = array_filter($form, static function ($field) {
            return !($field['virtual'] ?? false) && !($field['disabled'] ?? false);
        });
    
        $rules = $this->makeFormRules( $form, $extraRules);
    
        $relevantModelKeys = array_filter(array_keys($rules), static function (string $key) {
            return ($key && false === Str::contains($key, '.'));
        });
        ///check stuff
        $requestData = $request->only($relevantModelKeys);
        
        
        if (isset($this->resource)) {
            $trans = array_combine(
                $relevantModelKeys,
                array_map(function ($k) {
                    return __(Str::singular($this->resource) . '.'.$k);
                }, $relevantModelKeys)
            );
        } else {
            $trans = array_combine($relevantModelKeys, array_map('__', $relevantModelKeys));
        }

        if (app()->has('debugbar')) {
            debugbar()->info($rules);
            debugbar()->info($form);
        }
        
        Validator::make($requestData, $rules, [], $trans)->validate();
        
        foreach ($form as $i=>$field) {
            if (($field['nullable'] ?? false) === true && (!isset($requestData[$field['field']]) || empty($requestData[$field['field']]))) {
                if (($field['type'] ?? null) === 'reference') {
                    $requestData[snake_case($field['field']).'_id'] = null;
                    unset($requestData[$field['field']]);
                } else {
                    $requestData[$field['field']] = null;
                }
            } elseif (($field['type'] ?? null) === 'reference' && isset($requestData[$field['field']])) {
                $requestData[snake_case($field['field']).'_id'] = $requestData[$field['field']];
                unset($requestData[$field['field']]);
            } elseif (($field['type'] ?? null) === 'boolean' && !isset($requestData[$field['field']])) {
                $requestData[$field['field']] = false;
            }
    
            
            if (
                isset($field['field'], $rules[$field['field']]) &&
                in_array('json', $rules[$field['field']], true) &&
                is_string(data_get($requestData, $field['field']))
            ) {
                data_set($requestData, $field['field'], json_decode(data_get($requestData, $field['field']), true));
            }
            
            if (($field['uncheckedWrite'] ?? false) || ($field['type'] ?? null) === 'reference') {
                $unchecked[] = $field['field'];
            }
        }
        
        if ($relevantModelKeys = array_diff(array_keys($request->all()), array_merge(array_keys($rules), $unchecked))) {
            session()->flash('notice', 'missing rules, therefore skipping: '.($this->resource ?? '').': '.implode(', ', $relevantModelKeys));
            Log::warning('missing rules, therefore skipping: '.($this->resource ?? '').': '.implode(', ', $relevantModelKeys));
            report(new \LogicException('missing rules: '.implode(', ', $relevantModelKeys)));
        }
        
        if (isset($this->resource) && app()->has($this->resource) && ($relevantModelKeys = array_diff(array_keys($request->all()), array_merge(app($this->resource)->getFillable(), $unchecked)))) {
            session()->flash('notice', 'missing writable keys on '.$this->resource.': '.implode(', ', $relevantModelKeys));
            Log::warning('missing writable keys on '.$this->resource.': '.implode(', ', $relevantModelKeys));
            report(new \LogicException('On model '.$this->resource.' following fields are not in `fillable`, and their form fields arent `uncheckedWrite=>true`: '.implode(', ', $relevantModelKeys)));
        }
        
        return $requestData;
    }
    
    /**
     * @param array $rules
     * @param array $field
     *
     * @return array
     */
    private function prepareAddressRules(array $rules, array $field): array
    {
        $rules[$field['field'].'_country'] = $rules[$field['field'].'_country'] ?? ($field['required'] ?? false ? 'required|' : '').'string|in:HU';
        $rules[$field['field'].'_zip']     = $rules[$field['field'].'_zip'] ?? ($field['required'] ?? false ? 'required|' : '').'string|min:4|max:4';
        $rules[$field['field'].'_city']    = $rules[$field['field'].'_city'] ?? ($field['required'] ?? false ? 'required|' : '').'string';
        $rules[$field['field'].'_street']  = $rules[$field['field'].'_street'] ?? ($field['required'] ?? false ? 'required|' : '').'string';
        $rules[$field['field'].'_house']   = $rules[$field['field'].'_house'] ?? 'nullable|string';
        $rules[$field['field'].'_extra']   = $rules[$field['field'].'_extra'] ?? 'nullable|string';
        
        return $rules;
    }
    
    
    /**
     * @param array $field
     * @param array $rules
     *
     * @return array
     */
    private function prepareReferenceRules(array $field, array $rules): array
    {
        $k = str_replace('_id', '', snake_case($field['field']));
        if (!isset($rules[$k])) {
            $rules[$k] = [];
        }
        
        return $rules;
}
    
    /**
     * @param       $extraRules
     * @param array $form
     *
     * @return array
     */
    private function makeFormRules(array $form, array $extraRules = []): array
    {
        $ruleLists   = Arr::pluck($form, 'validationExtra') ?: [];
        $ruleLists[] = Arr::pluck($form, 'validation', 'field');
        $ruleLists[] = $extraRules;
        $ruleLists   = array_filter($ruleLists, 'is_array');
        $rules       = [];
        foreach ($ruleLists as $ruls) {
            foreach ($ruls as $field => $rule) {
                if (!$field || !$rule) {
                    continue;
                }
                $rule = is_array($rule) ? $rule : explode('|', $rule);
                if (isset($rules[$field])) {
                    $rules[$field] = array_merge($rules[$field], $rule);
                } else {
                    $rules[$field] = $rule;
                }
            }
        }
        if (isset($this->resource)) {
            $instance = app($this->resource);
            if (method_exists($instance, 'rules') && ($modelRules = $instance->rules())) {
                foreach ($modelRules as $field => $rule) {
                    if (isset($rules[$field])) {
                        $rules[$field] = array_merge($rules[$field], $rule);
                    }
                }
            }
        }
        
        foreach ($form as $field) {
            if (is_array($field) && ($field['type'] ?? null) === 'address') {
                $rules = $this->prepareAddressRules($rules, $field);
            }
            if (is_array($field) && ($field['type'] ?? null) === 'reference') {
                $rules = $this->prepareReferenceRules($field, $rules);
            }
        }
        
        return $rules;
    }
}
