<div class="form-group address-group row @if($errors->has($field)) alert-danger @endif @if(($if ?? false) && null === data_get($item, $if) ) d-none @endif " @if($if ?? false)data-if="{{$if}}"@endif>
    @include('Fastforms::forms.label')
    <div class="col-md-8">
        <div class="row form-group">
            <div class="col-md-2 @if($errors->has($field.'_country')) alert-danger @endif">
                {!! Form::select(sprintf(\Lintaba\FastForms\FastformsHelper::fieldName($field.'_%s'), 'country'),
                    isset($trans) ? \Lintaba\Fastforms\FastformsHelper::transPrefix(($countries ?? app('Fastforms')->countries()), $trans) : ($countries ?? app('Fastforms')->countries()),
                    (data_get($item ?? [], $field.'_country', $default['country'] ?? '')),
                    ['id'=>$field.'_country', 'class' => 'form-control address_country ' .  ($class_country ?? $class ?? ''), 'required' => $required ?? true ] + ($attributes_country ?? $attributes ?? []))
                !!}
            </div>
            <div class="col-md-4 @if($errors->has($field.'_zip')) alert-danger @endif">
                {!! Form::text(sprintf(\Lintaba\FastForms\FastformsHelper::fieldName($field.'_%s'), 'zip'),
                    (data_get($item ?? [], $field.'_zip', $default['zip'] ?? '')),
                    ['id'=>$field.'_zip', 'maxlength'=>4, 'pattern'=>'\d{4}', 'class' => 'form-control address_zip ' .  ($class_zip ?? $class ?? ''), 'required' => $required ?? true, 'length'=>4 , 'placeholder'=>trans('Fastforms::fastforms.address.placeholder.zip')] + ($attributes_zip ?? $attributes ?? []))
            !!}
            </div>
            <div class="col-md-6 @if($errors->has($field.'_city')) alert-danger @endif">
                {!! Form::text(sprintf(\Lintaba\FastForms\FastformsHelper::fieldName($field.'_%s'), 'city'),
                    (data_get($item ?? [], $field.'_city', $default['city'] ?? '')),
                    ['id'=>$field.'_city', 'class' => 'form-control address_city ' .  ($class_city ?? $class ?? ''), 'required' => $required ?? true , 'placeholder'=>trans('Fastforms::fastforms.address.placeholder.city')] + ($attributes_city ?? $attributes ?? []))
                !!}
            </div>
        </div>
        <div class="row form-group">
            <div class="col-md-8 @if($errors->has($field.'_street')) alert-danger @endif">
                {!! Form::text(sprintf(\Lintaba\FastForms\FastformsHelper::fieldName($field.'_%s'), 'street'),
                    (data_get($item ?? [], $field.'_street', $default['street'] ?? '')),
                    ['id'=>$field.'_street', 'class' => 'form-control address_street ' .  ($class_street ?? $class ?? ''), 'required' => $required ?? true , 'placeholder'=>trans('Fastforms::fastforms.address.placeholder.street')] + ($attributes_street ?? $attributes ?? []))
                !!}
            </div>
            <div class="col-md-4 @if($errors->has($field.'_house')) alert-danger @endif">
                {!! Form::text(sprintf(\Lintaba\FastForms\FastformsHelper::fieldName($field.'_%s'), 'house'),
                    (data_get($item ?? [], $field.'_house', $default['house'] ?? '')),
                    ['id'=>$field.'_house', 'class' => 'form-control address_house ' .  ($class_house ?? $class ?? '') , 'placeholder'=>trans('Fastforms::fastforms.address.placeholder.house')] + ($attributes_house ?? $attributes ?? []))
                !!}
            </div>
        </div>
        <div class="row form-group">
            <div class="col-md-12 @if($errors->has($field.'_extra')) alert-danger @endif">
                {!! Form::text(sprintf(\Lintaba\FastForms\FastformsHelper::fieldName($field.'_%s'), 'extra'),
                    (data_get($item ?? [], $field.'_extra', $default['extra'] ?? '')),
                    ['id'=>$field.'_extra', 'class' => 'form-control address_extra ' .  ($class_extra ?? $class ?? ''), 'placeholder'=>trans('Fastforms::fastforms.address.placeholder.extra')] + ($attributes_extra ?? $attributes ?? []))
                !!}
            </div>
        </div>
        <p class="help-block">
        {{ $errors->first($field . '_country')}}
        {{ $errors->first($field . '_zip')}}
        {{ $errors->first($field . '_city')}}
        {{ $errors->first($field . '_street')}}
        {{ $errors->first($field . '_house')}}
        {{ $errors->first($field . '_extra')}}
        </p>
    </div>
</div>

