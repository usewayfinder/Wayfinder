<?php

$routes = [
    '/' => [
        'controller' => 'documentation',
        'method' => 'home',
        'params' => [
            'test'
        ]
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
    ],
    '/bar' => [
        'controller' => 'test',
        'method' => 3,
        'params' => [
            'predefinedparam'
        ]
    ]
];

define('ROUTES', $routes);
