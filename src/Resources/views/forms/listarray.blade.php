<div class="form-group row @if($errors->has($field)) has-error @endif " @if($if ?? false)data-if="{{$if}}"@endif>
    @include('Fastforms::forms.label')
    <div class="col-md-1"></div>
        @foreach($options as $optkey=>$option)
        <div class="col-md-2 text-md-right ">
            <label onclick="$('.role-{{\Illuminate\Support\Str::slug($rname.'-'.$optkey)}}').click()">{{trans($tag.$option) }}</label>
        </div>
        @endforeach
    <p class="help-block">{{ $errors->first($field, ':message') }}</p>
</div>

@foreach($source as $rname=>$right)
    <div class="row la-{{$field}}" data-la="{{$rname}}">
        {{ Form::label('perm_'.$rname, $labels[$rname] ?? trans('Fastforms::fastforms.listarray.missing.label',$rname), ['class' => 'col-md-5 col-form-label text-md-right']) }}
        @foreach($options as $optkey=>$option)

            <div class="col-md-2 text-md-right @if(data_get($item ?? null,$field.'.'.$rname, $default) == $optkey) font-weight-bold @endif">
            <label>
                {{ Form::radio(
                    $field.'['.$rname.']',
                    $optkey,
                    data_get($item ?? null,$field.'.'.$rname, $default) == $optkey,
                    ['class'=>'role-'.\Illuminate\Support\Str::slug($rname.'-'.$optkey), 'id'=>'perm_'.$rname.'_'.$optkey] ) }}
                {{trans($tag.$option) }}
            </label>
        </div>
        @endforeach
        @if(isset(data_get($item ?? null,$field,[])[$rname]) && !isset($options[data_get($item ?? null,$field,[])[$rname]]))
            <div class="col-md-2 text-md-right font-weight-bold">
                <label>
                    {{ Form::radio(
                        $field.'['.$rname.']',
                        data_get($item ?? null,$field)[$rname],
                        true) }}
                    {{trans($tag.data_get($item ?? null,$field)[$rname]) }}
                </label>
            </div>
        @endif
    </div>
@endforeach
