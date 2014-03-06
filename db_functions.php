<?php
 
class DB_Functions {
 
    private $db;
 
    //put your code here
    // constructor
    function __construct() {
        include_once './db_connect.php';
        // connecting to database
        $this->db = new DB_Connect();
        $this->db->connect();
    }
 
    // destructor
    function __destruct() {
         
    }

    function log_debug($message) {
        $path = 'log/debug.log';
        $time = \date("y-m-d H:i:s");
        $message = \str_replace("\n", "<br/>", $message);
        $line = "<div class=\"debug\" title=\"debug\"><b>{$time}&nbsp;</b>{$message}</div>\n";
        try {
            $handle = \fopen($path, "a");
            \fwrite($handle, $line);
            \fclose($handle);
        } catch (Exception $e) {

        }

    }

    function get_var_dump($property) {
        \ob_start();
        echo '<pre>';
        \var_dump($property);
        echo '</pre>';
        $fluffy_html = \ob_get_contents();
        \ob_end_clean();
        return $fluffy_html;
    }

    /**
     * Storing new user
     * returns user details
     */
    public function storeUser($name, $hash, $shop_id, $gcm_regid) {
        // insert user into database
        $result = mysql_query("INSERT INTO gcm_users(name, hash, shop_id, gcm_regid, created_at) VALUES('$name', '$hash', $shop_id , '$gcm_regid', NOW())");
        // check for successful store
        log_debug(get_var_dump($result));
        if ($result) {
            // get user details
            $id = mysql_insert_id(); // last inserted id
            $result = mysql_query("SELECT * FROM gcm_users WHERE id = $id") or die(mysql_error());
            // return user details
            if (mysql_num_rows($result) > 0) {
                return mysql_fetch_array($result);
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
 
    /**
     * Getting all users
     */
    public function getAllUsers() {
        $result = mysql_query("select * FROM gcm_users");
        return $result;
    }
 
}
 
?>
