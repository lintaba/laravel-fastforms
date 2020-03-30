<div class="@if(data_get($item ?? null, $field, false)) table-success @else table-danger @endif"
    style="margin:-.3rem;padding:.3rem;;width:.5rem;float:left;margin-right:.6rem;">&nbsp;</div>
    <i class="fas @if(data_get($item ?? null,$field, false)) fa-check @else fa-ban @endif fa-lg fa-fw"></i>
    {{ data_get($item ?? null,$field, false) ? ($yes ?? trans('Fastforms::fastforms.yes')) : $no ?? trans('Fastforms::fastforms.no') }}
</div>
