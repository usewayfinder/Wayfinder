<?php

/**
 * ----------------------------------------
 * Wayfinder
 * ----------------------------------------
 *
 * @category Public_End_Point
 * @package  Wayfinder
 * @author   Charanjit Chana <hello@charanj.it>
 * @license  https://spdx.org/licenses/MIT.html MIT License
 * @version  0.12
 * @link     http://www.usewayfinder.com
 **/

// Fetch the Wayfinder framework
require_once '../framework/Wayfinder.php';

// Global variable for holding the REQUEST_URI, this will fail as part of unit tests
if (isset($_SERVER['REQUEST_URI'])) {
    define('REQUEST_URI', $_SERVER['REQUEST_URI']);
}
//@define('ARGV', $_SERVER['argv']);

// Let's go!
$wf = new Wayfinder();
$wf->init();
