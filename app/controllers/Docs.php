<?php

class Docs extends Wayfinder {

    function __construct() {
    }

    public function index() {
        $data = [
            'title' => 'Wayfinder'
        ];

        $this->load('views', 'docs/global/header', $data);
        $this->load('views', 'docs/index', $data);
        $this->load('views', 'docs/global/footer', $data);
    }

    public function documentation() {
        $data = [
            'title' => 'Wayfinder documentation',
            'subtitle' => 'The simple routing framework for PHP'
        ];

        $this->load('views', 'docs/global/header', $data);
        $this->load('views', 'docs/docs', $data);
        $this->load('views', 'docs/global/footer', $data);
    }

    public function examples() {
        $data = [
            'title' => 'Wayfinder examples',
            'subtitle' => 'How routing works in Wayfinder'
        ];

        $this->load('views', 'docs/global/header', $data);
        $this->load('views', 'docs/examples', $data);
        $this->load('views', 'docs/global/footer', $data);
    }

    public function changelog() {
        $data = [
            'title' => 'Changelog'
        ];

        $this->load('views', 'docs/global/header', $data);
        $this->load('views', 'docs/changelog', $data);
        $this->load('views', 'docs/global/footer', $data);
    }

}
