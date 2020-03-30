@php($tag = $tag ?? ($item ? \Illuminate\Support\Str::singular($item->getTable()).'.' : ''))
<fieldset>
    @foreach($form as $formItem)
        @if(is_string($formItem))
            </fieldset>
            <fieldset>
                <legend>{{$formItem}}</legend>
        @elseif($formItem['form'] ?? true)
            @include('Fastforms::forms.'.$formItem['type'], $formItem + ['tag'=>$tag])
        @endif
    @endforeach
</fieldset>
