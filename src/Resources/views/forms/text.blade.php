<div class="form-group row @if($errors->has($field)) has-error @endif @if(($if ?? false) && null === data_get($item, $if)) d-none @endif " @if($if ?? false)data-if="{{$if}}"@endif>
    @include('Fastforms::forms.label')
    <div class="col-md-8">
        <div class="input-group">
            @if($prepend ?? false)
                <div class="input-group-prepend">
                    <span class="input-group-text">{{$prepend }}</span>
                </div>
            @endif
            @if($prepend_btn ?? false)
                <div class="input-group-prepend">
                    <button tabindex="-1" class="btn btn-outline-secondary btn-{{$prepend_btn}}" type="button" title="{{trans($tag.$prepend_btn.'.title') }}">{{trans($tag.$prepend_btn.'.text') }}</button>
                </div>
            @endif
            {!! Form::{$subtype ?? 'text'}(\Lintaba\Fastforms\FastformsHelper::fieldName($field), data_get($item ?? null,$field, $default ?? null),['maxlength'=>$max ?? 255, 'class' => 'form-control ' . ($class ?? '')] + ( ($required ?? false ? ['required' => 'required'] : [])) + ( ($disabled ?? false ? ['disabled' => 'disabled'] : [])) + ($attributes ?? [])) !!}
            @if($append ?? false)
                <div class="input-group-append">
                    <span class="input-group-text">{{$append}}</span>
                </div>
            @elseif($fillfrom ?? false)
                <div class="input-group-append">
                    <button class="btn btn-outline-secondary action-fillfrom" tabindex="-1" type="button" title="{{ trans('Fastforms::fastforms.text.fillfrom',['from'=>trans($tag.$fillfrom)]) }}" data-to="{{$field}}" data-from="{{$fillfrom}}">
                        <i class="fas fa-asterisk"></i>
                    </button>
                </div>
            @elseif($append_btn ?? false)
                <div class="input-group-append">
                    <button tabindex="-1" class="btn btn-outline-secondary btn-{{$append_btn}} action-{{$append_btn}}" type="button" title="{{trans($tag.$append_btn.'.title') }}">{{trans($tag.$append_btn.'.text') }}</button>
                </div>
            @endif
        </div>
        <p class="help-block">{{ $errors->first($field, ':message') }}</p>
    </div>
</div>
