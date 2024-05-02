<?php

/**
 * ----------------------------------------
 * Wayfinder
 * ----------------------------------------
 *
 * @category Library
 * @package  Wayfinder
 * @author   Charanjit Chana <hello@charanj.it>
 * @license  https://spdx.org/licenses/MIT.html MIT License
 * @version  0.13
 * @link     http://www.usewayfinder.com
 **/

require_once realpath(dirname(__FILE__)).'/../conf/db.php';

/**
 * DB is the base database class for handling MySQL connections
 *
 * @category Library_Class
 * @package  Wayfinder
 * @author   Charanjit Chana <hello@charanj.it>
 * @license  https://spdx.org/licenses/MIT.html MIT License
 * @version  0.12
 * @link     http://www.usewayfinder.com
 */
class DB
{

    private $servername;
    private $username;
    private $password;
    private $db;
    private $conn;

    /**
     * __construct() function that runs when the class is instantiated
     *
     * @access private
     */
    function __construct()
    {
        $this->servername = SERVER_ADDRESS;
        $this->username = USER_NAME;
        $this->password = PASSWORD;
        $this->db = DB_NAME;

        // Create connection
        $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->db);

        // set content to by utf8 compatible
        mysqli_set_charset($this->conn, 'utf8mb4');

        // Check connection
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }

    }

    /**
     * Execute any MySQL query, it is your own responsibility to sanatise the data
     * query()
     *
     * @param string $sql the SQL statement
     *
     * @return array return the results
     * @access public
     */
    public function query($sql)
    {
        $content = [];
        $sql = $sql;
        $results = $this->conn->query($sql);

        if (is_object($results)) {
            if ($results->num_rows == 1) {
                $content = [$results->fetch_assoc()];
            } else if ($results->num_rows > 1) {
                while ($row = $results->fetch_assoc()) {
                    $content[] = $row;
                }
            }
            if(empty($content)) {
                return false;
            }
            return $content;
        }
        return $results;
    }

    /**
     * A wrapper for select statements
     * select()
     *
     * @param string $sql the SQL statement
     *
     * @return array return the results
     * @access public
     */
    public function select($sql)
    {
        $this->query($sql);
        return $content;
    }

    /**
     * Gets the last insert ID from MySQL
     * lastInsertId()
     *
     * @return array return the last insert ID
     * @access public
     */
    public function lastInsertId()
    {
        return $this->conn->insert_id;
    }

    /**
     * A wrapper function for mysqli_real_escape_string
     * escape()
     *
     * @param string $string the string that needs sanatising
     *
     * @return array return the sanatised value
     * @access public
     */
    public function escape($string)
    {
        return mysqli_real_escape_string($this->conn, $string);
    }

    /**
     * Return the last error, wrapper for mysqli_info
     * error()
     *
     * @return array return the last error
     * @access public
     */
    public function error()
    {
        return mysqli_error($this->conn);
    }

    /**
     * Wrapper for mysqli_info
     * info()
     *
     * @return array return the results
     * @access public
     */
    public function info()
    {
        return mysqli_info($this->conn);
    }

    /**
     * Get the database connection
     * connection()
     *
     * @return object return the connection
     * @access public
     */
    public function connection()
    {
        return $this->conn;
    }

}
