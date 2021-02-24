<?php

class Docs extends Wayfinder {

    function __construct() {
    }

    public function index() {
        $data = [
            'title' => 'Wayfinder',
            'subtitle' => 'The simple routing framework writtern in PHP'
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

    public function roadmap() {
        $data = [
            'title' => 'Roadmap',
            'subtitle' => 'What\'s next for Wayfinder?'
        ];

        $this->load('views', 'docs/global/header', $data);
        $this->load('views', 'docs/roadmap', $data);
        $this->load('views', 'docs/global/footer', $data);
    }

}
