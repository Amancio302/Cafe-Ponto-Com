<?php
include_once("Database_Connect.php, @/models/Pedido.php");

class Pedido extends Database_Connect{

    public function createPedido($idVenda, $idProduto, $qtdProduto) {
        $connection = $this->connect();
        $data = "($idVenda, \"$idProduto\", \"$qtdProduto\")";
        $sql = "INSERT INTO Pedido (idVenda, idProduto, qtdProduto) VALUES $data";
        mysqli_query($connection, $sql);
        $idPedido = mysqli_insert_id($connection);
        mysqli_close($connection);
        return new Pedido($idPedido, $idVenda, $idProduto, $qtdProduto);
    }

    public function getOnePedido($idPedido) {
        $connection = $this->connect();
        $sql = "SELECT * FROM Pedido WHERE idPedido = $idPedido";
        $result = mysqli_fetch_all(mysqli_query($connection, $sql), MYSQLI_ASSOC);
        mysqli_close($connection);
        return $result;
    }

    public function getAllPedidos() {
        $connection = $this->connect();
        $sql = "SELECT * FROM Pedido";
        $query = mysqli_query($connection, $sql);
        $result = mysqli_fetch_all($query, MYSQLI_ASSOC);
        mysqli_close($connection);
        return $result;
    }

    public function getAllPedidosByVenda($idVenda) {
        $connection = $this->connect();
        $sql = "SELECT * FROM Pedido WHERE idVenda = $idVenda";
        $result = mysqli_fetch_all(mysqli_query($connection, $sql), MYSQLI_ASSOC);
        mysqli_close($connection);
        return $result;
    }

    public function updatePedido($idPedido, $pedidoData) {
        $connection = $this->connect();
        $data = "idPedido = \"$pedidoData->idPedido\", idVenda = \"$pedidoData->idVenda\", idProduto =  \"$pedidoData->idProduto\", qtd_produto = \"$pedidoData->qtd_produto\"";
        $sql = "UPDATE Pedido SET $data WHERE idPedido = $pedidoData->idPedido";
        mysqli_query($connection, $sql);
        mysqli_close($connection);
    }

    public function deletePedido($idPedido) {
        $connection = $this->connect();
        $sql = "DELETE FROM Pedido WHERE idPedido = $idPedido";
        mysqli_query($connection, $sql);
        mysqli_close($connection);
    }
}
?>