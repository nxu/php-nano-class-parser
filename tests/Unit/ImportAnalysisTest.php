<?php

use Nxu\PhpNanoClassParser\PhpClass;

it('parses a Laravel 10 model', function () {
    $class = PhpClass::parse(stub('laravel-10-model.php.stub'));

    $start = 5;
    $end = 6;

    $imports = [
        'Illuminate\Database\Eloquent\Factories\HasFactory',
        'Illuminate\Database\Eloquent\Model',
    ];

    $importData = $class->analyze()->imports();

    expect($importData)
        ->toBeInstanceOf(\Nxu\PhpNanoClassParser\Analyzer\Analyses\Imports::class)
        ->toHaveProperty('firstLine', $start)
        ->toHaveProperty('lastLine', $end)
        ->and($importData->imports)
        ->toMatchArray($imports);
});

it('parses a Filament 3 resource', function () {
    $class = PhpClass::parse(stub('filament-3-resource.php.stub'));

    $start = 5;
    $end = 14;

    $imports = [
        "App\Filament\Resources\TestResource\Pages",
        "App\Filament\Resources\TestResource\RelationManagers",
        "App\Models\Test",
        "Filament\Forms",
        "Filament\Forms\Form",
        "Filament\Resources\Resource",
        "Filament\Tables",
        "Filament\Tables\Table",
        "Illuminate\Database\Eloquent\Builder",
        "Illuminate\Database\Eloquent\SoftDeletingScope",
    ];

    $importData = $class->analyze()->imports();

    expect($importData)
        ->toBeInstanceOf(\Nxu\PhpNanoClassParser\Analyzer\Analyses\Imports::class)
        ->toHaveProperty('firstLine', $start)
        ->toHaveProperty('lastLine', $end)
        ->and($importData->imports)
        ->toMatchArray($imports);
});

it('handles empty class', function () {
    $class = PhpClass::parse(stub('empty-class.php.stub'));

    $importData = $class->analyze()->imports();

    expect($importData)->toBeNull();
});
