<?php

namespace Nxu\PhpNanoClassParser\Analyzer;

use Nxu\PhpNanoClassParser\Analyzer\Analyzers\Imports;
use Nxu\PhpNanoClassParser\PhpClass;

readonly class PhpClassAnalyzer
{
    public function __construct(
        private PhpClass $phpClass
    ) {
    }


    public function imports(): Imports
    {
        return Imports::analyze($this->phpClass);
    }
}
