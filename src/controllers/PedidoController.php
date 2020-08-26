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

        function editarPedido ($idPedido, $Pedido) {
            echo "ala";
            print_r($Pedido);
            return $this->persistance->updatePedido($idPedido, $Pedido);
        }
    }
?>