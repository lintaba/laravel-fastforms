@php($last = null)
@forelse((data_get($item ?? null,$field) ?? []) as $index => $ritem)
    @if(!is_string($index) || !array($ritem) || !is_scalar($ritem[$subfield] ?? '')) [ERR] @continue @endif


    <div class="row">
        <div class="col-4 font-weight-bold">
            @if($last) {{$last}}+ @else -∞ @endif
            &mdash;
            @if($index === '-') ∞ @else {{$last = $index}} @endif
        </div>
        <div class="col-6">{{ data_get($ritem, $subfield.'.'.$index, '-') }}</div>
    </div>
@empty
    <div class="row">
        <div class="col-12 text-muted"> &mdash; </div>
    </div>
@endforelse
