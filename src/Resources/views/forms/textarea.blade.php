<div class="form-group row @if($errors->has($field)) has-error @endif @if(($if ?? false) && null === data_get($item, $if)) d-none @endif " @if($if ?? false)data-if="{{$if}}"@endif>
    @include('Fastforms::forms.label')
    <div class="col-md-8">
        {!! Form::textarea(\Lintaba\Fastforms\FastformsHelper::fieldName($field), null,['rows'=>$rows ?? 2, 'class' => 'form-control ' . ($class ?? '')] + ( ($required ?? false ? ['required' => 'required'] : []))) !!}
        <p class="help-block">{{ $errors->first($field, ':message') }}</p>
    </div>
</div>
