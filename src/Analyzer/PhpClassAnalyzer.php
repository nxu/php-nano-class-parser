<?php

namespace Nxu\PhpNanoClassParser\Analyzer;

use Nxu\PhpNanoClassParser\PhpClass;

readonly class PhpClassAnalyzer
{
    public function __construct(
        private PhpClass $phpClass
    ) {
    }
}
