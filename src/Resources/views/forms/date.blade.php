<div class="form-group row @if($errors->has($field)) has-error @endif @if(($if ?? false) && null === data_get($item, $if)) d-none @endif " @if($if ?? false)data-if="{{$if}}"@endif>
    @include('Fastforms::forms.label')
    <div class="col-md-8">
        <div class="input-group">
            @if($prepend ?? false)
                <div class="input-group-prepend">
                    <span class="input-group-text">{{$prepend }}</span>
                </div>
            @endif
            {!! Form::text(
                \Lintaba\Fastforms\FastformsHelper::fieldName($field),
                optional(data_get($item ?? null,$field, $default ?? null))->format('Y-m-d'),
           array_filter( ['format'=>$format ?? 'Y-m-d',
            'class' => 'datepicker form-control ' . ($class ?? '')] +
            ($required ?? false ? ['required' => 'required'] : []) +
            ($attributes ?? []) +
            ['data-min'=>$min ?? null, 'data-max'=>$max ?? null]
            )) !!}
            @if($today ?? false)
                <div class="input-group-append">
                    <button tabindex="-1" class="btn btn-outline-secondary action-today" type="button">{{trans('Fastforms::fastforms.today')}}</button>
                </div>
            @endif
        </div>
        <p class="help-block">{{ $errors->first($field, ':message') }}</p>
    </div>
</div>
