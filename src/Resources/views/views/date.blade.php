@if(data_get($item ?? null,$field))
    @php(assert(data_get($item ?? null,$field) instanceof \Illuminate\Support\Carbon, 'field '.$field.' must be a date on '.get_class($item)))
    <time datetime="{{data_get($item ?? null,$field)->format(\DateTime::ATOM)}}" >
        {{ data_get($item ?? null,$field)->formatLocalized($format ?? '%Y. %m. %d.') }}
    </time>
@else
    <i class="missing-value">{{ $missing ?? "\u8212" }}</i>
@endif
