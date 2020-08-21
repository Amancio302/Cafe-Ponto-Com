<?php
require_once("Database_Connect.php");
require_once("UsuarioDAO.php");
require_once("../models/Produto.php");

class ProdutoDAO extends Database_Connect{

    public function createProduto($Nome, $Descricao, $Preco, $Quantidade, $addedBy) {
        $connection = $this->connect();
        $data = "(\"$Nome\", \"$Descricao\", $Preco, $Quantidade, $addedBy)";
        $sql = "INSERT INTO (Nome, Descricao, Preco, Quantidade, addedBy) VALUES $data";
        print_r($sql);
        $connection->query($sql);
        $idProduto = mysqli_insert_id($connection);
        mysqli_close($connection);
        $Usuario = new UsuarioDAO();
        $usuario = $Usuario->getOneUsuario($addedBy);
        return new Produto($idProduto, $Nome, $Descricao, $Preco, $Quantidade, $addedBy);
    }

    public function getOneProduto($idProduto) {
        $connection = $this->connect();
        $sql = "SELECT * FROM Produto WHERE idProduto = $idProduto";
        $result = $connection->query($sql);
        mysqli_close($connection);
        return $this->fetchData($result)[0];
    }

    public function getAllProdutos() {
        echo "11<br>";
        $connection = $this->connect();
        echo "12<br>";
        $sql = "SELECT * FROM Produto";
        echo "13<br>";
        print_r($sql);
        $result = $connection->query($sql);
        echo "<br>14<br>";
        mysqli_close($connection);
        echo "15<br>";
        return $this->fetchData($result);
    }

    public function updateProduto($idProduto, $ProdutoData) {
        $connection = $this->connect();
        print_r($ProdutoData);
        $data = "idUsuario = $ProdutoData->idUsuario, Valor_Total = $ProdutoData->Valor_Total, Valor_Pago = $ProdutoData->Valor_Pago, Tipo_Transacao = \"$ProdutoData->Tipo_Transacao\" Concluida = $ProdutoData->Concluida";
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
            $data = new Produto($Produto[idProduto], $usuario, $Produto[Valor_Total], $Produto[Valor_Pago], $Produto[Tipo_Transacao], $Produto[Concluida]);
            array_push($res, $data);
        }
        return $res;
    }
}
?>