<div class="form-group row @if($errors->has($field)) has-error @endif @if(($if ?? false) && null === data_get($item, $if)) d-none @endif ">
@include('Fastforms::forms.label')
    <div class="col-md-8">
        <div class="input-group">
            {!! Form::text(\Lintaba\Fastforms\FastformsHelper::fieldName($field), data_get($item ?? null, $field, $default ?? null),['maxlength'=>$max ?? 255, 'class' => 'form-control ' . ($class ?? '')] + ( ($required ?? false ? ['required' => 'required'] : [])) + ($attributes ?? [])) !!}


            <div class="input-group-append @if(isset($sub['if']) && !($item->{$sub['if']} ?? null)) d-none @endif " id="{{$sub['field']}}_cont" data-toggle="tooltip" >
                <div class="input-group-text" title="{{trans($tag.$sub['field'])}}">
                {{ Form::label($sub['field'], trans($tag.$sub['field'].'_short'), ['class' => '','for'=>$sub['field']]) }}

                {!! Form::checkbox(
                   $sub['name'] ?? $sub['field'],
                   1,
                   ($item->{$sub['field']} ?? $sub['default'] ?? 0),
                   ['class' => '' . ($sub['class'] ?? ''),]
                    + ( ($sub['required'] ?? false ? ['required' => 'required'] : []))
                    + ( ($sub['disabled'] ?? false ? ['disabled' => 'disabled'] : []))
                )!!}
                </div>
            </div>
        </div>
        <p class="help-block">{{ $errors->first($field, ':message') }}</p>
    </div>
</div>
