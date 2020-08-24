<?php
    session_start();
    require_once("../persistance/ProdutoDAO.php");
    function console_log( $data ){
            echo '<script>';
            echo 'console.log('. json_encode( $data ) .')';
            echo '</script>';
        }

        function getAllProdutos () {
            console_log('AQUI');
            $Produto = new ProdutoDAO();
            return $Produto->getAllProdutos();
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

    if ($_SESSION["user"] != null) {
        require_once("../views/gerenciarProdutos.php");
    } else {
        header('Location: LoginController.php');
    }
?>