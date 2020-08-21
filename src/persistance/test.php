<html>
    <body>
        <?php
            function console_log( $data ){
                echo '<script>';
                echo 'console.log('. json_encode( $data ) .')';
                echo '</script>';
            }
            require_once("ProdutoDAO.php");
            $test = new ProdutoDAO();
            $obj = $test->getAllProdutos();
            console_log($obj);
            //$obj = $test->createProduto("Nome", "Descricao", 20.54, 100, 2);
            //console_log($obj);
            $obj = $test->deleteProduto(1);
            console_log($obj);
            $obj = $test->getAllProdutos();
            console_log($obj);
        ?>
    </body>
</html>