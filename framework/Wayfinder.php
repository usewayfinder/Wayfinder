<?php

/*----------------------------------------
 * Wayfinder
 *----------------------------------------
 *
 * Version v0.12
 *
 */

# Load required files
$realPath = realpath(dirname(__FILE__));
require($realPath.'/../app/conf/config.php');
require($realPath.'/../app/conf/routes.php');
require($realPath.'/Errors.php');

class Wayfinder {

    private $_url,
            $_routes = [],
            $_controller,
            $_method = 'index',
            $_params = [],
            $_error,
            $_mimeType,
            $_mode;

    # __construct()
    function __construct() {
        # get the current mode (cli/browser?)
        $this->_mode = php_sapi_name();
        # IF not command line
        if($this->_mode != 'cli') {
            $this->_checkMaintenanceMode();
        # else
        } else {
            # Secondary check to ignore if phpunit
            if(strpos($_SERVER['argv'][0], 'phpunit') === FALSE) {
                // IF the path was passed
                if(isset($_SERVER['argv'][1])) {
                    $_SERVER['REQUEST_URI'] = $_SERVER['argv'][1];
                // ELSE resort to the default route
                } else {
                    $_SERVER['REQUEST_URI'] = '/';
                }
            }
        }
    }

    # init()
    public function init($processUrl = true) {

        # Remove any query strings and make it lower case
        $url = explode('?', $_SERVER['REQUEST_URI'])[0];

        # Set the MIME type and return the URL
        $this->_url = $this->_setMimeType($url);

        # IF processing the URL
        if($processUrl) {

            # IF Error class not yet loaded
            if(is_null($this->_error)) {
                // Assign Error class
                $this->_error = new Errors();
            }

            # IF ROUTES not yet stored
            if(is_null($this->_routes) || empty($this->_routes)) {
                // Store routes
                $this->_routes = ROUTES;
            }

            # Direct Wayfinder to the right place
            $this->_direct();

            # Finally, load the controller
            $this->_loadController();

        }
    }

    # realFilePath()
    public function realFilePath($file = false) {
        # IF no file specified, use the current file
        if(!$file) {
            $file = __FILE__;
        }
        # return the real path for the file specified
        return realpath(dirname($file)).'/';
    }

    # load()
    public function load($type, $filename, $data = []) {
        # IF the type of file is a view
        if($type == 'views') {
            # check $data is not null
            if(!is_null($data)) {
                # FOREACH key in $data, turn it into a variable for use in templates
                foreach($data as $key => $val) {
                    ${$key} = $val;
                }
            }
            # SILENTLY load the view
            !@include($this->realFilePath().'../app/'.$type.'/'.$filename.'.php');
        # ELSE only load the file once
        } else {
            # IF the file cannot be found
            if(!@include_once($this->realFilePath().'../app/'.$type.'/'.$filename.'.php')) {
                # 404
                $this->_error->index(404);
                exit;
            }
        }
    }

    # redirect()
    public function redirect($location, $code = 301) {
        # Take the location and redirect (301/permanent redirect by default)
        header('Location: '.$location, true, $code);
        exit;
    }

    # error()
    public function error($error) {
        # Return the appropriate error
        return $this->_error->error($error);
    }

    # getMimeType()
    public function getMimeType() {
        # IF the URL is not set correctly
        if(is_null($this->_url)) {
            # Set the URL but do not reprocess Wayfinder routing
            $this->init(false);
        }
        # Set the MiME type based on the URL
        $url = strtolower($this->_url);
        $this->_setMimeType($url);
        # Return MIME type
        return $this->_mimeType;
    }

    # _direct()
    private function _direct() {
        # IF this isn't the default route
        if($this->_url != '/') {
            # Calculate which controller to use
            $this->_calculateController();
        } else {
            # Take the default route's controller and use it
            $this->_controller = $this->_routes['/']['controller'];
            # Take the URL parts and calculate the correct method to use
            $urlParts = $this->_calculateMethodWithRoute($this->_routes['/'], 0, 0, []);
        }
    }

    # _calculateController()
    private function _calculateController() {
        # IF this is not a valid route
        if(!$this->_checkRoutes()) {
            # Take the URL and convert it to call the most apprioriate controller
            if(!$this->_urlToController()) {
                $this->_controller = $this->_routes['/']['controller'];
                if(isset($this->_routes['/']['method'])) {
                    $this->_method = $this->_routes['/']['method'];
                }
                $pathParams = explode('/', $this->_url);
                $pathParams = $this->_tidyPathArray($pathParams);
                $params = [];
                if(isset($this->_routes['/']['params'])) {
                    $params = $this->_routes['/']['params'];
                }
                $this->_params = array_merge($params, $pathParams);
            }
        }
    }

