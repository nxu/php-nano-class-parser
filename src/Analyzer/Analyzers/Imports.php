<?php

namespace Nxu\PhpNanoClassParser\Analyzer\Analyzers;

use Illuminate\Support\Arr;
use Nxu\PhpNanoClassParser\PhpClass;
use PhpParser\Node\Stmt;
use PhpParser\Node\Stmt\Use_;
use PhpParser\NodeFinder;

/**
 * @property-read string[] $imports
 */
readonly class Imports
{
    private function __construct(
        public int $firstLine,
        public int $lastLine,
        public array $imports,
    ) {
    }

    public static function analyze(PhpClass $class): self
    {
        $uses = (new NodeFinder())->findInstanceOf($class->getAst(), Use_::class);
        $uses = collect($uses);

        return new self(
            $uses->min->getStartLine(),
            $uses->max->getEndLine(),
            $uses
                ->flatMap(
                    fn (Use_ $useStatement) => collect($useStatement->uses)
                        ->map(fn(Stmt\UseUse $use) => $use->name->toString())
                        ->values()
                )
                ->toArray()
        );
    }
}
