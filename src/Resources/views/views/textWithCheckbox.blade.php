{{ data_get($item ?? null,$field, $missing ?? '') }}
<span class="text-muted">( {{ trans($tag.$sub['field']) }}:</span> {{ $item->{$sub['field']} ? trans('Fastforms::fastforms.yes') : trans('Fastforms::fastforms.no') }} <i class="fas @if($item->{$sub['field']} ?? false) fa-check @else fa-ban @endif fa-fw"></i><span class="text-muted"> )</span>
