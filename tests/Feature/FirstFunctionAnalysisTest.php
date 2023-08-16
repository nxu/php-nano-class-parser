<?php

use Nxu\PhpNanoClassParser\Analyzer\Analyses\FirstFunction;
use Nxu\PhpNanoClassParser\PhpClass;

it('parses a Laravel 10 model', function () {
    $class = PhpClass::parse(stub('laravel-10-model.php.stub'));

    expect($class->analyze()->firstFunction())->toBeNull();
});

it('parses a Filament 3 resource', function () {
    $class = PhpClass::parse(stub('filament-3-resource.php.stub'));

    expect($class->analyze()->firstFunction())
        ->toBeInstanceOf(FirstFunction::class)
        ->toHaveProperties([
            'firstLine' => 22,
            'lastLine' => 28,
            'functionName' => 'form',
        ]);
});

it('handles empty class', function () {
    $class = PhpClass::parse(stub('empty-class.php.stub'));

    expect($class->analyze()->firstFunction())->toBeNull();
});
