<?php

namespace Nxu\PhpNanoClassParser\Analyzer\Analyses;

use Nxu\PhpNanoClassParser\Analyzer\Analysis;
use Nxu\PhpNanoClassParser\PhpClass;
use PhpParser\Node\Stmt\Class_;
use PhpParser\NodeFinder;

readonly class ClassDefinition implements Analysis
{
    public function __construct(
        public int $firstLine,
        public int $lastLine,
        public ?string $className,
    ) {
    }

    public static function analyze(PhpClass $class): ?self
    {
        /** @var Class_|null $definition */
        $definition = (new NodeFinder())->findFirstInstanceOf($class->getAst(), Class_::class);

        if (is_null($definition)) {
            return null;
        }

        return new self(
            firstLine: $definition->getStartLine(),
            lastLine: $definition->getStartLine() + 1,
            className: $definition->name?->toString(),
        );
    }
}
