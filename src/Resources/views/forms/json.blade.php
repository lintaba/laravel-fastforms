<div class="form-group row @if($errors->has($field)) has-error @endif @if(($if ?? false) && null === data_get($item, $if)) d-none @endif " @if($if ?? false)data-if="{{$if}}"@endif>
    @include('Fastforms::forms.label')
    <div class="col-md-8">
        <div class="input-group">
            {!! Form::textarea(
                \Lintaba\Fastforms\FastformsHelper::fieldName($field), json_encode(data_get($item ?? null,$field, $default ?? null), JSON_PRETTY_PRINT) ,
                ['pattern'=>'/\A("([^"\\]*|\\["\\bfnrt\/]|\\u[0-9a-f]{4})*"|-?(?=[1-9]|0(?!\d))\d+(\.\d+)?([eE][+-]?\d+)?|true|false|null|\[(?:(?1)(?:,(?1))*)?\s*\]|\{(?:\s*"([^"\\]*|\\["\\bfnrt\/]|\\u[0-9a-f]{4})*"\s*:(?1)(?:,\s*"([^"\\]*|\\["\\bfnrt\/]|\\u[0-9a-f]{4})*"\s*:(?1))*)?\s*\})\Z/is
','class' => 'validate-json form-control ' . ($class ?? '')] + ( ($required ?? false ? ['required' => 'required'] : [])))
            !!}
        </div>
        <p class="help-block">{{ $errors->first($field, ':message') }}</p>
    </div>
</div>
