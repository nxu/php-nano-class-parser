<?php

namespace Nxu\PhpNanoClassParser\Analyzer\Analyses;

use Nxu\PhpNanoClassParser\Analyzer\Analysis;
use Nxu\PhpNanoClassParser\PhpClass;
use PhpParser\Node\Stmt\ClassMethod;
use PhpParser\Node\Stmt\Function_;
use PhpParser\NodeFinder;

class FirstFunction implements Analysis
{
    private function __construct(
        public int $firstLine,
        public int $lastLine,
        public string $functionName,
    ) {}

    public static function analyze(PhpClass $class): ?self
    {
        /** @var Function_|null $definition */
        $definition = (new NodeFinder)->findFirstInstanceOf($class->getAst(), ClassMethod::class);

        if (is_null($definition)) {
            return null;
        }

        return new self(
            firstLine: $definition->getStartLine(),
            lastLine: $definition->getEndLine(),
            functionName: $definition->name->toString(),
        );
    }
}
