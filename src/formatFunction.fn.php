<?php

declare(strict_types=1);

namespace Typhoon\Formatter;

/**
 * @api
 * @param callable $function native type is intentionally not used to avoid autoloading during callable type check
 * @return non-empty-string
 */
function formatFunction(mixed $function): string
{
    if (\is_string($function)) {
        if (!str_contains($function, '::')) {
            /** @var non-empty-string */
            return $function;
        }

        $function = explode('::', $function);
    }

    if (\is_array($function)) {
        /** @var array{class-string|object, non-empty-string} $function */
        return \sprintf('%s::%s()', formatClass($function[0]), $function[1]);
    }

    if ($function instanceof \Closure) {
        return formatReflectedFunction(new \ReflectionFunction($function));
    }

    /** @var object $function */
    return \sprintf('%s::__invoke()', formatClass($function));
}
