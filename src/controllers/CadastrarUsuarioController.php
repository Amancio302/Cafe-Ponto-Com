<?php
    require_once("../persistance/UsuarioDAO.php");
    require_once("../views/cadastrar.php");
    
    if ($_POST['inputPassword'] != null) {
        login($_POST['inputEmail'], $_POST['inputPassword']);
    }

    function console_log( $data ){
        echo '<script>';
        echo 'console.log('. json_encode( $data ) .')';
        echo '</script>';
    }

    function login ($email, $senha) {
        $Usuario = new UsuarioDAO();
        $res = $Usuario->login($email, $senha);
        if (!$res) {
            echo "<script>alert('Usuario inválido')</script>";
        } else {
            header('Location: ./DashboardController.php');
        }
    }
?>