# 🏗️ php-nano-class-parser

This is a very simple package that helps you parse
*some* information about *some* PHP files.

## Philosophy
The intended purpose of this package is to determine the presence
and optionally the vertical position of some statements in a PHP file. This is
useful in situations like programmatically adding extra boilerplate to generated files.

Provided analyses:
- Imports (`use <FQN>;`)
- Class definition (`class Someting {}`)
- Trait uses (`use <Trait>;`)
- First function of a class (`public static function Something {}`)

### My use case
I am maintaining a CMS that is based on Laravel and Filament. Part of the
CMS are commands that generate PHP files (such as Laravel Models and Filament
Resources). During generation, my goals are:
- Use the built-in generators
- Append some custom PHP boilerplate to it

This package helps me determine *where* to add custom namespace uses, member
properties and member functions as crude strings.

### Main features / restrictions
<dl>
  <dt>Extremely mimimal</dt>
  <dd>The package only provides <i>what I need</i>, nothing more.</dd>
  <dt>Fully opinionated</dt>
  <dd>The package provides its functionality exactly <i>how I need it</i>.</dd>
  <dt>Very optimistic</dt>
  <dd>This is a very nice way of saying <i>"I don't really care about edge cases"</i>.</dd>
</dl>

# How?
## Install
```shell
composer require nxu/php-nano-class-parser --dev
```

## Use
### TLDR
```php
$class = PhpClass::parse(
<<<'PHP'
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaravelModel extends Model
{
    use HasFactory;
}
PHP
);

$imports = $class->analyze()->imports();

$imports->firstLine;
// 5
 
$imports->lastLine; 
// 6

$imports->imports; 
// [
//     'Illuminate\Database\Eloquent\Factories\HasFactory',
//     'Illuminate\Database\Eloquent\Model',
// ]
```

### Available analyses
```php
$class = \Nxu\PhpNanoClassParser\PhpClass::parse('...PHP source code...');

$class->analyze()->classDefinition();
$class->analyze()->firstFunction();
$class->analyze()->traits();
$class->analyze()->imports();
```

# License
This package is licensed under the MIT license.
