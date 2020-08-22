<?php
require_once("Database_Connect.php");
require_once("VendaDAO.php");
require_once("ProdutoDAO.php");
require_once("../models/Pedido.php");

class PedidoDAO extends Database_Connect{

    public function createPedido($idVenda, $idProduto, $qtdProduto) {
        $connection = $this->connect();
        $data = "($idVenda, $idProduto, $qtdProduto)";
        $sql = "INSERT INTO Pedido (idVenda, idProduto, qtdProduto) VALUES $data";
        $connection->query($sql);
        $idPedido = mysqli_insert_id($connection);
        mysqli_close($connection);
        $Venda = new VendaDAO();
        $venda = $Venda->getOneVenda($idVenda);
        $Produto = new ProdutoDAO();
        $produto = $Produto->getOneProduto($idProduto);
        return new Pedido($idPedido, $venda, $produto, $qtdProduto);
    }

    public function getOnePedido($idPedido) {
        $connection = $this->connect();
        $sql = "SELECT * FROM Pedido WHERE idPedido = $idPedido";
        $result = $connection->query($sql);
        mysqli_close($connection);
        return $this->fetchData($result)[0];
    }

    public function getAllPedidos() {
        $connection = $this->connect();
        $sql = "SELECT * FROM Pedido";
        $result = $connection->query($sql);
        mysqli_close($connection);
        return $this->fetchData($result);
    }

    public function getAllPedidosByVenda($idVenda) {
        $connection = $this->connect();
        $sql = "SELECT * FROM Pedido WHERE idVenda = $idVenda";
        $result = $connection->query($sql);
        mysqli_close($connection);
        return $this->fetchData($result);
    }

    public function updatePedido($idPedido, $PedidoData) {
        $connection = $this->connect();
        $idVenda = $PedidoData->Venda->idVenda;
        $idProduto = $PedidoData->Produto->idProduto;
        $data = "idVenda = $idVenda, idProduto = $idProduto, qtdProduto = $PedidoData->qtdProduto";
        $sql = "UPDATE Pedido SET $data WHERE idPedido = $idPedido";
        $res = mysqli_query($connection, $sql);
        mysqli_close($connection);
        return $this->getOnePedido($idPedido);
    }

    public function deletePedido($idPedido) {
        $deleted = $this->getOnePedido($idPedido);
        $connection = $this->connect();
        $sql = "DELETE FROM Pedido WHERE idPedido = $idPedido";
        mysqli_query($connection, $sql);
        mysqli_close($connection);
        return $deleted;
    }

    private function fetchData($dataArray) {
        $res = array();
        foreach($dataArray as $Pedido) {
            $Venda = new VendaDAO();
            $venda = $Venda->getOneVenda($Pedido[idVenda]);
            $Produto = new ProdutoDAO();
            $produto = $Produto->getOneProduto($Pedido[idProduto]);
            $data = new Pedido($Pedido[idPedido], $venda,  $produto, $Pedido[qtdProduto]);
            array_push($res, $data);
        }
        return $res;
    }
}
?>