<?php

# Toggle for maintenance mode
define('__MAINTENANCE_MODE', false);

# treat /xyz as user defined route
define('__CATCH_FIRST_PARAM', false);

# Are we in production?
function setMode($var) {
    $env = getenv($var);
    if($env == 'production') {
        return true;
    }
    return false;
}

# Toggle for production
define('__PRODUCTION', setMode('environment'));
