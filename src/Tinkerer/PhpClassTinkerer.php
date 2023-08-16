<?php

namespace Nxu\PhpNanoClassParser\Tinkerer;

use Nxu\PhpNanoClassParser\PhpClass;

readonly class PhpClassTinkerer
{
    public function __construct(
        /** @phpstan-ignore-next-line  */
        private PhpClass $phpClass
    ) {
    }
}
