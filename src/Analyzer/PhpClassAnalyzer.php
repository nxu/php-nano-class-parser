<?php

namespace Nxu\PhpNanoClassParser\Analyzer;

use Nxu\PhpNanoClassParser\Analyzer\Analyses\Imports;
use Nxu\PhpNanoClassParser\Analyzer\Analyses\Traits;
use Nxu\PhpNanoClassParser\PhpClass;

readonly class PhpClassAnalyzer
{
    public function __construct(
        private PhpClass $phpClass
    ) {
    }

    public function imports(): ?Imports
    {
        return Imports::analyze($this->phpClass);
    }

    public function traits(): ?Traits
    {
        return Traits::analyze($this->phpClass);
    }
}
