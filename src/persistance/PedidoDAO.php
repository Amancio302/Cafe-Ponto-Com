<?php
require_once("Database_Connect.php");
require_once("VendaDAO.php");
require_once("ProdutoDAO.php");
require_once("../models/Pedido.php");

class PedidoDAO extends Database_Connect{

    public function createPedido($idVenda, $idProduto, $qtdProduto) {
        // Conecta ao BD
        $connection = $this->connect();
        // Monta o Script Sql
        $data = "($idVenda, $idProduto, $qtdProduto)";
        $sql = "INSERT INTO Pedido (idVenda, idProduto, qtdProduto) VALUES $data";
        // Executa a Query
        $connection->query($sql);
        // Resgata qual o id inserido
        $idPedido = mysqli_insert_id($connection);
        // Fecha a conexão
        mysqli_close($connection);
        // Atualiza o valor total da venda relacionada
        $Venda = new VendaDAO();
        $venda = $Venda->getOneVenda($idVenda);
        $Produto = new ProdutoDAO();
        $produto = $Produto->getOneProduto($idProduto);
        $venda->Valor_Total = $venda->Valor_Total + ($produto->Preco * $qtdProduto);
        $Venda->updateVenda($idVenda, $venda);
        // Contrói um objeto Pedido para ser retornado
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
        // Conecta ao BD
        $connection = $this->connect();
        // Resgata dados pertinentes de PedidoData
        $idVenda = $PedidoData->Venda->idVenda;
        $idProduto = $PedidoData->Produto->idProduto;
        // Atualiza o valor total
        $Venda = new VendaDAO();
        $venda = $Venda->getOneVenda($idVenda);
        $pedidoAntigo = $this->getOnePedido($idPedido);
        $precoantigo = $pedidoAntigo->Produto->Preco * $pedidoAntigo->qtdProduto;
        $venda->Valor_Total = $venda->Valor_Total - $precoantigo;
        $preconovo = $PedidoData->Produto->Preco * $PedidoData->qtdProduto;
        $venda->Valor_Total = $venda->Valor_Total + $preconovo;
        // Monta o Script Sql
        $data = "idVenda = $idVenda, idProduto = $idProduto, qtdProduto = $PedidoData->qtdProduto";
        $sql = "UPDATE Pedido SET $data WHERE idPedido = $idPedido";
        // Executa a Query
        $res = $connection->query($sql);
        // Fecha a conexão
        mysqli_close($connection);
        // Salva o valor total da venda relacionada
        $Venda->updateVenda($idVenda, $venda);
        return $this->getOnePedido($idPedido);
    }

    public function deletePedido($idPedido) {
        // Resgata os dados do pedido deletado para ser retornado
        $deleted = $this->getOnePedido($idPedido);
        // Conecta ao BD
        $connection = $this->connect();
        // Monta o Script SQL
        $sql = "DELETE FROM Pedido WHERE idPedido = $idPedido";
        // Executa a Query
        mysqli_query($connection, $sql);
        // Fecha a conexão
        $Venda = new VendaDAO();
        $venda = $Venda->getOneVenda($deleted->Venda->idVenda);
        $venda->Valor_Total = $venda->Valor_Total - ($deleted->Produto->Preco * $deleted->qtdProduto);
        $Venda->updateVenda($venda->idVenda, $venda);
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
            $data = new Pedido($Pedido["idPedido"], $venda,  $produto, $Pedido["qtdProduto"]);
            array_push($res, $data);
        }
        return $res;
    }
}
?>