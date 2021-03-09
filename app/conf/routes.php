<?php

$_routes = [
    '/' => [
        'controller' => 'documentation',
        'method' => 'home'
    ],
    '/examples' => [
        'controller' => 'documentation',
        'method' => 'examples'
    ],
    '/changelog' => [
        'controller' => 'documentation',
        'method' => 'changelog'
    ],
    '/readdocs' => [
        'controller' => 'documentation',
        'method' => 'readdocs'
    ],
    '/foo' => [
        'controller' => 'test',
        'method' => 3
    ]
];
