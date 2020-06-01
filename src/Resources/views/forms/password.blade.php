<div class="form-group row @if($errors->has($field)) has-error @endif " @if($if ?? false)data-if="{{$if}}"@endif>
    @include('Fastforms::forms.label')
    <div class="col-md-8">
        {!! Form::password(\Lintaba\Fastforms\FastformsHelper::fieldName($field), ($attributes ?? []) + ['class' => 'form-control ' . ($class ?? ''), 'autocomplete'=>'off'] + ( ($required ?? false ? ['required' => 'required'] : []))) !!}
        <p class="help-block">{{ $errors->first($field, ':message') }}</p>
    </div>
</div>
