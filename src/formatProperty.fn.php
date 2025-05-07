<?php

declare(strict_types=1);

namespace Typhoon\Formatter;

/**
 * @api
 * @param class-string|object $class
 * @param non-empty-string $property
 * @return non-empty-string
 */
function formatProperty(string|object $class, string $property): string
{
    return sprintf('%s::$%s', formatClass($class), $property);
}
