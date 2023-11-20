<?php

/**
 * ----------------------------------------
 * Wayfinder
 * ----------------------------------------
 *
 * @category Master_Class
 * @package  Wayfinder
 * @author   Charanjit Chana <hello@charanj.it>
 * @license  https://spdx.org/licenses/MIT.html MIT License
 * @version  0.12
 * @link     http://www.usewayfinder.com
 **/

// Load required files
$realPath = realpath(dirname(__FILE__));
require $realPath.'/../app/conf/config.php';
require $realPath.'/../app/conf/routes.php';
require $realPath.'/Errors.php';

/**
 * Wayfinder is the base class for the routing and helper functionality for the Wayfinder framework
 *
 * @category Framework_Class
 * @package  Wayfinder
 * @author   Charanjit Chana <hello@charanj.it>
 * @license  https://spdx.org/licenses/MIT.html MIT License
 * @version  0.12
 * @link     http://www.usewayfinder.com
 */
class Wayfinder
{

    private $_url;
    private $_routes = [];
    private $_controller;
    private $_method = 'index';
    private $_params = [];
    private $_error;
    private $_mimeType;
    private $_mode;

    /**
     * __construct() function that runs when the class is instantiated
     *
     * @access private
     */
    function __construct()
    {
        // get the current mode (cli/browser?)
        $this->_mode = php_sapi_name();
        // IF not command line
        if ($this->_mode != 'cli') {
            //$this->_checkMaintenanceMode();
        } else {
            // Secondary check to ignore if phpunit
            var_dump($_SERVER);
            if (strpos($_SERVER['argv'][0], 'phpunit') === false) {
                // IF the path was passed
                if (isset($_SERVER['argv'][1])) {
                    define('INTERNAL_REQUEST_URI', $_SERVER['argv'][1]);
                } else {
                    // ELSE resort to the default route
                    define('INTERNAL_REQUEST_URI', '/');
                }
            }
        }
    }

    /**
     * Default function for the routing of Wayfinder
     * init()
     *
     * @param bool $processUrl determine if the URL and MIME Type is set AND the URL is processed or if the last part is skipped
     *
     * @return void
     * @access public
     */
    public function init($processUrl = true)
    {

        // Remove any query strings and make it lower case
        $url = explode('?', INTERNAL_REQUEST_URI)[0];

        // Set the MIME type and return the URL
        $this->_url = $this->_setMimeType($url);

        // IF processing the URL
        if ($processUrl) {

            // IF Error class not yet loaded
            if ($this->_error === null) {
                // Assign Error class
                $this->_error = new Errors();
            }

            // IF ROUTES not yet stored
            if ($this->_routes === null || empty($this->_routes)) {
                // Store routes
                $this->_routes = ROUTES;
            }

            // Direct Wayfinder to the right place
            $this->_direct();

            // Finally, load the controller
            $this->_loadController();

        }
    }

    /**
     * Get the file's real path
     * realFilePath()
     *
     * @param string $file specify a specific file, otherwise the current file is taken
     *
     * @return string file path
     * @access public
     */
    public function realFilePath($file = false)
    {
        // IF no file specified, use the current file
        if (!$file) {
            $file = __FILE__;
        }
        // return the real path for the file specified
        return realpath(dirname($file)).'/';
    }

    /**
     * Load other files from the file system
     * load()
     *
     * @param string $type     is this a view, a controller or a model?
     * @param string $filename the filename (and filepath if required)
     * @param array  $data     an associative array with a key => val pair that views can use. The keys become variables that are accessible within the view
     *
     * @return void
     * @access public
     */
    public function load($type, $filename, $data = [])
    {
        // IF the type of file is a view
        if ($type == 'views') {
            // check $data is not null
            if ($data !== null) {
                // FOREACH key in $data, turn it into a variable for use in templates
                foreach ($data as $key => $val) {
                    ${$key} = $val;
                }
            }
            // SILENTLY load the view
            !@include $this->realFilePath().'../app/'.$type.'/'.$filename.'.php';
        } else {
            // ELSE only load the file once
            // IF the file cannot be found
            if (!@include_once $this->realFilePath().'../app/'.$type.'/'.$filename.'.php') {
                // 404
                $this->_error->index(404);
                exit;
            }
        }
    }

