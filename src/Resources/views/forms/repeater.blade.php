<div class="card my-2">
    <div class="card-body">
<div id="{{$field}}_template" class="d-none">
    <div class="row">
        {{ Form::label($field, $label ?? trans($tag.$field ).' ##', ['class' => 'col-md-4 col-form-label text-md-right']) }}
        <div class="col-md-8">
            {!! Form::text($field.'[#!#]['.$subfield.']', $default ?? '',['value'=>'','disabled'=>true, 'maxlength'=>$max ?? 255, 'class' => 'form-control ' . ($class ?? '')] + ( ($required ?? false ? ['required' => 'required'] : []))) !!}
        </div>
    </div>
</div>
<div id="{{$field}}_container" class="@if(($if ?? false) && null === data_get($item, $if)) d-none @endif">
    @foreach( (data_get($item ?? null,$field) ?? $input->$field ?? ['']) as $i=>$ritem)
        @if(!is_numeric($i) || !array($ritem) || !is_scalar($ritem[$subfield] ?? '')) [ERR] @continue @endif
        <div class="row @if($errors->has("$field{$i}")) has-error @endif">
            {{ Form::label($field, $label ?? trans($tag.$field ).' '.($i+1), ['class' => 'col-md-4 col-form-label text-md-right']) }}

            <div class="col-md-8">
                {!! Form::text($field.'['.$i.']['.$subfield.']', $ritem[$subfield] ?? '',['maxlength'=>$max ?? 255, 'class' => 'form-control ' . ($class ?? '')] + ( ($required ?? false ? ['required' => 'required'] : []))) !!}
                <p class="help-block">{{$errors->first("$field{$i}", '<p class="help-block">:message</p>')}}</p>
            </div>
        </div>
    @endforeach
</div>

    </div>
</div>
