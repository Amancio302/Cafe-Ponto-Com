<?php
    session_start();
    require_once("../persistance/UsuarioDAO.php");

    function console_log( $data ){
        echo '<script>';
        echo 'console.log('. json_encode( $data ) .')';
        echo '</script>';
    }

    function getNome ($id) {
        $Usuario = new UsuarioDAO();
        $res = $Usuario->getOneUsuario($id);
        if (!$res) {
            echo "<script>alert('Algo deu errado')</script>";
        } else {
            return $res->Nome;
        }
    }

    function logout () {
        $_SESSION["user"] = null;
        header('Location: LoginController.php');
    }

    if ($_SESSION["user"] != null) {
        require_once("../views/dashboard.php");

        if (isset($_GET["id"])) {
            logout();
        }
    } else {
        header('Location: LoginController.php');
    }
?>