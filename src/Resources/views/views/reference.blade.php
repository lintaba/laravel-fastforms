@if(data_get($item ?? null,$field))
{{ data_get($item ?? null,$field) === null ? ($missing ?? "\u8212") : (data_get($item ?? null,$field)->$attr ?? ($nonExistent ?? '???')) }}
@else
    <i class="missing-value">{{ $missing ?? "\u8212" }}</i>
@endif
