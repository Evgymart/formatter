<?php

declare(strict_types=1);

namespace Typhoon\Formatter;

/**
 * @api
 * @param callable $function native type is intentionally not used to avoid autoloading during callable type check
 * @param non-empty-string $parameter
 * @return non-empty-string
 */
function formatParameter(mixed $function, string $parameter): string
{
    return sprintf('%s($%s)', formatFunction($function), $parameter);
}
