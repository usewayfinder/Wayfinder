<?php

class Documentation extends Wayfinder {

    function __construct() {
    }

    public function home() {
        $data = [
            'title' => 'Wayfinder',
            'subtitle' => 'A simple routing framework for PHP'
        ];

        $this->load('views', 'docs/global/header', $data);
        $this->load('views', 'docs/index', $data);
        $this->load('views', 'docs/global/footer', $data);
    }

    public function index() {
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
            'title' => 'Change log'
        ];

        $this->load('views', 'docs/global/header', $data);
        $this->load('views', 'docs/changelog', $data);
        $this->load('views', 'docs/global/footer', $data);
    }

    public function controllers() {
        $data = [
            'title' => 'Controllers in Wayfinder'
        ];

        $this->load('views', 'docs/global/header', $data);
        $this->load('views', 'docs/controllers', $data);
        $this->load('views', 'docs/global/footer', $data);
    }

    public function models() {
        $data = [
            'title' => 'Models in Wayfinder'
        ];

        $this->load('views', 'docs/global/header', $data);
        $this->load('views', 'docs/models', $data);
        $this->load('views', 'docs/global/footer', $data);
    }

    public function views() {
        $data = [
            'title' => 'Views in Wayfinder'
        ];

        $this->load('views', 'docs/global/header', $data);
        $this->load('views', 'docs/views', $data);
        $this->load('views', 'docs/global/footer', $data);
    }

    public function database() {
        $data = [
            'title' => 'Working with a MySQL database with Wayfinder'
        ];

        $this->load('views', 'docs/global/header', $data);
        $this->load('views', 'docs/database', $data);
        $this->load('views', 'docs/global/footer', $data);
    }

    public function libraries() {
        $data = [
            'title' => 'Libraries in Wayfinder',
            'subtitle' => 'Extend Wayfinder by bringing your own libraries'
        ];

        $this->load('views', 'docs/global/header', $data);
        $this->load('views', 'docs/libraries', $data);
        $this->load('views', 'docs/global/footer', $data);
    }

}
