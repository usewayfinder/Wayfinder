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

// Toggle for maintenance mode
define('__MAINTENANCE_MODE', false);

// treat /xyz as user defined route
define('__CATCH_FIRST_PARAM', false);

// List of files to use as error templates
define(
    '__ERROR_TEMPLATES',
   [
    'docs/global/header',
    'errors',
    'docs/global/footer',
   ]
);

/**
 * Check if we are in production mode or not
 * setMode()
 *
 * @param string $var the name of the enviroment
 *
 * @return bool true if it is production, false if not
 * @access public
 */
function setMode($var)
{
    $env = getenv($var);
    if ($env == 'production') {
        return true;
    }
    return false;
}

// Toggle for production
define('__PRODUCTION', setMode('environment'));

// IF this is NOT production
if (!__PRODUCTION) {
    // DISPLAY ALL THE ERRORS
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
}
