<?php

/**
 **
 ** This is a test controller used for unit testing certain scenarios
 ** It is also referenced in the routes.php file for the path /foo
 **
 */

class Test extends Wayfinder {

    function __construct() {
    }

    public function index() {
        echo 'test/index';
    }

    public function second() {
        echo 'test/second';
    }

    public function third($param, $p, $b) {
        $output = [
            'controllerMethod' => 'test/third',
            'params' => func_get_args()
        ];
        if($this->getMimeType() != 'json') {
            var_dump($output['params']);
            return $output;
        }
        echo json_encode($output);
    }

    public function fourth($p1) {
        $output = [
            'p1' => $p1
        ];
        if($this->getMimeType() != 'json') {
            var_dump($output);
            return $output;
        }
        echo json_encode($output);
    }

    public function fifth($p1) {
        // does nothing, but enforces a param to be passed
    }

}
