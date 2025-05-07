<?php

declare(strict_types=1);

namespace Typhoon\Formatter;

/**
 * @api
 * @return non-empty-string
 */
function formatReflectedFunction(\ReflectionFunctionAbstract $function): string
{
    if ($function instanceof \ReflectionMethod) {
        return \sprintf('%s::%s', formatClass($function->class), $function->name);
    }

    if (str_contains($function->name, '{closure}')) {
        $file = $function->getFileName();

        if ($file === false) {
            return 'function@anonymous';
        }

        $line = $function->getStartLine();

        if ($line === false) {
            return \sprintf('function@anonymous:%s', $file);
        }

        return \sprintf('function@anonymous:%s:%d', $file, $line);
    }

    $class = $function->getClosureCalledClass();

    if ($class !== null) {
        return \sprintf('%s::%s', formatClass($class), $function->name);
    }

    \assert($function->name !== '');

    return $function->name;
}
