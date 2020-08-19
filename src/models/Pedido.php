<?php
class Pedido {

    function __construct ($idPedido, $idVenda, $idProduto, $qtdProduto) {
        $this->idPedido = $idPedido;
        $this->idVenda = $idVenda;
        $this->idProduto = $idProduto;
        $this->qtdProduto = $qtdProduto;
    }
}
?>