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
            echo $CPF. "<br>" .$Nome. "<br>" .$Telefone. "<br>" .$Endereco. "<br>" .$Email. "<br>" .$Admin. "<br>" .$Qtd_Vendas. "<br>" .$Valor_Comissao. "<br>" .$senha;
            $res = $this->persistance->createUsuario($CPF, $Nome, $Telefone, $Endereco, $Email, $Admin, $Qtd_Vendas, $Valor_Comissao, $senha);
            echo "<br>2";
            if (!!$res) {
                $this->login($res->Email, $res->senha);
                return true;
            } else {
                return false;
            }
        }        
    }
?>