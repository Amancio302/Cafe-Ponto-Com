<?php
    session_start();
    require_once("../persistance/ProdutoDAO.php");
    require_once("../views/cadastrarProduto.html");
    
    if ($_POST["nomeProduto"] != null) {
        cadastrar($_POST["nomeProduto"], $_POST["descricaoProduto"], $_POST["precoProduto"]);
    }

    function console_log( $data ){
        echo '<script>';
        echo 'console.log('. json_encode( $data ) .')';
        echo '</script>';
    }

    function cadastrar ($nome, $descricao, $preco) {
        $Produto = new ProdutoDAO();
        $user = $_SESSION["user"];
        console_log($user);
        $res = $Produto->createProduto($nome, $descricao, $preco, 0, $user);
        echo "<script>alert('Produto Cadastrado')</script>";
    }
?>