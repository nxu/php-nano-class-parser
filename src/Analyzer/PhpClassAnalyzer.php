<?php

namespace Nxu\PhpNanoClassParser\Analyzer;

use Nxu\PhpNanoClassParser\Analyzer\Analyses\ClassDefinition;
use Nxu\PhpNanoClassParser\Analyzer\Analyses\FirstFunction;
use Nxu\PhpNanoClassParser\Analyzer\Analyses\Imports;
use Nxu\PhpNanoClassParser\Analyzer\Analyses\Traits;
use Nxu\PhpNanoClassParser\PhpClass;

readonly class PhpClassAnalyzer
{
    public function __construct(
        private PhpClass $phpClass
    ) {
    }

    public function classDefinition(): ?ClassDefinition
    {
        return ClassDefinition::analyze($this->phpClass);
    }

    public function firstFunction(): ?FirstFunction
    {
        return FirstFunction::analyze($this->phpClass);
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
