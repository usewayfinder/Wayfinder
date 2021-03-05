<?php

class Documentation extends Wayfinder {

    function __construct() {
    }

    public function home() {
        $text = 'A framework for <strong>custom routing</strong> and <strong>rapid protoyping</strong> in PHP';
        $data = [
            'metaDescription' => $text,
            'pageId' => 'home',
            'subtitle' => $text
        ];

        $this->_loadPage('index', $data);
    }

    public function readdocs() {
        $this->redirect('/documentation');
    }

    public function index() {
        $data = [
            'metaDescription' => 'Documentation for Wayfinder, a simple routing framework for PHP',
            'title' => 'Wayfinder documentation'
        ];

        $this->_loadPage('docs', $data);
    }

    public function examples() {
        $data = [
            'metaDescription' => 'Examples of how to use Wayfinder for simple routing and rapid prototyping',
            'title' => 'Wayfinder examples',
            'subtitle' => 'How routing works in Wayfinder'
        ];

        $this->_loadPage('examples', $data);
    }

    public function changelog() {
        $data = [
            'metaDescription' => 'Change log and release notes for Wayfinder',
            'title' => 'Change log'
        ];

        $this->_loadPage('changelog', $data);
    }

    public function routes() {
        $data = [
            'metaDescription' => 'Documentation on how routing works in Wayfinder, allowing you to protoype rapidly',
            'title' => 'Routes in Wayfinder'
        ];

        $this->_loadPage('routes', $data);
    }

    public function controllers() {
        $data = [
            'metaDescription' => 'Documentation on how controllers works in Wayfinder, allowing you to protoype rapidly',
            'title' => 'Controllers in Wayfinder'
        ];

        $this->_loadPage('controllers', $data);
    }

    public function models($subSection = false) {
        if(!$subSection) {
            $data = [
                'metaDescription' => 'Documentation on how models works in Wayfinder, allowing you to manage your data and protoype rapidly',
                'title' => 'Models in Wayfinder'
            ];

            $this->_loadPage('models', $data);
        } else {
            if($subSection[0] == 'demo-users') {
                $this->load('models', 'Users');
                $page = 'demo-users';
                $users = new Users;
                $data = [
                    'metaDescription' => 'A demo of how models work in Wayfinder, allowing you manage your data',
                    'title' => 'User model demo',
                    'users' => $users->getUsers()
                ];
            } else if($subSection[0] == 'demo-user') {
                $this->load('models', 'Users');
                $page = 'demo-user';
                $users = new Users;
                $data = [
                    'noIndex' => true,
                    'user' => $users->getUser($subSection[1])
                ];
                $data['title'] = 'User model demo: '.$data['user']['name']['first'].' '.$data['user']['name']['last'];
            }
            $this->_loadPage($page, $data);
        }
    }

    public function views() {
        $data = [
            'metaDescription' => 'Documentation on how views works in Wayfinder, allowing you to protoype rapidly',
            'title' => 'Views in Wayfinder'
        ];

        $this->_loadPage('views', $data);
    }

    public function database() {
        $data = [
            'metaDescription' => 'Documentation on how to connect to a MySQL database in Wayfinder',
            'title' => 'Databases in Wayfinder'
        ];

        $this->_loadPage('database', $data);
    }

    public function libraries() {
        $data = [
            'metaDescription' => 'Documentation on how libraries works in Wayfinder, allowing you to bring your own code and plug it directly into your project',
            'title' => 'Libraries in Wayfinder'
        ];

        $this->_loadPage('libraries', $data);
    }

    public function cli() {
        $data = [
            'metaDescription' => 'Documentation on how to use Wayfinder on the command line',
            'title' => 'The Wayfinder <abbr title="Command Line Interface">CLI</abbr>'
        ];

        $this->_loadPage('cli', $data);
    }

    public function errors() {
        $data = [
            'metaDescription' => 'Documentation on how error handling works in Wayfinder',
            'title' => 'Errors in Wayfinder'
        ];

        $this->_loadPage('errors', $data);
    }

    private function _loadPage($page, $data = []) {
        $this->load('views', 'docs/global/header', $data);
        $this->load('views', 'docs/'.$page, $data);
        $this->load('views', 'docs/global/footer', $data);
    }

}
