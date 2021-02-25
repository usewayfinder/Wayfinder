<?php

$_routes = [
    '/' => [
        'controller' => 'Docs'
    ],
    '/docs' => [
        'controller' => 'Docs',
        'function' => 'documentation'
    ],
    '/examples' => [
        'controller' => 'Docs',
        'function' => 'examples'
    ],
    '/changelog' => [
        'controller' => 'Docs',
        'function' => 'changelog'
    ]
];
