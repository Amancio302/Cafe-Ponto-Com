<?php
    if(!isset($_SESSION)) 
    { 
        session_start(); 
    }

    abstract class Controller {

        protected $persistance;

        function redirect ($view, $query = "") {
            header("Location: ./$view.php?$query");
        }

    }
?>