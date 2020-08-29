<?php
require_once("Database_Connect.php");
require_once("UsuarioDAO.php");
require_once("PedidoDAO.php");
require_once("../models/Venda.php");

class VendaDAO extends Database_Connect{

    public function createVenda($idUsuario) {
        $connection = $this->connect();
        $data = "($idUsuario, 0, 0, 0, 0)";
        $sql = "INSERT INTO Venda (idUsuario, Valor_Total, Valor_Pago, Tipo_Transacao, Concluida) VALUES $data";
        $connection->query($sql);
        $idVenda = mysqli_insert_id($connection);
        mysqli_close($connection);
        $Usuario = new UsuarioDAO();
        $usuario = $Usuario->getOneUsuario($idUsuario);
        return new Venda($idVenda, $usuario, null, null, null, 0);
    }

    public function getOneVenda($idVenda) {
        $connection = $this->connect();
        $sql = "SELECT * FROM Venda WHERE idVenda = $idVenda";
        $result = $connection->query($sql);
        mysqli_close($connection);
        $res = $this->fetchData($result)[0];
        return $res;
    }

    public function getAllVendas() {
        $connection = $this->connect();
        $sql = "SELECT * FROM Venda";
        $result = $connection->query($sql);
        mysqli_close($connection);
        return $this->fetchData($result);
    }

    public function getAllPedidos($idVenda) {
        $Pedido = new PedidoDAO();
        return $Pedido->getAllPedidosByVenda($idVenda);
    }

    public function updateVenda($idVenda, $VendaData) {
        $connection = $this->connect();
        $concluida;
        if ($VendaData->Concluido) {
            $concluida = 1;
        } else {
            $concluida = 0;
        }
        $idUsuario = $VendaData->Usuario->idUsuario;
        $data = "idUsuario = $idUsuario, Valor_Total = $VendaData->Valor_Total, Valor_Pago = $VendaData->Valor_Pago, Tipo_Transacao = $VendaData->Tipo_Transacao, Concluida = $concluida";
        $sql = "UPDATE Venda SET $data WHERE idVenda = $idVenda";
        $connection->query($sql);
        mysqli_close($connection);
        return $this->getOneVenda($idVenda);
    }

    public function deleteVenda($idVenda) {
        $deleted = $this->getOneVenda($idVenda);
        $connection = $this->connect();
        $sql = "DELETE FROM Venda WHERE idVenda = $idVenda";
        mysqli_query($connection, $sql);
        mysqli_close($connection);
        return $deleted;
    }

    private function fetchData($dataArray) {
        $res = array();
        foreach($dataArray as $Venda) {
            $Usuario = new UsuarioDAO();
            $usuario = $Usuario->getOneUsuario($Venda[idUsuario]);
            $data = new Venda($Venda["idVenda"], $usuario, $Venda["Valor_Total"], $Venda["Valor_Pago"], $Venda["Tipo_Transacao"], $Venda["Concluida"]);
            array_push($res, $data);
        }
        return $res;
    }
}
?>