<?php

use Nxu\PhpNanoClassParser\Analyzer\Analyses\Traits;
use Nxu\PhpNanoClassParser\PhpClass;

it('parses a Laravel 10 model', function () {
    $class = PhpClass::parse(stub('laravel-10-model.php.stub'));

    $start = 10;
    $end = 10;

    $traits = [
        'HasFactory',
    ];

    $traitData = $class->analyze()->traits();

    expect($traitData)
        ->toBeInstanceOf(Traits::class)
        ->toHaveProperty('firstLine', $start)
        ->toHaveProperty('lastLine', $end)
        ->and($traitData->traits)
        ->toMatchArray($traits);
});

it('parses a Filament 3 resource', function () {
    $class = PhpClass::parse(stub('filament-3-resource.php.stub'));

    expect($class->analyze()->traits())->toBeNull();
});

it('handles empty class', function () {
    $class = PhpClass::parse(stub('empty-class.php.stub'));

    $importData = $class->analyze()->traits();

    expect($importData)->toBeNull();
});
