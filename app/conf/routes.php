<?php

/**
 * ----------------------------------------
 * Wayfinder
 * ----------------------------------------
 *
 * @category Config_File
 * @package  Wayfinder
 * @author   Charanjit Chana <hello@charanj.it>
 * @license  https://spdx.org/licenses/MIT.html MIT License
 * @version  0.12
 * @link     http://www.usewayfinder.com
 **/

$routes = [
           '/'          => [
                            'controller' => 'documentation',
                            'method'     => 'home',
                            'params'     => ['test'],
                           ],
           '/examples'  => [
                            'controller' => 'documentation',
                            'method'     => 'examples',
                           ],
           '/changelog' => [
                            'controller' => 'documentation',
                            'method'     => 'changelog',
                           ],
           '/readdocs'  => [
                            'controller' => 'documentation',
                            'method'     => 'readdocs',
                           ],
           '/foo'       => [
                            'controller' => 'test',
                            'method'     => 3,
                           ],
           '/bar'       => [
                            'controller' => 'test',
                            'method'     => 3,
                            'params'     => ['predefinedparam'],
                           ],
          ];

define('ROUTES', $routes);
