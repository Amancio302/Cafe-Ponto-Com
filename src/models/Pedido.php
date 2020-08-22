<?php
class Pedido {

    function __construct ($idPedido, $Venda, $Produto, $qtdProduto) {
        $this->idPedido = $idPedido;
        $this->Venda = $Venda;
        $this->Produto = $Produto;
        $this->qtdProduto = $qtdProduto;
    }
}
?>