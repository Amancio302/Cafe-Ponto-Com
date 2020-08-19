<?php
include_once("Database_Connect.php")
include_once("@/models/Pedido.php")

class Pedido extends Database_Connect{
    
    private $table = "Comprador"

    public function createPedido($idVenda, $idProduto, $qtdProduto) {
        $connection = $this->connect();
        $data = "($idVenda, \"$idProduto\", \"$qtdProduto\")";
        $sql = "INSERT INTO $this->table (idVenda, idProduto, qtdProduto) VALUES $data";
        mysqli_query($connection, $sql);
        $idPedido = mysqli_insert_id($connection);
        mysqli_close($connection);
        return new Pedido($idPedido, $idVenda, $idProduto, $qtdProduto);
    }

    public function getOnePedido($idPedido) {

    }

    public function getAllPedidos() {

    }

    public function getAllPedidosByVenda($idVenda) {

    }

    public function updatePedido($idPedido, $pedidoData) {

    }

    public function deletePedido($idPedido) {

    }
}
?>