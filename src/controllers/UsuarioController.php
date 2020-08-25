<?php
    session_start();
    require_once("Controller.php");
    require_once("../persistance/UsuarioDAO.php");

    class UsuarioController extends Controller {

        function __construct () {
            $this->persistance = new UsuarioDAO();
        }

        function login ($email, $senha) {
            return $this->persistance->login($email, $senha);
        }

        function getNome ($idUsuario) {
            return $this->persistance->getOneUsuario($idUsuario)->Nome;
        }
        
    }
?>