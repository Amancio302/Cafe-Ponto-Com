<?php
    if(!isset($_SESSION)) 
    { 
        session_start(); 
    }
    require_once("Controller.php");
    require_once("ProdutoController.php");
    require_once("PedidoController.php");
    require_once("../persistance/VendaDAO.php");

    class VendaController extends Controller {

        function __construct () {
            $this->persistance = new VendaDAO();
        }

        function createVenda () {
            $user = $_SESSION["user"];
            $res = $this->persistance->createVenda($user);
            return $res->idVenda;
        }

        function getProdutos () {
            $produto = new ProdutoController();
            $res = $produto->getAllProdutos();
            return $res;
        }

        function deletarPedido ($id) {
            $pedido = new PedidoController();
            $res = $pedido->deletePedido($id);
            return $res;
        }

        function getAllVendas () {
            $res = $this->persistance->getAllVendas();
            return $res;
        }

        function createPedido ($idPedido, $idProduto, $qtd) {
            $pedido = new PedidoController();
            $res = $pedido->createPedido($idPedido, $idProduto, $qtd);
            return $res;
        }

        function fecharVenda ($idVenda, $transacao, $Valor_Pago) {
            $venda = $this->persistance->getOneVenda($idVenda);
            $venda->Concluido = true;
            $venda->Tipo_Transacao = $transacao;
            $venda->Valor_Pago = $Valor_Pago;
            return !!$this->persistance->updateVenda($idVenda, $venda);
        }

        function getVenda ($idVenda) {
            $res = $this->persistance->getOneVenda($idVenda);
            return $res;
        }

        function getPedidos ($idVenda) {
            $res = $this->persistance->getAllPedidos($idVenda);
            return $res;
        }

        function deleteVenda ($idVenda) {
            $res = !!$this->persistance->deleteVenda($idVenda);
            return $res;
        }
    }
?>