<?php

class Errors extends Wayfinder {

    function __construct() {
    }

    public function index($error) {
        $data = $this->error($error);
        $this->load('views', 'docs/global/header', $data);
        $this->load('views', 'errors', $data);
        $this->load('views', 'docs/global/footer', $data);
    }

}
