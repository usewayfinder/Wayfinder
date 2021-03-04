<?php

class Users extends Wayfinder {

    private $_users,
            $_seed = 'Wayfinder';

    function __construct() {
        $users = json_decode(file_get_contents('https://randomuser.me/api/?results=10&seed='.$this->_seed), true);
        $this->_users = $users['results'];
    }

    public function getUsers() {
        return $this->_users;
    }

    public function getUser($id) {
        return $this->_users[$id-1];
    }

}
