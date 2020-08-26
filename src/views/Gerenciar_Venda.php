<?php
    session_start();
    require_once("View.php");
    require_once("../controllers/VendaController.php");

    class Gerenciar_Venda extends View {

        function __construct () {
            $this->needAuth = true;
            $this->controller = new VendaController();
            $this->name = 'Gerenciar_Venda';
        }

        function output () {
            return "";
        }
    }

    $view = new Gerenciar_Venda();

    // Aqui testamos os POST e GETS da página renderizada

    if (isset($_GET["sair"])) {
        $view->sair();
    }

    // Aqui renderizamos a página

    $view->render();
?>