<?php

declare(strict_types=1);

if (!function_exists('nameof')) {
    function nameof(mixed $var): string
    {
        $backtrace = debug_backtrace()[0];
        $file = file($backtrace['file']);
        $callLine = $file[$backtrace['line'] - 1];

        $result = preg_match('/' . __FUNCTION__ . ' *\([^$]*(?P<varName>\$[^ ,)]+) *\)/ui', $callLine, $matches);

        if (!$result)
            throw new Exception('Fix regexp');

        return substr($matches['varName'], 1);
    }
}
