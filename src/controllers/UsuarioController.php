<?php
    session_start();
    require_once("Controller.php");
    require_once("../persistance/UsuarioDAO.php");

    class UsuarioController extends Controller {

        function __construct () {
            $this->persistance = new UsuarioDAO();
        }

        function login ($email, $senha) {
            $res =  $this->persistance->login($email, $senha);
            if (!!$res) {
                $_SESSION["user"] = $res->idUsuario;
                $_SESSION["admin"] = $res->Admin;
                $this->redirect("Dashboard");
            }
            return $res;
        }

        function getNome ($idUsuario) {
            return $this->persistance->getOneUsuario($idUsuario)->Nome;
        }

        function signIn ($CPF, $Nome, $Telefone, $Endereco, $Email, $Admin, $Qtd_Vendas, $Valor_Comissao, $senha) {
            $res = $this->persistance->createUsuario($CPF, $Nome, $Telefone, $Endereco, $Email, $Admin, $Qtd_Vendas, $Valor_Comissao, $senha);
            if (!!$res) {
                $this->login($res->Email, $res->senha);
                return true;
            } else {
                return false;
            }
        }

        function getOneUsuario ($idUsuario) {
            return $this->persistance->getOneUsuario($idUsuario);
        }
        
        function getAllUsuarios () {
            return $this->persistance->getAllUsuarios();
        }

        function promoveUsuario ($idUsuario) {
            $user = $this->persistance->getOneUsuario($idUsuario);
            $user->Admin = true;
            return !!$this->persistance->updateUsuario($idUsuario, $user);
        }

        function deleteusuario ($idUsuario) {
            return !!$this->persistance->deleteusuario($idUsuario);
        }
    }
?>