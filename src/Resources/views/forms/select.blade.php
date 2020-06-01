<div class="form-group row @if($errors->has($field)) has-error @endif @if(($if ?? false) && null === data_get($item, $if)) d-none @endif " @if($if ?? false)data-if="{{$if}}"@endif>
    @include('Fastforms::forms.label')
    <div class="col-md-8">
        {!! Form::select(
            (\Lintaba\Fastforms\FastformsHelper::fieldName($field)).'[]',
            isset($trans) ? \Lintaba\Fastforms\FastformsHelper::transPrefix($options, $tag.$trans) : $options,
            data_get($item ?? [], $field, $default ?? null),
            ['class' => 'form-control ' . ($class ?? '')]
            + (($required ?? false) ? ['required' => 'required'] : [])
            + (($disabled ?? false) ? ['disabled' => 'disabled'] : [])
        ) !!}
        <p class="help-block">{{ $errors->first($field, ':message') }}</p>
    </div>
</div>
