<?php
    session_start();

    abstract class View {

        protected $controller;
        protected $needAuth;
        protected $name;

        public function redirect ($view) {
            header("Location: ./$view.php");
        }

        public function render () {
            if ($this->needAuth && isset($_SESSION["user"])) {
                echo $this->output();
            } else if (!$this->needAuth && isset($_SESSION["user"]) && $this->name != 'Dashboard') {
                $this->redirect("Dashboard");
            } else if ($this->name != 'Login'){
                $this->redirect("Login");
            } else {
                echo $this->output();
            }
        }

        public function sair () {
            $_SESSION["user"] = null;
            $this->redirect("Login");
        }

        public abstract function output ();
    }
?>