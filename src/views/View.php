<?php
    session_start();

    abstract class View {

        protected $controller;
        protected $needAuth;
        protected $name;

        public function redirect ($view) {
            $this->controller->redirect($view);
        }

        public function render () {
            if ($this->needAuth) {
                if (isset($_SESSION["user"])) {
                    echo $this->output();
                } else {
                    if ($this->name != "Login")
                        $this->redirect("Login");
                }
            } else {
                if (isset($_SESSION["user"])) {
                    if ($this->name != "Dashboard")
                        $this->redirect("Dashboard");
                } else {
                    echo $this->output();
                }
            }
        }

        public function sair () {
            $_SESSION["user"] = null;
            $this->redirect("Login");
        }

        public abstract function output ();
    }
?>