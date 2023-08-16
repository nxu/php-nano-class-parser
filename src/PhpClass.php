<?php

namespace Nxu\PhpNanoClassParser;

use PhpParser\Node\Stmt;
use PhpParser\ParserFactory;

readonly class PhpClass
{
    public function __construct(
        /** @var Stmt[] $ast */
        private array $ast,
    ) {

    }

    public function getAst(): array
    {
        return $this->ast;
    }

    public static function parse(string $phpSource): ?self
    {
        $ast = (new ParserFactory)
            ->create(ParserFactory::PREFER_PHP7)
            ->parse($phpSource);

        if (is_null($ast)) {
            return null;
        }

        return new self($ast);
    }
}
