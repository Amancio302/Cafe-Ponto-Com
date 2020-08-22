<html>
    <body>
        <?php
            function console_log( $data ){
                echo '<script>';
                echo 'console.log('. json_encode( $data ) .')';
                echo '</script>';
            }
            require_once("VendaDAO.php");
            $test = new VendaDAO();
            //$obj = $test->getAllVendas();
            //console_log($obj);
            //$obj = $test->createVenda(4, 4, 2);
            //console_log($obj);
            //$obj = $test->updateVenda(1, $obj);
            //console_log($obj);
            //$obj = $test->deleteVenda(2);
            //console_log($obj);
            //$obj = $test->getAllVendas();
            //console_log($obj);
            //$obj = $test->getAllPedidos(4);
            //console_log($obj);
        ?>
    </body>
</html>