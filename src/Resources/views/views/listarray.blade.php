<div class="table-responsive">
    <table class="table table-sm table-striped table-hover">
        @foreach($source as $rname=>$right)
            <tr class="{{ $options_meta[data_get($item ?? null,$field)[$rname] ?? $default]['color'] ?? '' }}">
                <td>{{$labels[$rname] ?? trans('Fastforms::fastforms.listarray.missing.label',$rname)}}</td>
                <td>
                    <i class="fas {{ $options_meta[data_get($item ?? null,$field)[$rname] ?? $default]['icon'] ?? 'fa-question-circle' }} fa-lg fa-fw"></i>
                    {{ trans($tag.$field.'.'.($options[data_get($item ?? null,$field)[$rname] ?? $default] ?? ('??? ' . (data_get($item ?? null,$field)[$rname] ?? $default))) )  }}
                </td>
            </tr>
        @endforeach
    </table>
</div>
