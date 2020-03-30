<div class="form-group row @if($errors->has($field)) has-error @endif @if(($if ?? false) && null === data_get($item, $if)) d-none @endif " @if($if ?? false)data-if="{{$if}}"@endif>
    @include('Fastforms::forms.label')
    <div class="col-md-8">
        <div class="input-group">
            @if($prepend ?? false)
                <div class="input-group-prepend">
                    <span class="input-group-text">{{$prepend }}</span>
                </div>
            @endif
            {!! Form::number(\Lintaba\Fastforms\FastformsHelper::fieldName($field), data_get($item ?? null,$field, $default ?? null), ['step'=>$step ?? 1, 'min'=>$min ?? 0, 'max'=>$max ?? 1000000, 'class' => 'form-control ' . ($class ?? '')] + ( ($required ?? false ? ['required' => 'required'] : []))) !!}
            @if($append ?? false)
                <div class="input-group-append">
                    <span class="input-group-text">{{$append}}</span>
                </div>
            @endif
        </div>
        <p class="help-block">{{ $errors->first($field, ':message') }}</p>
    </div>
</div>
