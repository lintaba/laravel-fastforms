<div class="form-group row @if($errors->has($field)) has-error @endif @if(($if ?? false) && null === data_get($item, $if)) d-none @endif " @if($if ?? false)data-if="{{$if}}"@endif>
    @include('Fastforms::forms.label', ['help'=>($help ?? '') . trans('Fastforms::fastforms.multiselect.helptext')])
    <div class="col-md-8">
        {!! Form::select(
            (\Lintaba\Fastforms\FastformsHelper::fieldName($field)).'[]',
            isset($trans) ? \Lintaba\Fastforms\FastformsHelper::transPrefix($options, $tag.$trans) : $options,
            (array)data_get($item ?? [], $field, (array)($default ?? [])),
            ['multiple'=>true, 'class' => 'form-control ' . ($class ?? '')] + ( (($required ?? false) ? ['required' => 'required'] : []))
        ) !!}
        <p class="help-block">{{ $errors->first($field, ':message') }}</p>
    </div>
</div>
