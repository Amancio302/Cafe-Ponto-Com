<?php
    session_start();

    abstract class View {

        protected $controller;
        protected $needAuth;

        function __contruct ($needAuth, $controller) {
            $this->needAuth = $needAuth;
            $this->controller = $controller;
        }

        public function redirect ($view) {
            header('Location: ./DashboardController.php');
        }

        public function render() {
            if ($needAuth && isset($_SESSION["user"])) {
                echo $this->output();
            } else if (!$needAuth && isset($_SESSION["user"])) {
                $this->redirect("Login.php");
            } else {
                $this->redirect("Dashboard.php");
            }
        }

        public abstract function output ();
    }
?>