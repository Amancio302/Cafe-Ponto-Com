<?php
require_once("Database_Connect.php");
require_once("UsuarioDAO.php");
require_once("../models/Produto.php");

class ProdutoDAO extends Database_Connect{

    public function createProduto($Nome, $Descricao, $Preco, $Quantidade, $addedBy) {
        $connection = $this->connect();
        $data = "(\"$Nome\", \"$Descricao\", $Preco, $Quantidade, $addedBy)";
        $sql = "INSERT INTO Produto (Nome, Descricao, Preco, Quantidade, addedBy) VALUES $data";
        $connection->query($sql);
        $idProduto = mysqli_insert_id($connection);
        mysqli_close($connection);
        $Usuario = new UsuarioDAO();
        $usuario = $Usuario->getOneUsuario($addedBy);
        return new Produto($idProduto, $Nome, $Descricao, $Preco, $Quantidade, $usuario);
    }

    public function getOneProduto($idProduto) {
        $connection = $this->connect();
        $sql = "SELECT * FROM Produto WHERE idProduto = $idProduto";
        $result = $connection->query($sql);
        mysqli_close($connection);
        return $this->fetchData($result)[0];
    }

    public function getAllProdutos() {
        $connection = $this->connect();
        $sql = "SELECT * FROM Produto";
        $result = $connection->query($sql);
        mysqli_close($connection);
        return $this->fetchData($result);
    }

    public function updateProduto($idProduto, $ProdutoData) {
        $connection = $this->connect();
        $idUsuario = $ProdutoData->addedBy->idUsuario;
        $data = "Nome = \"$ProdutoData->Nome\", Descricao = \"$ProdutoData->Descricao\", Preco = $ProdutoData->Preco, Quantidade = $ProdutoData->Quantidade, addedBy = $idUsuario";
        $sql = "UPDATE Produto SET $data WHERE idProduto = $idProduto";
        $res = mysqli_query($connection, $sql);
        mysqli_close($connection);
        return $this->getOneProduto($idProduto);
    }

    public function deleteProduto($idProduto) {
        $deleted = $this->getOneProduto($idProduto);
        $connection = $this->connect();
        $sql = "DELETE FROM Produto WHERE idProduto = $idProduto";
        mysqli_query($connection, $sql);
        mysqli_close($connection);
        return $deleted;
    }

    private function fetchData($dataArray) {
        $res = array();
        foreach($dataArray as $Produto) {
            $Usuario = new UsuarioDAO();
            $usuario = $Usuario->getOneUsuario($Produto[addedBy]);
            $data = new Produto($Produto[idProduto], $Produto[Nome],  $Produto[Descricao], $Produto[Preco], $Produto[Quantidade], $usuario);
            array_push($res, $data);
        }
        return $res;
    }
}
?>