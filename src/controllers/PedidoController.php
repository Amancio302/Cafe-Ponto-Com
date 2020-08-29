<?php
    if(!isset($_SESSION)) 
    { 
        session_start(); 
    }
    require_once("Controller.php");
    require_once("ProdutoController.php");
    require_once("../persistance/PedidoDAO.php");

    class PedidoController extends Controller {

        function __construct () {
            $this->persistance = new PedidoDAO();
        }

        function createPedido ($idVenda, $idProduto, $qtd) {
            $res = !!$this->persistance->createPedido($idVenda, $idProduto, $qtd);
            return $res;
        }

        function getAllPedidos () {
            return $this->persistance->getAllPedidos();
        }

        function getOnePedido ($idPedido) {
            return $this->persistance->getOnePedido($idPedido);
        }

        function deletePedido ($idPedido) {
            $res = !!$this->persistance->deletePedido($idPedido);
            return $res;
        }

        function getAllProdutos () {
            $Produto = new ProdutoController();
            return $Produto->getAllProdutos();
        }

        function editarPedido ($idPedido, $Pedido, $idProduto) {
            echo 2;
            $Produto = new ProdutoController();
            echo 3;
            $produto = $Produto->getOneProduto($idProduto);
            echo 4;
            $Pedido->Produto = $produto;
            return !!$this->persistance->updatePedido($idPedido, $Pedido);
        }
    }
?>