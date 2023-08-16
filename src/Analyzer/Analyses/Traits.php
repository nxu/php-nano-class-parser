<?php

namespace Nxu\PhpNanoClassParser\Analyzer\Analyses;

use Illuminate\Support\Collection;
use Nxu\PhpNanoClassParser\Analyzer\Analysis;
use Nxu\PhpNanoClassParser\PhpClass;
use PhpParser\Node\Name;
use PhpParser\Node\Stmt\TraitUse;
use PhpParser\NodeFinder;

readonly class Traits implements Analysis
{
    public function __construct(
        public int $firstLine,
        public int $lastLine,

        /** @var string[] $traits */
        public array $traits,
    ) {
    }

    public static function analyze(PhpClass $class): ?self
    {
        $uses = (new NodeFinder())->findInstanceOf($class->getAst(), TraitUse::class);

        /** @var Collection<int|string, TraitUse> $uses */
        $uses = collect($uses);

        if ($uses->isEmpty()) {
            return null;
        }

        $traits = collect($uses)
            ->flatMap(
                fn (TraitUse $useStatement) => collect($useStatement->traits)->map(fn (Name $trait) => $trait->toString())
            )
            ->values()
            ->toArray();

        return new self(
            firstLine: $uses->min(fn (TraitUse $use) => $use->getStartLine()),
            lastLine: $uses->max(fn (TraitUse $use) => $use->getEndLine()),
            traits: $traits,
        );
    }
}
