<?php

/*----------------------------------------
 * Wayfinder
 *----------------------------------------
 *
 * Version v0.1
 *
 */

class Wayfinder {

    private $_uri,
            $_class = false,
            $_function = 'index',
            $_params = [],
            $_routes = [],
            $_error;
    var $mode;

    // __constructor, begins the routing instantly
    function __construct() {

        $this->mode = php_sapi_name();

        $this->_setURI();

        require_once($this->realFilePath().'Errors.php');
        $this->_error = new Errors();

        // fetch routes
        require_once($this->realFilePath().'../app/conf/routes.php');
        $this->_routes = $_routes;
        // if this is the homepage
        if($this->_uri === '/') {
            // check that a default route has been set
            if(!isset($this->_routes[$this->_uri])) {
                throw new \Exception("No default route specified", '001');
            } else {
                // check if a function has been set
                if(isset($this->_routes[$this->_uri]['function'])) {
                    $this->_function = $this->_routes[$this->_uri]['function'];
                }
                $this->_class = $this->_routes[$this->_uri]['controller'];
                if(isset($this->_routes[$this->_uri]['params'])) {
                    $this->_params = $this->_routes[$this->_uri]['params'];
                }
            }
        } else {
            // go off and calcualte the route from the URI
            $this->_calculateRoute();
        }
        // load the controller
        $this->_loadController();
    }

    // a public function that can be used to load a file from within the app folder
    public function load($type, $filename, $data = []) {
        if($type == 'views') {
            // convert data to variables which is useful for templates
            if(!is_null($data)) {
                foreach($data as $key => $val) {
                    // variable variable
                    ${$key} = $val;
                }
            }
        }
        // if the file cannot be found
        if(!@include($this->realFilePath().'../app/'.$type.'/'.$filename.'.php')) {
            $this->_error->index(500);
            exit;
        }
    }

    public function error($error) {
        return $this->_error->error($error);
    }

    public function realFilePath($file = false) {
        if(!$file) {
            $file = __FILE__;
        }
        return realpath(dirname($file)).'/';
    }

    private function _setURI() {
        // check this isn't the command line or if this is PHPUNIT
        if($this->mode != 'cli' || strpos($_SERVER['argv'][0], 'phpunit') !== FALSE) {
            // ignore query strings
            $this->_uri = explode('?', $_SERVER['REQUEST_URI'])[0];
        } else {
            var_dump($_SERVER['argv']);
            exit;
            if(isset($_SERVER['argv'][1])) {
                $this->_uri = $_SERVER['argv'][1];
            } else {
                $this->_uri = '/';
            }
        }
    }

    // calculate what how the routing should be handled
    private function _calculateRoute() {
        // break apart the URL
        $parts = explode('/', $this->_uri);
        $parts = $this->_tidyParams($parts);
        // now check if routing is required
        $this->_checkIfRoutingRequired();

        // if the class is empty after checking the routes
        if(!$this->_class) {
            $this->_class = $parts[0];
            if(isset($parts[1])) {
                $this->_function = $parts[1];
            }
            if(isset($parts[2])) {
                array_push($this->_params, array_slice($parts, 2));
            }
        }
    }

    // check if a specific route that overrides the expected /controller/function input
    private function _checkIfRoutingRequired() {
        foreach($this->_routes as $route => $parts) {
            if($route != '/') {
                if($this->_validRoute($route)) {
                    $this->_class = $parts['controller'];
                    if(isset($parts['function'])) {
                        $this->_function = $parts['function'];
                    }
                    if(isset($parts['params'])) {
                        $this->_params = $parts['params'];
                    }
                    $pathParams = explode($route, $this->_uri);
                    $parts = explode('/', $pathParams[1]);
                    $parts = $this->_tidyParams($parts);
                    if(!!$parts) {
                        $this->_params = array_merge($this->_params, $parts);
                    }
                    return true;
                }
            }
        }
        return false;
    }

    // the logic for deciding if the route is valid
    private function _validRoute($route) {
        // keep this for later
        $uriLength = strlen($this->_uri);
        // if the route matches exactly
        if($this->_uri == $route) {
            return true;
        }
        // if the route matches exactly (but has a trailing slash)
        if(substr($this->_uri, -1) == '/' && substr($this->_uri, 0, $uriLength-1) == $route) {
            return true;
        }
        // this is the route + a trailing slash + more content
        if(strpos($this->_uri, $route.'/') === 0) {
            return true;
        }
        return false;
    }

    // when it's all said and done, load the controller and run the correct function
    private function _loadController() {
        $this->load('controllers', $this->_class);
        if(class_exists($this->_class)) {
            $c = new $this->_class;
            $function = $this->_function;
            // call the function and pass the params indivudally instead of as an array
            if(method_exists($c, $function)) {
                $c->$function(...$this->_params);
            } else {
                $this->_error->index(404);
                exit;
            }
        } else {
            $this->_error->index(404);
            exit;
        }
    }

    // tidy up parameters by chopping off empty starting and ending elements
    private function _tidyParams($params) {
        // first item is empty? drop it
        if($params[0] == '') {
            array_shift($params);
        }
        // last item is empty? drop it
        if(end($params) == '') {
            array_pop($params);
        }
        if(count($params) > 0) {
            return $params;
        }
        return false;
    }


}
