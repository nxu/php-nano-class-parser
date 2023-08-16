<?php

namespace Nxu\PhpNanoClassParser\Analyzer;

use Nxu\PhpNanoClassParser\PhpClass;

/**
 * @property-read int $firstLine
 * @property-read int $lastLine
 */
interface Analysis
{
    public static function analyze(PhpClass $class): ?self;
}
