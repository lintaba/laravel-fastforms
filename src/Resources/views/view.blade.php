@php($tag = $tag ?? ($item ? \Illuminate\Support\Str::singular($item->getTable()).'.' : ''))
@foreach($form as $formItem)
    @if(is_string($formItem))
        <tr colspan="2">
            <th class="lead">{{$formItem}}</th>
        </tr>
    @elseif($formItem['view'] ?? true)
        <tr>
            <th>
                {{ $formItem['label'] ?? trans($tag.($formItem['field'] ?? '')) }} </th>
            <td>
                @include('Fastforms::views.'.$formItem['type'], $formItem + ['tag'=>$tag] )
            </td>
            @if(is_callable($each ?? null))
                {{$each($formItem)}}
            @endif
        </tr>
    @endif
@endforeach
