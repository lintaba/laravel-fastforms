<div class="form-group row @if($errors->has($field)) has-error @endif @if(($if ?? false) && null === data_get($item, $if)) d-none @endif " @if($if ?? false)data-if="{{$if}}"@endif>
    @include('Fastforms::forms.label')
    <div class="col-md-8">

        <div class="form-check form-check-inline">
            {!! Form::checkbox(
                \Lintaba\Fastforms\FastformsHelper::fieldName($field),
                $truthValue ?? 1,
                (data_get($item ?? null,$field, $default ?? 0)),
                [
                    'class' => 'form-check-input ' . ($class ?? ''),
                    'id'=>$field,
                ]
                 + ( ($required ?? false ? ['required' => 'required'] : []))
                 + ( ($disabled ?? false ? ['disabled' => 'disabled'] : []))
                ) !!}
            <label for="{{$field}}">
            {!! $description ?? '' !!}
            </label>
        </div>
        <p class="help-block">{{ $errors->first($field, ':message') }}</p>
    </div>
</div>
