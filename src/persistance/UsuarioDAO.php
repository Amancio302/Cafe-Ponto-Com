<?php
require_once("Database_Connect.php");
require_once("../models/Usuario.php");

class UsuarioDAO extends Database_Connect{

    public function login ($email, $senha) {
        $connection = $this->connect();
        $sql = "SELECT * FROM Usuario WHERE Email = \"$email\" and senha = \"$senha\"";
        $result = $connection->query($sql);
        mysqli_close($connection);
        return $this->fetchData($result)[0];
    }

    public function createUsuario($CPF, $Nome, $Telefone, $Endereco, $Email, $Admin, $Qtd_Vendas, $Valor_Comissao, $senha) {
        $connection = $this->connect();
        $data = "(\"$CPF\", \"$Nome\", \"$Telefone\", \"$Endereco\", \"$Email\", $Admin, $Qtd_Vendas, $Valor_Comissao, \"$senha\")";
        $sql = "INSERT INTO Usuario (CPF, Nome, Telefone, Endereco, Email, Admin, Qtd_Vendas, Valor_Comissao, senha) VALUES $data";
        $connection->query($sql);
        $idUsuario = mysqli_insert_id($connection);
        mysqli_close($connection);
        return new Usuario($idUsuario, $CPF, $Nome, $Telefone, $Endereco, $Email, $Admin, $Qtd_Vendas, $Valor_Comissao);
    }

    public function getOneUsuario($idUsuario) {
        $connection = $this->connect();
        $sql = "SELECT * FROM Usuario WHERE idUsuario = $idUsuario";
        $result = $connection->query($sql);
        mysqli_close($connection);
        return $this->fetchData($result)[0];
    }

    public function getAllUsuarios() {
        $connection = $this->connect();
        $sql = "SELECT * FROM Usuario";
        $result = $connection->query($sql);
        mysqli_close($connection);
        return $this->fetchData($result);
    }

    public function updateUsuario($idUsuario, $UsuarioData) {
        $connection = $this->connect();
        $data = "CPF = \"$UsuarioData->CPF\", Nome = \"$UsuarioData->Nome\", Telefone = \"$UsuarioData->Telefone\", Endereco = \"$UsuarioData->Endereco\", Email = \"$UsuarioData->Email\", Admin = $UsuarioData->Admin, Qtd_Vendas = $UsuarioData->Qtd_Vendas, Valor_Comissao = $UsuarioData->Valor_Comissao, senha = \"$senha\"";
        $sql = "UPDATE Usuario SET $data WHERE idUsuario = $idUsuario";
        $res = mysqli_query($connection, $sql);
        mysqli_close($connection);
        return $this->getOneUsuario($idUsuario);
    }

    public function deleteUsuario($idUsuario) {
        $deleted = $this->getOneUsuario($idUsuario);
        $connection = $this->connect();
        $sql = "DELETE FROM Usuario WHERE idUsuario = $idUsuario";
        mysqli_query($connection, $sql);
        mysqli_close($connection);
        return $deleted;
    }

    private function fetchData($dataArray) {
        $res = array();
        foreach($dataArray as $usuario) {
            $data = new Usuario($usuario[idUsuario], $usuario[CPF], $usuario[Nome], $usuario[Telefone], $usuario[Endereco], $usuario[Email], $usuario[Admin], $usuario[Qtd_Vendas], $usuario[Valor_Comissao], $usuario[senha]);
            array_push($res, $data);
        }
        return $res;
    }
}
?>