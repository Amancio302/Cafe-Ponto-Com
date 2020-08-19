<?php
class Pedido {

    function __construct ($idVenda, $isProduto, $qtdProduto) {
        $this->idVenda = $idVenda;
        $this->isProduto = $isProduto;
        $this->qtdProduto = $qtdProduto;
    }
}
?>