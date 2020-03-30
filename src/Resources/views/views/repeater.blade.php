@forelse((data_get($item ?? null,$field) ?? []) as $index => $ritem)
    @if(!is_numeric($index) || !array($ritem) || !is_scalar($ritem[$subfield] ?? '')) [ERR] @continue @endif
    <div class="row">
        <div class="col-1 font-weight-bold">{{$index+1}}.:</div>
        <div class="col-11">{{ $ritem[$subfield] ?? '-' }}</div>
    </div>
@empty
    <div class="row">
        <div class="col-12 text-muted"> &mdash; </div>
    </div>
@endforelse
