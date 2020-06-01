<?php declare(strict_types=1);


namespace Lintaba\Fastforms;


class FastformsHelper
{
    
    public static function fieldName($field){
        return preg_replace('/\.([^.]+)/','[\\1]',$field);
    }



    public static function transPrefix(array $items, string $prefix) : array
    {
        $res = [];
        if($this->isAssoc($arr)) {
            foreach ($items as $key => $val) {
                $res[$key] = trans($prefix . $val);
            }
        }else{
            foreach ($items as $val) {
                $res[$val] = trans($prefix . $val);
            }
        }
        return $res;
    }

    private function isAssoc(array $arr) : bool
    {
        return array_keys($arr) !== range(0, count($arr) - 1);
    }
    
    
    protected $countries = [];
    
    
    public function __construct()
    {
        $this->initCountries();
    }
    
    public function countries() : array{
        return $this->countries;
    }
    
    public function addCountry(string $code,string $name) : self
    {
        $this->countries[$code] = $name;
        return $this;
    }
    
    private function initCountries()
    {
        
        $this->countries = [
            'HU'=>'HU',
        ];
    }
    
    
}
