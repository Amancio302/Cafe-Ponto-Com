<?php
    require_once("../config/database.php");

    abstract class Database_Connect{
        protected function connect(){
            global $host, $login, $senha, $database, $port;
            $connection = new mysqli($host, $login, $senha, $database, $port);
            if(!$connection){
                return false;
                exit;
            }
            else{
                return $connection;
            }
        }
    }
?>