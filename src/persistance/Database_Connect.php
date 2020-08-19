<?php
  include_once("@/config/database.php");

  abstract class Database_Connect{
    protected function connect(){
      global $host, $login, $senha, $database;
      $connection = mysqli_connect($host, $login, $senha, $database);
      if(!$connection){
        return false;
        exit;
      }
      else{
        return $connection;
      }
    }
  }