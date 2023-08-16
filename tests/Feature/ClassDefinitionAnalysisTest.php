<?php

use Nxu\PhpNanoClassParser\Analyzer\Analyses\ClassDefinition;
use Nxu\PhpNanoClassParser\PhpClass;

it('parses a Laravel 10 model', function () {
    $class = PhpClass::parse(stub('laravel-10-model.php.stub'));

    expect($class->analyze()->classDefinition())
        ->toBeInstanceOf(ClassDefinition::class)
        ->toHaveProperties([
            'firstLine' => 8,
            'lastLine' => 9,
            'className' => 'Test',
        ]);
});

it('parses a Filament 3 resource', function () {
    $class = PhpClass::parse(stub('filament-3-resource.php.stub'));

    expect($class->analyze()->classDefinition())
        ->toBeInstanceOf(ClassDefinition::class)
        ->toHaveProperties([
            'firstLine' => 16,
            'lastLine' => 17,
            'className' => 'TestResource',
        ]);
});

it('handles empty class', function () {
    $class = PhpClass::parse(stub('empty-class.php.stub'));

    expect($class->analyze()->classDefinition())
        ->toBeInstanceOf(ClassDefinition::class)
        ->toHaveProperties([
            'firstLine' => 3,
            'lastLine' => 4,
            'className' => 'FullyEmpty',
        ]);
});
