<div class="form-group row @if($errors->has($field)) has-error @endif @if(($if ?? false) && null === data_get($item, $if)) d-none @endif " @if($if ?? false)data-if="{{$if}}"@endif>
    @include('Fastforms::forms.label')
    <div class="col-md-8">
        {!! Form::select(
            \Lintaba\Fastforms\FastformsHelper::fieldName($field),
             ((($nullable ?? false) || (data_get($item ?? null,$field)->{$id ?? 'id'} ?? $default ?? null) === null) ? [null=>trans('Fastforms::fastforms.reference.select_none')] : []) +
                 (isset($builder) ? $builder() : $item->query())->get([($id ?? 'id'),$attr])->pluck($attr,($id ?? 'id'))->all() +
                 [data_get($item ?? null,$field)->{$id ?? 'id'} ?? $default ?? null => '??? '. (data_get($item ?? null,$field)->{$id ?? 'id'} ?? $default ?? null)],
            data_get($item ?? null,$field)->{$id ?? 'id'} ?? $default ?? null,
            ['class' => 'form-control ' . ($class ?? '')] + ( ($required ?? false ? ['required' => 'required'] : []))
        ) !!}
        <p class="help-block">{{ $errors->first($field, ':message') }}</p>
    </div>
</div>
