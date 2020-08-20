<?php
include_once("Database_Connect.php, @/models/Usuario.php");

class Usuario extends Database_Connect{

    public function createUsuario($cpf, $nome, $telefone, $endereco, $email, $admin, $qtd_vendas, $valor_comissao) {
        $connection = $this->connect();
        $data = "(\"$cpf\", \"$nome\", \"$telefone\", \"$endereco\", \"$email\", \"$admin\", \"$qtd_vendas\", \"$valor_comissao\")";
        $sql = "INSERT INTO Usuario (cpf, nome, telefone, endereco, email, admin, qtd_vendas, valor_comissao) VALUES $data";
        mysqli_query($connection, $sql);
        $idUsuario = mysqli_insert_id($connection);
        mysqli_close($connection);
        return new Usuario($idUsuario, $cpf, $nome, $telefone, $endereco, $email, $admin, $qtd_vendas, $valor_comissao);
    }

    public function getOneUsuario($idUsuario) {
        $connection = $this->connect();
        $sql = "SELECT * FROM Usuario WHERE idUsuario = $idUsuario";
        $result = mysqli_fetch_all(mysqli_query($connection, $sql), MYSQLI_ASSOC);
        mysqli_close($connection);
        return $result;
    }

    public function getAllUsuarios() {
        $connection = $this->connect();
        $sql = "SELECT * FROM Usuario";
        $query = mysqli_query($connection, $sql);
        $result = mysqli_fetch_all($query, MYSQLI_ASSOC);
        mysqli_close($connection);
        return $result;
    }

    public function updateUsuario($idUsuario, $UsuarioData) {
        $connection = $this->connect();
        $data = "(cpf = \"$cpf\", nome = \"$nome\", telefone = \"$telefone\", endereco = \"$endereco\", email = \"$email\", admin = \"$admin\", qtd_vendas = \"$qtd_vendas\", valor_comissao = \"$valor_comissao\")";
        $sql = "UPDATE Usuario SET $data WHERE idUsuario = $UsuarioData->idUsuario";
        mysqli_query($connection, $sql);
        mysqli_close($connection);
    }

    public function deleteUsuario($idUsuario) {
        $connection = $this->connect();
        $sql = "DELETE FROM Usuario WHERE idUsuario = $idUsuario";
        mysqli_query($connection, $sql);
        mysqli_close($connection);
    }
}
?>