<?php

class Errors extends Wayfinder {

    var $mode;

    function __construct() {
        $this->mode = php_sapi_name();
    }

    public function index($error, $title = false, $message = false) {
        $data = $this->error($error);
        if($title) {
            $data['title'] = $title;
        }
        if($message) {
            $data['content'] = $message;
        }

        if($this->mode != 'cli') {
            $this->load('views', 'docs/global/header', $data);
            $this->load('views', 'errors', $data);
            $this->load('views', 'docs/global/footer', $data);
        } else {
            echo $data['title'].' ('.$error.'). '.strip_tags($data['content']);
        }
    }

    public function error($error) {
        $data = [
            'error' => $error
        ];
        switch ($error) {
            case 400:
                $data['title'] = '400 Bad Request';
                $data['content'] = 'Invalid request message framing, or deceptive request routing.';
                break;
            case 401:
                $data['title'] = '401 Unauthorized';
                $data['content'] = 'Sorry, but you are not authorized to see this part of the site.';
                break;
            case 403:
                $data['title'] = '403 Forbidden';
                $data['content'] = 'The request made was forbidden.';
                break;
            case 501:
                $data['title'] = '501 Not Implemented';
                $data['content'] = 'There was an internal server error.';
                break;
            case 503:
                $data['title'] = '503 Service Unavailable';
                $data['content'] = 'The service is currently unavailable.';
                break;
            case 404:
                $data['title'] = '404 Not Found';
                $data['content'] = 'The page you requested could not be found. Maybe try again or head back to the <a href="/">homepage</a>.';
                break;
        }
        if($this->mode != 'cli' || strpos($_SERVER['argv'][0], 'phpunit') !== FALSE) {
            header('HTTP/1.0 '.$data['title'], true, $error);
        }
        return $data;
    }

}