    # _checkRoutes()
    private function _checkRoutes() {
        # Assume route is not valud
        $validRoute = false;

        #FOREACH route, break it into it's route and the associated config
        foreach($this->_routes as $route => $config) {

            # Ignore the default route
            if($route != '/') {

                # IF the route was found
                if($this->_routeFound($route)) {

                    # Explode the route into parts
                    # Tidy the parts to remove empty elements at the beginning and end
                    $routeParts = explode('/', $route);
                    $routeParts = $this->_tidyPathArray($routeParts);

                    # Explode the URL into parts
                    # Tidy the parts to remove empty elements at the beginning and end
                    $urlParts = explode('/', $this->_url);
                    $urlParts = $this->_tidyPathArray($urlParts);

                    # Iterator for calculating when a route stops and params begin
                    $i = 0;

                    # FOREACH part of the route
                    foreach($routeParts as $part) {
                        # IF this part of the route matches the URL
                        if(isset($urlParts[$i]) && $urlParts[$i] == $part) {
                            # Increment the iterator
                            $i++;
                        } else {
                            # We're at the end of the route
                            # Break out of the foreach loop
                            break;
                        }
                    }

                    # Store the matched route
                    # Assign the controller
                    $matchedRoute = $this->_routes[$route];
                    $this->_controller = $matchedRoute['controller'];

                    # IF the matched route has a method
                    if(isset($matchedRoute['method'])) {
                        # IF the method is named
                        if(!is_numeric($matchedRoute['method'])) {
                            # Assign the method name
                            $this->_method = $matchedRoute['method'];
                            # Remove the controller and method from the parts of the URL
                            $urlParts = array_slice($urlParts, $i);
                            # Calculate what the params should be based on the route config and the URL
                            $this->_calculateParams($matchedRoute, $urlParts);
                        # ELSE
                        } else {
                            # Calculate the Index of the method in the URL
                            $methodIndex = $matchedRoute['method'] + $i - 1;
                            # Calcualte what the params should be based on the route config and the URL
                            $urlParts = $this->_calculateMethodWithRoute($matchedRoute, $methodIndex, $i, $urlParts);
                        }
                    }

                    # The route has been validated
                    $validRoute = true;

                    # No more checks required
                    # Break out of the foreach loop
                    break;

                }
            }

        }

        # return the valid route
        return $validRoute;
    }

    # _calculateMethodWithRoute()
    private function _calculateMethodWithRoute($routeConfig, $methodIndex, $controllerCount, $urlParts) {
        # IF the route has a method
        if(isset($routeConfig['method'])) {
            # IF the method is named
            if(!is_numeric($routeConfig['method'])) {
                # Store the method name
                $this->_method = $routeConfig['method'];
            # ELSE
            } else {
                # IF the URL has enough parts
                if(isset($urlParts[$methodIndex])) {
                    # Store the method name
                    $this->_method = strtolower($urlParts[$methodIndex]);
                    # Remove method from the URL parts
                    unset($urlParts[$methodIndex]);

                    # Break the URL apart to help identify the params
                    $urlParams = array_slice($urlParts, $controllerCount);

                    # Calcualte the params that should be passed
                    $this->_calculateParams($routeConfig, $urlParams);
                # ELSE
                } else {
                    # Method was expectd, but is not available
                    $this->_method = false;
                }
            }
        }
        # return the remaining parts of the URL
        return $urlParts;
    }

    # _calculateParams()
    private function _calculateParams($routeConfig, $additionalParams) {
        # IF params are set in the route config
        if(isset($routeConfig['params'])) {
            # Store the predefined params
            $this->_params = $routeConfig['params'];
        }
        # IF there are additional params
        if(!empty($additionalParams)) {
            # IF there are existing params stored
            if(!is_null($this->_params)) {
                # Merge the exisitng and additional params
                $this->_params = array_merge($this->_params, $additionalParams);
            } else {
                # Store the params
                $this_params = $additionalParams;
            }
        }
    }