    /**
     * A method to handle redirects
     * redirect()
     *
     * @param string $location the location to redirect to
     * @param int    $code     the redirect code
     *
     * @return void
     * @access public
     */
    public function redirect($location, $code = 301)
    {
        // Take the location and redirect (301/permanent redirect by default)
        header('Location: '.$location, true, $code);
        exit;
    }

    /**
     * Get the error message from the error Class
     * error()
     *
     * @param string $error the error message
     *
     * @return array the error code and info
     * @access public
     */
    public function error($error)
    {
        // Return the appropriate error
        return $this->_error->error($error);
    }

    /**
     * Get the MIME type
     * getMimeType()
     *
     * @return string the MINE type
     * @access public
     */
    public function getMimeType()
    {
        // IF the URL is not set correctly
        if ($this->_url === null) {
            // Set the URL but do not reprocess Wayfinder routing
            $this->init(false);
        }
        // Set the MiME type based on the URL
        $url = strtolower($this->_url);
        $this->_setMimeType($url);
        // Return MIME type
        return $this->_mimeType;
    }

    /**
     * Choose how things are directed
     * _direct()
     *
     * @return void
     * @access private
     */
    private function _direct()
    {
        // IF this isn't the default route
        if ($this->_url != '/') {
            // Calculate which controller to use
            $this->_calculateController();
        } else {
            // Take the default route's controller and use it
            $this->_controller = $this->_routes['/']['controller'];
            // Take the URL parts and calculate the correct method to use
            $urlParts = $this->_calculateMethodWithRoute($this->_routes['/'], 0, 0, []);
        }
    }

    /**
     * Calculate the controller
     * _calculateController()
     *
     * @return void
     * @access private
     */
    private function _calculateController()
    {
        // IF this is not a valid route
        if (!$this->_checkRoutes()) {
            // Take the URL and convert it to call the most apprioriate controller
            if (!$this->_urlToController()) {
                $this->_controller = $this->_routes['/']['controller'];
                if (isset($this->_routes['/']['method'])) {
                    $this->_method = $this->_routes['/']['method'];
                }
                $pathParams = explode('/', $this->_url);
                $pathParams = $this->_tidyPathArray($pathParams);
                $params = [];
                if (isset($this->_routes['/']['params'])) {
                    $params = $this->_routes['/']['params'];
                }
                $this->_params = array_merge($params, $pathParams);
            }
        }
    }

    /**
     * Check routes
     * _checkRoutes()
     *
     * @return string valid route
     * @access private
     */
    private function _checkRoutes()
    {
        // Assume route is not valud
        $validRoute = false;

        // FOREACH route, break it into it's route and the associated config
        foreach ($this->_routes as $route => $config) {

            // Ignore the default route
            if ($route != '/') {

                // IF the route was found
                if ($this->_routeFound($route)) {

                    // Explode the route into parts
                    // Tidy the parts to remove empty elements at the beginning and end
                    $routeParts = explode('/', $route);
                    $routeParts = $this->_tidyPathArray($routeParts);

                    // Explode the URL into parts
                    // Tidy the parts to remove empty elements at the beginning and end
                    $urlParts = explode('/', $this->_url);
                    $urlParts = $this->_tidyPathArray($urlParts);

                    // Iterator for calculating when a route stops and params begin
                    $i = 0;

                    // FOREACH part of the route
                    foreach ($routeParts as $part) {
                        // IF this part of the route matches the URL
                        if (isset($urlParts[$i]) && $urlParts[$i] == $part) {
                            // Increment the iterator
                            $i++;
                        } else {
                            // We're at the end of the route
                            // Break out of the foreach loop
                            break;
                        }
                    }

                    // Store the matched route
                    // Assign the controller
                    $matchedRoute = $this->_routes[$route];
                    $this->_controller = $matchedRoute['controller'];

                    // IF the matched route has a method
                    if (isset($matchedRoute['method'])) {
                        // IF the method is named
                        if (!is_numeric($matchedRoute['method'])) {
                            // Assign the method name
                            $this->_method = $matchedRoute['method'];
                            // Remove the controller and method from the parts of the URL
                            $urlParts = array_slice($urlParts, $i);
                            // Calculate what the params should be based on the route config and the URL
                            $this->_calculateParams($matchedRoute, $urlParts);
                        } else {
                            // Else Calculate the Index of the method in the URL
                            $methodIndex = $matchedRoute['method'] + $i - 1;
                            // Calcualte what the params should be based on the route config and the URL
                            $urlParts = $this->_calculateMethodWithRoute($matchedRoute, $methodIndex, $i, $urlParts);
                        }
                    }

                    // The route has been validated
                    $validRoute = true;

                    // No more checks required
                    // Break out of the foreach loop
                    break;

                }
            }

        }

        // return the valid route
        return $validRoute;
    }

