<?php
    session_start();
    require_once("Controller.php");
    require_once("../persistance/VendaDAO.php");

    class VendaController extends Controller {

        function __construct () {
            $this->persistance = new VendaDAO();
        }

        function createVenda () {
            $user = $_SESSION["user"];
            $res = !!$this->persistance->createVenda($user);
            return $res;
        }

        function getAllVendas () {
            return $this->persistance->getAllVendas();
        }

        function deleteVenda ($idVenda) {
            $res = !!$this->persistance->deleteVenda($idVenda);
            return $res;
        }
    }
?>