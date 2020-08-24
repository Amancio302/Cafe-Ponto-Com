<?php
    require_once("../persistance/ProdutoDAO.php");
    require_once("../views/gerenciarProdutos.php");

    function getAllProdutos () {
        $Produto = new ProdutoDAO();
        return $Produto->getAllProdutos();
    }

    function getOneProduto ($id) {
        $Produto = new ProdutoDAO();
        return $Produto->getOneProduto($id);
    }

    function deleteProduto ($id) {
        $Produto = new ProdutoDAO();
        $res = $Produto->deleteProduto($id);
        if ($res) {
            echo "<script>alert('Registro excluído com sucesso')</script>";
            return $res;
        }
        else
            echo "<script>alert('Registro não pode ser excluído')</script>";
    }

    if($_POST['id'] != null) {
        console_log('AQUI');
        console_log($_POST);
        console_log(deleteProduto($_POST['id']));
    }

?>