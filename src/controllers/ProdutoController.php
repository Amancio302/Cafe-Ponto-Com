<?php
    if(!isset($_SESSION)) 
    { 
        session_start(); 
    }
    require_once("Controller.php");
    require_once("../persistance/ProdutoDAO.php");

    class ProdutoController extends Controller {

        function __construct () {
            $this->persistance = new ProdutoDAO();
        }

        function createProduto ($nome, $descricao, $preco) {
            $user = $_SESSION["user"];
            $res = !!$this->persistance->createProduto($nome, $descricao, $preco, 0, $user);
            return $res;
        }

        function getAllProdutos () {
            return $this->persistance->getAllProdutos();
        }

        function getOneProduto ($idProduto) {
            return $this->persistance->getOneProduto($idProduto);
        }

        function deleteProduto ($idProduto) {
            $res = !!$this->persistance->deleteProduto($idProduto);
            return $res;
        }

        function editarProduto($idProduto, $Nome, $Descricao, $Preco, $Quantidade, $addedBy) {
            $produto = $this->getOneProduto($idProduto);
            $produto->Nome = $Nome;
            $produto->Descricao = $Descricao;
            $produto->Preco = $Preco;
            $produto->Quantidade = $Quantidade;
            $res = !!$this->persistance->updateProduto($idProduto, $produto);
            return $res;
        }
    }
?>