<?php
/**
 * Created by PhpStorm.
 * User: Sadjad
 * Date: 6/13/2016
 * Time: 6:40 PM
 */
error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
class Connection {
    var $con;

    function Connection($host, $user, $password){
        $this->con = mysqli_connect($host, $user, $password);
        if(!$this->con) {
            die("sorry :(  can not connect to the server");
        }
    }

    public function selectDb($dbName){
        mysqli_query("SET character_set_results=utf8", $this->con);
        mb_language('uni');
        mb_internal_encoding('UTF-8');
        mysqli_select_db($dbName, $this->con) or die("sorry!!!can not connect to database");
        mysqli_query("set names 'utf8'", $this->con);
    }

    public function closeConnection(){
        mysqli_close($this->con);
    }
}
