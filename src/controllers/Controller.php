<?php
    session_start();

    abstract class Controller {

        protected $persistance;

        function redirect ($view) {
            header("Location: ./$view.php");
        }

    }
?>