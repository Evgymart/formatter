<?php

declare(strict_types=1);

namespace Typhoon\Formatter;

/**
 * @api
 * @return non-empty-string
 */
function formatReflectedParameter(\ReflectionParameter $parameter): string
{
    return \sprintf('%s($%s)', formatReflectedFunction($parameter->getDeclaringFunction()), $parameter->name);
}
