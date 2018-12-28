<?php
/**
 * Created by PhpStorm.
 * User: junai
 * Date: 20/12/2018
 * Time: 11:06 PM
 */
include 'Connection.php';
Class Database {
    private $_conn;
    public function __construct() {
        $this->_conn = new Connection();
    }

    public function getWebsiteById($site) {
        $con = $this->_conn->openConnection();
        $prep = $con->prepare("SELECT * FROM `websites` WHERE id = ?");
        $paramList = array();
        array_push($paramList, $site);

        if (!$prep->execute($paramList)) {
            $error = $prep->errorInfo();
            echo "Error: {$error[2]}";  // element 2 has the string text of the error
        }
        $this->_conn->closeConnection();
        return $prep->fetchAll(PDO::FETCH_ASSOC);

    }

    public function getWebsites() {
        $con = $this->_conn->openConnection();
        $prep = $con->prepare("SELECT * FROM `websites`");
        if (!$prep->execute()) {
            $error = $prep->errorInfo();
            echo "Error: {$error[2]}";  // element 2 has the string text of the error
        }
        $this->_conn->closeConnection();
        return $prep->fetchAll(PDO::FETCH_ASSOC);
    }
}


?>