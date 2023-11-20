<?php

/**
 * ----------------------------------------
 * Wayfinder
 * ----------------------------------------
 *
 * @category Error_Class
 * @package  Wayfinder
 * @author   Charanjit Chana <hello@charanj.it>
 * @license  https://spdx.org/licenses/MIT.html MIT License
 * @version  0.12
 * @link     http://www.usewayfinder.com
 **/

 /**
  * Errors is the base error class for Wayfinder, extending the Wayfinder class
  *
  * @category Framework_Class
  * @package  Wayfinder
  * @author   Charanjit Chana <hello@charanj.it>
  * @license  https://spdx.org/licenses/MIT.html MIT License
  * @version  0.12
  * @link     http://www.usewayfinder.com
  */
class Errors extends Wayfinder
{

    public $mode;

    /**
     * Constructor function for the class, used to determine if this is CLI or not
     * __construct()
     *
     * @access private
     */
    function __construct()
    {
        $this->mode = php_sapi_name();
    }

    /**
     * This is the default function that gets called in the case of an error.
     * If this is CLI then the raw error title, code and content is echoed to screen
     * init()
     *
     * @param string $error   the error code
     * @param string $title   a title for the error page
     * @param string $message a more verbose message for the error
     *
     * @return void nothing is returned
     * @access public
     */
    public function index($error, $title = false, $message = false)
    {
        $data = $this->error($error);
        if ($title) {
            $data['title'] = $title;
        }
        if ($message) {
            $data['content'] = $message;
        }

        if ($this->mode != 'cli') {
            foreach (__ERROR_TEMPLATES as $templates) {
                $this->load('views', $templates, $data);
            }
        } else {
            echo $data['title'].' ('.$error.'). '.strip_tags($data['content']);
        }
    }

    /**
     * This function determines the error information depending on the code past
     * error()
     *
     * @param int $error the error code
     *
     * @return array the title and content as an array is returned
     * @access public
     */
    public function error($error)
    {
        $data = ['error' => $error];
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
        case 500:
            $data['title'] = '500 Internal Server Error';
            $data['content'] = 'The request could not be fulfilled';
            break;
        }
        if ($this->mode != 'cli' || strpos($_SERVER['argv'][0], 'phpunit') !== false) {
            header('HTTP/1.0 '.$data['title'], true, $error);
        }
        return $data;
    }

}
