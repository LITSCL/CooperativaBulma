<?php
define("SERVER", "localhost");
define("USER", "root");
define("PASS", "root");
define("DATABASE", "dbcooperativabulma");

class BDUtils {
    public $_db;
    
    public function __construct() {
        $this->_db = new mysqli(SERVER, USER, PASS, DATABASE);
        if ($this->_db->connect_errno) {
            echo "Fallo la conexión" . $this->_db->connect_errno;
            return;
        }
    }
}
?>