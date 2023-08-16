<?php

namespace Nxu\PhpNanoClassParser\Tinkerer;

use Nxu\PhpNanoClassParser\Analyzer\PhpClassAnalyzer;
use Nxu\PhpNanoClassParser\PhpClass;

readonly class PhpClassTinkerer
{
    public function __construct(
        private PhpClass $phpClass
    ) {}
}
