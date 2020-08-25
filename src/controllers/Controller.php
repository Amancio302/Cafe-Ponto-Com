<?php
    session_start();

    abstract class Controller {

        protected $persistance;

        function __contruct ($persistance) {
            $this->persistance = $persistance;
        }
    }
?>