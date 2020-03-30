<div class="table-responsive">
    <table class="table table-sm table-bordered ">
        <tr>
            <th>#</th>
            @foreach($source as $source_head)
                <th>{{ trans(($trans ?? $tag) . $source_head) }}</th>
            @endforeach
        </tr>
        @foreach($source as $source_left)
            <tr>
                <th>{{ trans(($trans ?? $tag) . $source_left) }}</th>
                @foreach($source as $source_top)
                    @php($index = sprintf($key,$source_left, $source_top))
                    @if($source_left === $source_top && ! ($matrix_identity ?? true) )
                        <td class="text-center">
                            &mdash;
                        </td>
                    @elseif(data_get($item ?? null,$field)[$index] ?? false)
                        <td class="table-success text-center" title="{{trans($tag.$field.'.changetext',[trans($source_left),trans($source_top)])}}">
                            <i class="fas fa-check fa-lg fa-fw"></i>
                        </td>
                    @else
                        <td class="table-danger text-center" title="{{trans($tag.$field.'.changetext',[trans($source_left),trans($source_top)])}}">
                            <i class="fas fa-ban fa-lg fa-fw"></i>
                        </td>
                    @endif
                @endforeach
            </tr>
        @endforeach
    </table>
</div>
