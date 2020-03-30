<ul>
    @forelse((array)data_get($item ?? null, $field, (array)($default ?? [])) as $val)
        <li>{{ (($trans ?? null) ? transPrefix($options, $trans) : $options)[$val] ?? $val }}</li>
    @empty
        <i class="missing-value">{{ $missing ?? "\u8212" }}</i>
    @endforelse
</ul>
