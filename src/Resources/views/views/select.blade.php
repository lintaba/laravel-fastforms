{{ ((($trans ?? null) ? transPrefix($options, $trans) : $options)[data_get($item ?? null, $field) ?? $default ?? null]) ?? $default ?? (data_get($item ?? null, $field)) }}
