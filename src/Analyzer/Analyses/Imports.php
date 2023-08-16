<?php

namespace Nxu\PhpNanoClassParser\Analyzer\Analyses;

use Illuminate\Support\Collection;
use Nxu\PhpNanoClassParser\Analyzer\Analysis;
use Nxu\PhpNanoClassParser\PhpClass;
use PhpParser\Node;
use PhpParser\Node\Stmt;
use PhpParser\Node\Stmt\Use_;
use PhpParser\NodeFinder;

readonly class Imports implements Analysis
{
    private function __construct(
        public int $firstLine,
        public int $lastLine,

        /** @var string[] $imports */
        public array $imports,
    ) {
    }

    public static function analyze(PhpClass $class): ?self
    {
        $uses = (new NodeFinder())->findInstanceOf($class->getAst(), Use_::class);

        /** @var Collection<int|string, Use_> $uses */
        $uses = collect($uses);

        if ($uses->isEmpty()) {
            return null;
        }

        $imports = $uses
            ->flatMap(fn (Use_ $useStatement) => collect($useStatement->uses)
                ->map(fn (Stmt\UseUse $use) => $use->name->toString())
                ->values()
            )
            ->toArray();

        return new self(
            firstLine: $uses->min(fn (Node $use) => $use->getStartLine()),
            lastLine: $uses->max(fn (Node $use) => $use->getEndLine()),
            imports: $imports
        );
    }
}