    /**
     * _calculateMethodWithRoute()
     *
     * @param array  $routeConfig     the general route configuration
     * @param string $methodIndex     the method that should be treated as if it was the index
     * @param array  $controllerCount TBC
     * @param array  $urlParts        TBC
     *
     * @return array $urlParts which will have been tidied up as part of the processing
     * @access private
     */
    private function _calculateMethodWithRoute($routeConfig, $methodIndex, $controllerCount, $urlParts)
    {
        // IF the route has a method
        if (isset($routeConfig['method'])) {
            // IF the method is named
            if (!is_numeric($routeConfig['method'])) {
                // Store the method name
                $this->_method = $routeConfig['method'];
            } else {
                // Else IF the URL has enough parts
                if (isset($urlParts[$methodIndex])) {
                    // Store the method name
                    $this->_method = strtolower($urlParts[$methodIndex]);
                    // Remove method from the URL parts
                    unset($urlParts[$methodIndex]);

                    // Break the URL apart to help identify the params
                    $urlParams = array_slice($urlParts, $controllerCount);

                    // Calcualte the params that should be passed
                    $this->_calculateParams($routeConfig, $urlParams);
                } else {
                    // Else method was expectd, but is not available
                    $this->_method = false;
                }
            }
        }
        // return the remaining parts of the URL
        return $urlParts;
    }

    /**
     * _calculateParams()
     *
     * @param array $routeConfig      the route cofiguration and any params that should be set
     * @param array $additionalParams if there are any additional params that should be included in the routing information automatically
     *
     * @return void
     * @access private
     */
    private function _calculateParams($routeConfig, $additionalParams)
    {
        // IF params are set in the route config
        if (isset($routeConfig['params'])) {
            // Store the predefined params
            $this->_params = $routeConfig['params'];
        }
        // IF there are additional params
        if (!empty($additionalParams)) {
            // IF there are existing params stored
            if ($this->_params !== null) {
                // Merge the exisitng and additional params
                $this->_params = array_merge($this->_params, $additionalParams);
            } else {
                // Store the params
                $this_params = $additionalParams;
            }
        }
    }

    /**
     * Take the URL and figure out which controller to use
     * _urlToController()
     *
     * @return boolean has the URL been matched to a controller?
     * @access private
     */
    private function _urlToController()
    {
        // Break apart the URL
        // Tidy the params
        $urlParts = explode('/', $this->_url);
        $urlParts = $this->_tidyPathArray($urlParts);

        // The first part of the URL is the controller
        $this->_controller = strtolower($urlParts[0]);

        // IF the Catch All is disabled, then carry on
        // OR
        // IF the Catch all is enabled AND the controller specified exists, then carry on
        if (!__CATCH_FIRST_PARAM || (__CATCH_FIRST_PARAM && file_exists($this->realFilePath().'../app/controllers/'.$this->_controller.'.php'))) {
            // IF there's a second part
            if (isset($urlParts[1])) {
                // Use that as the method
                $this->_method = strtolower($urlParts[1]);
            }
            // The params are anything else that's left
            $this->_params = array_splice($urlParts, 2);
            return true;
        }
        return false;
    }

    /**
     * _routeFound()
     *
     * @param string $route a route to search for in the routes defined in app/conf/routes.php
     *
     * @return boolean was a matching route found in app/conf/routes.php?
     * @access private
     */
    private function _routeFound($route)
    {
        // IF there is a trailing slash
        if (substr($route, -1) == '/') {
            // Remove the trailing slash
            $route = substr($route, 0, -1);
        }

        // Get the length of the URL
        $uriLength = strlen($this->_url);
        // IF the route matches the URL
        if ($route === $this->_url) {
            // route found!
            return true;
        }

        // IF the URL starts ends with a slash AND it matches a route
        if (substr($this->_url, -1) == '/' && substr($this->url, 0, $uriLength-1) == $route) {
            // route found!
            return true;
        }
        // IF this is the route + a trailing slash + more content
        if (strpos($this->_url, $route.'/') === 0) {
            // route found!
            return true;
        }
        // no route found :(
        return false;
    }

