<?php

/**
 * ----------------------------------------
 * Wayfinder
 * ----------------------------------------
 *
 * @category Controller_File
 * @package  Wayfinder
 * @author   Charanjit Chana <hello@charanj.it>
 * @license  https://spdx.org/licenses/MIT.html MIT License
 * @version  0.12
 * @link     http://www.usewayfinder.com
 **/

 /**
  * This is a test controller used for unit testing certain scenarios
  * It is also referenced in the routes.php file for the path /foo
  *
  * @category Controller_Class
  * @package  Wayfinder
  * @author   Charanjit Chana <hello@charanj.it>
  * @license  https://spdx.org/licenses/MIT.html MIT License
  * @version  0.12
  * @link     http://www.usewayfinder.com
  */
class Test extends Wayfinder
{

    /**
     * __construct()
     *
     * @return void
     * @access public
     */
    function __construct()
    {
    }

    /**
     * The route for /test
     * index()
     *
     * @return void
     * @access public
     */
    public function index()
    {
        echo 'test/index';
    }

    /**
     * The route for /test/second
     * second()
     *
     * @return void
     * @access public
     */
    public function second()
    {
        echo 'x';
        echo 'test/second';
    }

    /**
     * The route for /test/third
     * If this is a JSON request, then the output is json_encoded and echoes to screen
     * third()
     *
     * @param array  $param an example param
     * @param string $p     an example param (not used)
     * @param string $b     an example param (not used)
     *
     * @return void
     * @access public
     */
    public function third($param, $p, $b)
    {
        $output = [
                   'controllerMethod' => 'test/third',
                   'params'           => func_get_args(),
                  ];
        if ($this->getMimeType() != 'json') {
            return $output;
        }
        echo json_encode($output);
    }

    /**
     * The route for /test/fourth
     * If this is a JSON request, then the output is json_encoded and echoes to screen
     * fourth()
     *
     * @param string $p1 The first parameter
     *
     * @return void
     * @access public
     */
    public function fourth($p1)
    {
        $output = ['p1' => $p1];
        if ($this->getMimeType() != 'json') {
            var_dump($output);
            return $output;
        }
        echo json_encode($output);
    }

    /**
     * The route for /test/fifth
     * index()
     *
     * @param string $p1 The first parameter
     *
     * @return void
     * @access public
     */
    public function fifth($p1)
    {
        // does nothing, but enforces a param to be passed
    }

}
