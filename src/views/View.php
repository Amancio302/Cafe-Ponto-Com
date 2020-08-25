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
            $_SESSION["admin"] = null;
            $this->redirect("Login");
        }

        public function adminOption () {
            if ($_SESSION["admin"]) {
                return "
                <li class=\"nav-item\">
                    <a class=\"nav-link pt-3 pb-3\" href=\"./Gerenciar_Usuarios.php\">
                    <span data-feather=\"coffee\"></span>
                    Administrar Usuarios
                    </a>
                </li>
                ";
            } else {
                return "";
            }
        }

        public abstract function output ();
    }
?>