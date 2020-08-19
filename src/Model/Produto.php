<?php
class Produto {

    function __construct ($idProduto, $nome, $descricao, $preco, $quantidade, $addedBy) {
        $this->idProduto = $idProduto;
        $this->nome = $nome;
        $this->descricao = $descricao;
        $this->preco = $preco;
        $this->quantidade = $quantidade;
        $this->addedBy = $addedBy;
    }
}
?>