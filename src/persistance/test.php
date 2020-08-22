<html>
    <body>
        <?php
            function console_log( $data ){
                echo '<script>';
                echo 'console.log('. json_encode( $data ) .')';
                echo '</script>';
            }
            require_once("PedidoDAO.php");
            $test = new PedidoDAO();
            $obj = $test->getAllPedidos();
            console_log($obj);
            //$obj = $test->createPedido(4, 4, 2);
            //console_log($obj);
            //$obj = $test->updatePedido(1, $obj);
            //console_log($obj);
            $obj = $test->deletePedido(2);
            console_log($obj);
            $obj = $test->getAllPedidos();
            console_log($obj);
        ?>
    </body>
</html>