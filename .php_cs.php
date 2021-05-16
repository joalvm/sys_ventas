<?php

use PhpCsFixer\Config;
use PhpCsFixer\Finder;

$finder = Finder::create()
    ->exclude(['vendor/', 'node_modules/', 'public/', 'storage/'])
    ->in(getcwd())
    ->name('*.php')
    ->notName('*.blade.php')
    ->notName('_ide_helper.php')
    ->ignoreDotFiles(true)
    ->ignoreVCS(true)
;

$rules = [
    '@PhpCsFixer' => true,
    'single_line_throw' => false,
    'no_empty_comment' => false,
    'new_with_braces' => false,
    'concat_space' => ['spacing' => 'one'],
    'ordered_imports' => [
        'sort_algorithm' => 'alpha',
    ],
];

return (new Config())
    ->setRules($rules)
    ->setFinder($finder)
    ->setUsingCache(false)
;
