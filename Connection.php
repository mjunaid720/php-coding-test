<?php
/**
 * Created by PhpStorm.
 * User: junai
 * Date: 26/12/2018
 * Time: 9:49 PM
 */

Class Connection {

    private  $server = "mysql:host=localhost;dbname=bad";
    private  $user = "root";
    private  $pass = "";
    private $options  = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC);
    protected $con;

    public function openConnection()
    {
        try
        {
            $this->con = new PDO($this->server, $this->user,$this->pass,$this->options);
            return $this->con;
        } catch (PDOException $e) {
            echo "There is some problem in connection: " . $e->getMessage();
        }
    }

    public function closeConnection() {
        $this->con = null;
    }

}