    # _urlToController()
    private function _urlToController() {
        # Break apart the URL
        # Tidy the params
        $urlParts = explode('/', $this->_url);
        $urlParts = $this->_tidyPathArray($urlParts);

        # The first part of the URL is the controller
        $this->_controller = strtolower($urlParts[0]);

        # IF the Catch All is disabled, then carry on
        # OR
        # IF the Catch all is enabled AND the controller specified exists, then carry on
        if(!__CATCH_FIRST_PARAM || (__CATCH_FIRST_PARAM && file_exists($this->realFilePath().'../app/controllers/'.$this->_controller.'.php'))) {
            # IF there's a second part
            if(isset($urlParts[1])) {
                # Use that as the method
                $this->_method = strtolower($urlParts[1]);
            }
            # The params are anything else that's left
            $this->_params = array_splice($urlParts, 2);
            return true;
        }
        return false;
    }

    # _routeFound()
    private function _routeFound($route) {
        # IF there is a trailing slash
        if(substr($route, -1) == '/') {
            # Remove the trailing slash
            $route = substr($route, 0, -1);
        }

        # Get the length of the URL
        $uriLength = strlen($this->_url);
        # IF the route matches the URL
        if($route === $this->_url) {
            # route found!
            return true;
        }

        # IF the URL starts ends with a slash AND it matches a route
        if(substr($this->_url, -1) == '/' && substr($this->url, 0, $uriLength-1) == $route) {
            # route found!
            return true;
        }
        # IF this is the route + a trailing slash + more content
        if(strpos($this->_url, $route.'/') === 0) {
            # route found!
            return true;
        }
        # no route found :(
        return false;
    }

    # _tidyPathArray()
    private function _tidyPathArray($pathArray) {
        # first item is empty? drop it
        if($pathArray[0] == '') {
            array_shift($pathArray);
        }
        # last item is empty? drop it
        if(end($pathArray) == '') {
            array_pop($pathArray);
        }
        # If the array is not empty now
        if(count($pathArray) > 0) {
            # return the array
            return $pathArray;
        }
        return false;
    }

    # _loadController
    private function _loadController() {
        # Load the specified controller
        $this->load('controllers', $this->_controller);
        # IF the class exists (matching controller name)
        if(class_exists($this->_controller)) {
            # Invoke the controller
            $c = new $this->_controller;
            # Store the method
            $method = $this->_method;
            # IF the method exists in the class
            if(method_exists($c, $method)) {
                # Call the method along with it's params
                $c->$method(...$this->_params);
            # ELSE
            } else {
                # 404
                $this->_error->index(404);
                exit;
            }
        # ELSE
        } else {
            # 404
            $this->_error->index(404);
            exit;
        }
    }

    # _setMimeType()
    private function _setMimeType($url) {
        # Break apart the URL
        $parts = explode('/', $url);
        # Break the last part of the URL to check for file extensions
        $filenameParts = explode('.', end($parts));
        $validExtensions = [
            'rss',
            'atom',
            'xml',
            'json',
            'txt',
            'html'
        ];
        # The header shouldn't need to be header suppressed
        $suppressHeader = false;
        # IF this is phpunit though, suppress away
        if(isset($_SERVER['argv'][0]) && strpos($_SERVER['argv'][0], 'phpunit') !== FALSE) {
            $suppressHeader = true;
        }
        # Store the extensions
        $extension = end($filenameParts);
        # IF the last part is a valid extension that Wayfinder can deal with
        if(in_array($extension, $validExtensions)) {
            # Switch based on the extension
            switch($extension) {
                case 'rss':
                    $this->_mimeType = 'rss';
                    if(!$suppressHeader) {
                        header('Content-Type: application/xml; charset=utf-8');
                    }
                    break;
                case 'atom':
                    $this->_mimeType = 'atom';
                    if(!$suppressHeader) {
                        header('Content-Type: application/xml; charset=utf-8');
                    }
                    break;
                case 'xml':
                    $this->_mimeType = 'xml';
                    if(!$suppressHeader) {
                        header('Content-Type: application/xml; charset=utf-8');
                    }
                    break;
                case 'json':
                    $this->_mimeType = 'json';
                    if(!$suppressHeader) {
                        header('Content-Type: application/json');
                    }
                    break;
                case 'txt':
                    $this->_mimeType = 'txt';
                    if(!$suppressHeader) {
                        header('Content-Type:text/plain');
                    }
                    break;
                default:
                    $this->_mimeType = 'html';
                    if(!$suppressHeader) {
                        header('Content-Type:text/html');
                    }
            }
            # Remove the extension from the filename parts
            array_pop($filenameParts);
        }
        # Rejoin the filename without the extension, catering for any periods the name included before
        $reconstructedFilename = join('.', $filenameParts);
        # Pop the entire filename from the original URL
        array_pop($parts);
        # Re-add the filename, minus the extension
        array_push($parts, $reconstructedFilename);
        # Return the joint URL
        return join('/', $parts);
    }

}
