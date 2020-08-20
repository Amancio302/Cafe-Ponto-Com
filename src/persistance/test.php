<html>
    <body>
        <?php
            function console_log( $data ){
                echo '<script>';
                echo 'console.log('. json_encode( $data ) .')';
                echo '</script>';
            }
            require_once("UsuarioDAO.php");
            $test = new UsuarioDAO();
            $obj = $test->getAllUsuarios();
            console_log($obj);
            $obj = $test->deleteUsuario(11);
            console_log($obj);
            $obj = $test->getAllUsuarios();
            console_log($obj);
        ?>
    </body>
</html>