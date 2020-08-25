<?php
    session_start();
    require_once("Controller.php");
    require_once("../persistance/UsuarioDAO.php");

    class UsuarioController extends Controller {
        
        private $persistance;

        function __construct () {
            echo 3;
            $this->persistance = new UsuarioDAO();
            echo 4;
        }

        function login ($email, $senha) {
            return $this->persistance->login($email, $senha);
        }
        
    }
?>