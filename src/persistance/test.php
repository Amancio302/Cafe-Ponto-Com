<html>
    <body>
        <?php
            function console_log( $data ){
                echo '<script>';
                echo 'console.log('. json_encode( $data ) .')';
                echo '</script>';
            }
            echo "1<br>";
            require_once("ProdutoDAO.php");
            echo "2<br>";
            $test = new ProdutoDAO();
            echo "3<br>";
            echo "4<br>";
            echo "5<br>";
            $obj = $test->createProduto("Nome", "Descicao", 10.0, 100, 2);
            echo "6<br>";
            console_log($obj);
            echo "7<br>";
            $obj = $test->getAllProdutos();
            echo "8<br>";
            console_log($obj);
            echo "9<br>";
        ?>
    </body>
</html>