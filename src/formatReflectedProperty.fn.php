<?php

declare(strict_types=1);

namespace Typhoon\Formatter;

/**
 * @api
 * @return non-empty-string
 */
function formatReflectedProperty(\ReflectionProperty $property): string
{
    /** @phpstan-ignore argument.type */
    return formatProperty($property->class, $property->name);
}
