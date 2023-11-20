<?php

/**
 * ----------------------------------------
 * Wayfinder
 * ----------------------------------------
 *
 * @category Model_File
 * @package  Wayfinder
 * @author   Charanjit Chana <hello@charanj.it>
 * @license  https://spdx.org/licenses/MIT.html MIT License
 * @version  0.12
 * @link     http://www.usewayfinder.com
 **/

 /**
  * DB is the base database class for handling MySQL connections
  *
  * @category Model_Class
  * @package  Wayfinder
  * @author   Charanjit Chana <hello@charanj.it>
  * @license  https://spdx.org/licenses/MIT.html MIT License
  * @version  0.12
  * @link     http://www.usewayfinder.com
  */
class Users extends Wayfinder
{

    private $_users;
    private $_seed = 'Wayfinder';

    /**
     * __construct()
     *
     * @return void
     * @access public
     */
    function __construct()
    {
        $this->_fetchUsers();
    }

    /**
     * Function that will get a list of users
     * getUsers()
     *
     * @return array
     * @access public
     */
    public function getUsers()
    {
        return $this->_users;
    }

    /**
     * Function that will get a specific user
     * getUser()
     *
     * @param int $id The ID of the user to fetch
     *
     * @return void
     * @access public
     */
    public function getUser($id)
    {
        if ($id > 0 && isset($this->_users[$id-1])) {
            return $this->_users[$id-1];
        } else {
            return false;
        }
    }

    /**
     * Function that will fetch a list of users from randomuser.com
     * _fetchUsers()
     *
     * @return array
     * @access private
     */
    private function _fetchUsers()
    {
        $users = json_decode(file_get_contents('https://randomuser.me/api/?results=10&seed='.$this->_seed), true);
        $this->_users = $users['results'];
    }

}
