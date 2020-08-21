<?php
class Produto {

    function __construct ($idProduto, $Nome, $Descricao, $Preco, $Quantidade, $addedBy) {
        $this->idProduto = $idProduto;
        $this->Nome = $Nome;
        $this->Descricao = $Descricao;
        $this->Preco = $Preco;
        $this->Quantidade = $Quantidade;
        $this->addedBy = $addedBy;
    }
}
?>