<?php

$finder = PhpCsFixer\Finder::create()
    ->in(__DIR__.'/src')
;

return PhpCsFixer\Config::create()
    ->setRules([
        '@Symfony'         => true,
        'array_syntax'     => ['syntax' => 'short'],
        'phpdoc_order'     => true,
        'phpdoc_line_span' => ['property' => 'single'],
    ])
    ->setFinder($finder)
;