    /**
     * _tidyPathArray()
     *
     * @param array $pathArray an array of items that have been generated by exploding the path
     *
     * @return array returns the array by dropping any empty values that occur because of a trailing slash (or false if the tidied array is empty)
     * @access private
     */
    private function _tidyPathArray($pathArray)
    {
        // first item is empty? drop it
        if ($pathArray[0] == '') {
            array_shift($pathArray);
        }
        // last item is empty? drop it
        if (end($pathArray) == '') {
            array_pop($pathArray);
        }
        // If the array is not empty now
        if (count($pathArray) > 0) {
            // return the array
            return $pathArray;
        }
        return false;
    }

    /**
     * _loadController()
     *
     * @return void
     * @access private
     */
    private function _loadController()
    {
        // Load the specified controller
        $this->load('controllers', $this->_controller);
        // IF the class exists (matching controller name)
        if (class_exists($this->_controller)) {
            // Invoke the controller
            $c = new $this->_controller;
            // Store the method
            $method = $this->_method;
            // IF the method exists in the class
            if (method_exists($c, $method)) {
                // Call the method along with it's params
                $c->$method(...$this->_params);
            } else {
                // Else 404
                $this->_error->index(404);
                exit;
            }
        } else {
            // Else 404
            $this->_error->index(404);
            exit;
        }
    }

    /**
     * Set the MIME type for the page
     * _setMimeType()
     *
     * @param string $url a url to process
     *
     * @return string a url path that has been concatanated
     * @access private
     */
    private function _setMimeType($url)
    {
        if ($this->_mimeType !== null) {
            return $url;
        }
        // Break apart the URL
        $parts = explode('/', $url);
        // Break the last part of the URL to check for file extensions
        $filenameParts = explode('.', end($parts));
        $validExtensions = [
                            'rss',
                            'atom',
                            'xml',
                            'json',
                            'txt',
                            'html',
                           ];
        // The header shouldn't need to be header suppressed
        $suppressHeader = false;
        // IF this is phpunit though, suppress away
        if (isset($_SERVER['argv'][0]) && strpos($_SERVER['argv'][0], 'phpunit') !== false) {
            $suppressHeader = true;
        }
        // Store the extensions
        $extension = end($filenameParts);
        // IF the last part is a valid extension that Wayfinder can deal with
        if (in_array($extension, $validExtensions)) {
            // Switch based on the extension
            switch($extension) {
            case 'rss':
                $this->_mimeType = 'rss';
                if (!$suppressHeader) {
                    header('Content-Type: application/xml; charset=utf-8');
                }
                break;
            case 'atom':
                $this->_mimeType = 'atom';
                if (!$suppressHeader) {
                    header('Content-Type: application/xml; charset=utf-8');
                }
                break;
            case 'xml':
                $this->_mimeType = 'xml';
                if (!$suppressHeader) {
                    header('Content-Type: application/xml; charset=utf-8');
                }
                break;
            case 'json':
                $this->_mimeType = 'json';
                if (!$suppressHeader) {
                    header('Content-Type: application/json');
                }
                break;
            case 'txt':
                $this->_mimeType = 'txt';
                if (!$suppressHeader) {
                    header('Content-Type:text/plain');
                }
                break;
            default:
                $this->_mimeType = 'html';
                if (!$suppressHeader) {
                    header('Content-Type:text/html');
                }
            }
            // if this wasn't the entire path
            if (count($filenameParts) > 1) {
                // Remove the extension from the filename parts
                array_pop($filenameParts);
            }
        }
        // Rejoin the filename without the extension, catering for any periods the name included before
        $reconstructedFilename = join('.', $filenameParts);
        // Pop the entire filename from the original URL
        array_pop($parts);
        // Re-add the filename, minus the extension
        array_push($parts, $reconstructedFilename);
        // Return the joint URL
        return join('/', $parts);
    }

}
