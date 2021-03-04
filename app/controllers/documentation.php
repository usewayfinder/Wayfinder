<?php

class Documentation extends Wayfinder {

    function __construct() {
    }

    public function home() {
        $data = [
            'pageId' => 'home',
            'title' => 'Wayfinder',
            'subtitle' => 'The framework for <strong>custom routing</strong> and <strong>rapid protoyping</strong> in PHP'
        ];

        $this->_loadPage('index', $data);
    }

    public function index() {
        $data = [
            'title' => 'Wayfinder documentation'
        ];

        $this->_loadPage('docs', $data);
    }

    public function examples() {
        $data = [
            'title' => 'Wayfinder examples',
            'subtitle' => 'How routing works in Wayfinder'
        ];

        $this->_loadPage('examples', $data);
    }

    public function changelog() {
        $data = [
            'title' => 'Change log'
        ];

        $this->_loadPage('changelog', $data);
    }

    public function routes() {
        $data = [
            'title' => 'Routes in Wayfinder'
        ];

        $this->_loadPage('routes', $data);
    }

    public function controllers() {
        $data = [
            'title' => 'Controllers in Wayfinder'
        ];

        $this->_loadPage('controllers', $data);
    }

    public function models() {
        $data = [
            'title' => 'Models in Wayfinder'
        ];

        $this->_loadPage('models', $data);
    }

    public function views() {
        $data = [
            'title' => 'Views in Wayfinder'
        ];

        $this->_loadPage('views', $data);
    }

    public function database() {
        $data = [
            'title' => 'Databases in Wayfinder'
        ];

        $this->_loadPage('database', $data);
    }

    public function libraries() {
        $data = [
            'title' => 'Libraries in Wayfinder'
        ];

        $this->_loadPage('libraries', $data);
    }

    public function cli() {
        $data = [
            'title' => 'The Wayfinder <abbr title="Command Line Interface">CLI</abbr>'
        ];

        $this->_loadPage('cli', $data);
    }

    public function errors() {
        $data = [
            'title' => 'Errors in Wayfinder'
        ];

        $this->_loadPage('errors', $data);
    }

    private function _loadPage($page, $data) {
        $this->load('views', 'docs/global/header', $data);
        $this->load('views', 'docs/'.$page, $data);
        $this->load('views', 'docs/global/footer', $data);
    }

}
