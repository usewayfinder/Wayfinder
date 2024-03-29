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
  * This is the default controller used for documentation which you can find at https://www.usewayfinder.com
  *
  * @category Controller_Class
  * @package  Wayfinder
  * @author   Charanjit Chana <hello@charanj.it>
  * @license  https://spdx.org/licenses/MIT.html MIT License
  * @version  0.12
  * @link     http://www.usewayfinder.com
  */
class Documentation extends Wayfinder
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
     * The route for / (app/conf/routes.php enforce this as the default homepage, instead of index)
     * home()
     *
     * @return void
     * @access public
     */
    public function home()
    {
        $text = 'A framework for <strong>custom routing</strong> and <strong>rapid protoyping</strong> in PHP';
        $data = [
                 'metaDescription' => $text,
                 'pageId'          => 'home',
                 'subtitle'        => $text,
                 'title'           => 'Wayfinder',
                ];

        $this->_loadPage('index', $data);
    }

    /**
     * Redirects to /documentation
     * readdocs()
     *
     * @return void
     * @access public
     */
    public function readdocs()
    {
        $this->redirect('/documentation');
    }

    /**
     * The route for /documentation
     * index()
     *
     * @return void
     * @access public
     */
    public function index()
    {
        $data = [
                 'metaDescription' => 'Documentation for Wayfinder, a simple routing framework for PHP',
                 'title'           => 'Wayfinder documentation',
                ];

        $this->_loadPage('docs', $data);
    }

    /**
     * The route for /documentation/examples
     * examples()
     *
     * @return void
     * @access public
     */
    public function examples()
    {
        $data = [
                 'metaDescription' => 'Examples of how to use Wayfinder for simple routing and rapid prototyping',
                 'title'           => 'Wayfinder examples',
                 'subtitle'        => 'How routing works in Wayfinder',
                ];

        $this->_loadPage('examples', $data);
    }

    /**
     * The route for /documentation/changelog
     * changelog()
     *
     * @return void
     * @access public
     */
    public function changelog()
    {
        $data = [
                 'metaDescription' => 'Change log and release notes for Wayfinder',
                 'title'           => 'Change log',
                ];

        $this->_loadPage('changelog', $data);
    }

    /**
     * The route for /documentation/config
     * config()
     *
     * @return void
     * @access public
     */
    public function config()
    {
        $data = [
                 'metaDescription' => 'Documentation on how the config.php file works in Wayfinder',
                 'title'           => 'Config file',
                ];

        $this->_loadPage('config', $data);
    }

    /**
     * The route for /documentation/routes
     * routes()
     *
     * @return void
     * @access public
     */
    public function routes()
    {
        $data = [
                 'metaDescription' => 'Documentation on how routing works in Wayfinder, allowing you to protoype rapidly',
                 'title'           => 'Routes in Wayfinder',
                ];

        $this->_loadPage('routes', $data);
    }

    /**
     * The route for /documentation
     * index()
     *
     * @return void
     * @access public
     */
    public function controllers()
    {
        $data = [
                 'metaDescription' => 'Documentation on how controllers works in Wayfinder, allowing you to protoype rapidly',
                 'title'           => 'Controllers in Wayfinder',
                ];

        $this->_loadPage('controllers', $data);
    }

    /**
     * The route for /documentation
     * index()
     *
     * @param string $subSection The name of the subsection
     * @param string $id         User ID to fetch
     *
     * @return void
     * @access public
     */
    public function models($subSection = false, $id = 0)
    {
        if (!$subSection) {
            $data = [
                     'metaDescription' => 'Documentation on how models works in Wayfinder, allowing you to manage your data and protoype rapidly',
                     'title'           => 'Models in Wayfinder',
                    ];

            $this->_loadPage('models', $data);
        } else {
            if ($subSection == 'demo-users') {
                $this->load('models', 'Users');
                $page = 'demo-users';
                $users = new Users;
                $data = [
                         'metaDescription' => 'A demo of how models work in Wayfinder, allowing you manage your data',
                         'title'           => 'User model demo',
                         'users'           => $users->getUsers(),
                        ];
            } else if ($subSection == 'demo-user') {
                $this->load('models', 'Users');
                $page = 'demo-user';
                if ($id > 0 && $id <= 10) {
                    $users = new Users;
                    $user = $users->getUser($id);
                    $data = [
                             'noIndex' => true,
                             'user'    => $user,
                            ];
                    $data['title'] = 'User model demo: '.$user['name']['first'].' '.$user['name']['last'];
                } else {
                    $data = [
                             'noIndex' => true,
                             'user'    => false,
                             'title'   => 'This user does not exist',
                            ];
                }
            }
            $this->_loadPage($page, $data);
        }
    }

    /**
     * The route for /documentation
     * index()
     *
     * @return void
     * @access public
     */
    public function views()
    {
        $data = [
                 'metaDescription' => 'Documentation on how views works in Wayfinder, allowing you to protoype rapidly',
                 'title'           => 'Views in Wayfinder',
                ];

        $this->_loadPage('views', $data);
    }

    /**
     * The route for /documentation
     * index()
     *
     * @return void
     * @access public
     */
    public function database()
    {
        $data = [
                 'metaDescription' => 'Documentation on how to connect to a MySQL database in Wayfinder',
                 'title'           => 'Databases in Wayfinder',
                ];

        $this->_loadPage('database', $data);
    }

    /**
     * The route for /documentation
     * index()
     *
     * @return void
     * @access public
     */
    public function libraries()
    {
        $data = [
                 'metaDescription' => 'Documentation on how libraries works in Wayfinder, allowing you to bring your own code and plug it directly into your project',
                 'title'           => 'Libraries in Wayfinder',
                ];

        $this->_loadPage('libraries', $data);
    }

    /**
     * The route for /documentation/cli
     * cli()
     *
     * @return void
     * @access public
     */
    public function cli()
    {
        $data = [
                 'metaDescription' => 'Documentation on how to use Wayfinder on the command line',
                 'title'           => 'The Wayfinder <abbr title="Command Line Interface">CLI</abbr>',
                ];

        $this->_loadPage('cli', $data);
    }

    /**
     * The route for /documentation/errors
     * errors()
     *
     * @return void
     * @access public
     */
    public function errors()
    {
        $data = [
                 'metaDescription' => 'Documentation on how error handling works in Wayfinder',
                 'title'           => 'Errors in Wayfinder',
                ];

        $this->_loadPage('errors', $data);
    }

    /**
     * The route for /documentation/tests
     * tests()
     *
     * @return void
     * @access public
     */
    public function tests()
    {
        $data = [
                 'metaDescription' => 'Documentation on how unit testing is handled in Wayfinder',
                 'title'           => 'Testing Wayfinder',
                ];

        $this->_loadPage('tests', $data);
    }

    /**
     * Internal function that combines multiple calls to loading view content. If txt format is requested, then just the raw page is captured, tags are stripped and returned to the view.
     * _loadPage()
     *
     * @param string $page The filename for the page to render
     * @param array  $data The data that should be passed to the view
     *
     * @return void
     * @access public
     */
    private function _loadPage($page, $data = [])
    {
        if ($this->getMimeType() !== 'txt') {
            $this->load('views', 'docs/global/header', $data);
            $this->load('views', 'docs/'.$page, $data);
            $this->load('views', 'docs/global/footer', $data);
        } else {
            ob_start();
            $this->load('views', 'docs/'.$page, $data);
            $output = strip_tags(ob_get_clean());
            $output = str_replace("\n\n", "", $output);
            echo $output;
        }
    }

}
