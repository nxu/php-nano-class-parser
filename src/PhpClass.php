<?php

namespace Nxu\PhpNanoClassParser;

use Nxu\PhpNanoClassParser\Analyzer\PhpClassAnalyzer;
use PhpParser\Node\Stmt;
use PhpParser\ParserFactory;

readonly class PhpClass
{
    private function __construct(
        /** @var Stmt[] $ast */
        private array $ast,
    ) {}

    public function analyze(): PhpClassAnalyzer
    {
        return new PhpClassAnalyzer($this);
    }

    /**
     * @return Stmt[]
     */
    public function getAst(): array
    {
        return $this->ast;
    }

    public static function parse(string $phpSource): ?self
    {
        $ast = (new ParserFactory)
            ->createForHostVersion()
            ->parse($phpSource);

        if (is_null($ast)) {
            return null;
        }

        return new self($ast);
    }
}
