<div class="form-group row @if($errors->has($field)) has-error @endif " @if($if ?? false)data-if="{{$if}}"@endif>
    @include('Fastforms::forms.label')

    <p class="help-block">{{ $errors->first($field, ':message') }}</p>
    <div class="col-md-12">
        <div class="table-responsive">
        <table class="table table-sm table-bordered ">
            <tr>
                <th>#</th>
                @foreach($source as $source_head)
                    <th>{{ trans(($trans ?? $tag) . $source_head) }}</th>
                @endforeach
            </tr>
            @foreach($source as $source_left)
                @php($eq=false)
                <tr>
                    <th>{{ trans(($trans ?? $tag) . $source_left) }}</th>
                    @foreach($source as $source_top)
                        @php($index = sprintf($key ?? '%s_%s',$source_left, $source_top))
                    @if($source_left === $source_top && ! ($matrix_identity ?? true) )
                        @php($eq=true)
                            <td class="text-center">
                                &mdash;
                            </td>
                        @elseif(in_array($source_left, $final ?? [], true))
                            <td class="table-secondary">
                                <label class="d-block h-100 w-100 m-0 text-center">
                                    {{Form::checkbox('',0,false,['disabled'=>'disabled']) }}
                                </label>
                            </td>
                        @elseif(data_get($item ?? null,$field)[$index] ?? false)
                            <td class="table-success" title="{{trans($tag.$field.'.changetext',[trans($source_left),trans($source_top)])}}">
                                <label class="d-block h-100 w-100 m-0 text-center" title="{{$index}}">
                                    {{Form::checkbox(
                                    $field.'['.$index.']',
                                    1,
                                    true
                                )}}</label>
                            </td>
                        @else
                            <td class="table-danger" title="{{trans($tag.$field.'.changetext',[trans($source_left),trans($source_top)])}}">
                                <label class="d-block h-100 w-100 m-0 text-center" title="{{$index}}">
                                    {{Form::checkbox(
                                    $field.'['.$index.']',
                                    1,
                                    false
                                )}}</label>
                            </td>
                        @endif
                    @endforeach
                </tr>
            @endforeach
        </table>
        </div>
    </div>
</div>
