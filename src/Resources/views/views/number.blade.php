{{ number_format( (float)data_get($item,$field), -(int)log($step ?? 1, 10), ',', ' ') }}
<span class="text-muted">{{$append ?? ''}}</span>
