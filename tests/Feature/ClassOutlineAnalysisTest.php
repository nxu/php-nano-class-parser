<?php

use Nxu\PhpNanoClassParser\Analyzer\Analyses\ClassOutline;
use Nxu\PhpNanoClassParser\PhpClass;

it('parses a Laravel 10 model', function () {
    $class = PhpClass::parse(stub('laravel-10-model.php.stub'));

    expect($class->analyze()->classOutline())
        ->toBeInstanceOf(ClassOutline::class)
        ->toHaveProperties([
            'firstLine' => 8,
            'lastLine' => 11,
            'className' => 'Test',
        ]);
});

it('parses a Filament 3 resource', function () {
    $class = PhpClass::parse(stub('filament-3-resource.php.stub'));

    expect($class->analyze()->classOutline())
        ->toBeInstanceOf(ClassOutline::class)
        ->toHaveProperties([
            'firstLine' => 16,
            'lastLine' => 67,
            'className' => 'TestResource',
        ]);
});

it('handles empty class', function () {
    $class = PhpClass::parse(stub('empty-class.php.stub'));

    expect($class->analyze()->classOutline())
        ->toBeInstanceOf(ClassOutline::class)
        ->toHaveProperties([
            'firstLine' => 3,
            'lastLine' => 6,
            'className' => 'FullyEmpty',
        ]);
});
