<?php

declare(strict_types=1);

namespace Typhoon\Formatter;

/**
 * @api
 * @return non-empty-string
 */
function format(mixed $value): string
{
    if ($value === null) {
        return 'null';
    }

    if ($value === true) {
        return 'true';
    }

    if ($value === false) {
        return 'false';
    }

    if (\is_int($value) || \is_float($value)) {
        return (string) $value;
    }

    if (\is_string($value)) {
        return \sprintf("'%s'", addcslashes($value, "'"));
    }

    if (\is_array($value)) {
        if ($value === []) {
            return 'list{}';
        }

        if (array_is_list($value)) {
            return \sprintf('list{%s}', implode(', ', array_map(format(...), $value)));
        }

        return \sprintf('array{%s}', implode(', ', array_map(
            static fn(mixed $key, mixed $value): string => \sprintf(
                '%s: %s',
                format($key),
                format($value),
            ),
            array_keys($value),
            $value,
        )));
    }

    if ($value instanceof \UnitEnum) {
        return \sprintf('%s::%s', $value::class, $value->name);
    }

    if ($value instanceof \Closure) {
        return formatFunction($value);
    }

    if (\is_object($value)) {
        return formatClass($value::class);
    }

    \assert(\is_resource($value));

    return 'resource';
}
