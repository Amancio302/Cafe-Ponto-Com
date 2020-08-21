<?php
require_once("Database_Connect.php");
require_once("UsuarioDAO.php");
require_once("../models/Venda.php");

class VendaDAO extends Database_Connect{

    public function createVenda($idUsuario) {
        $connection = $this->connect();
        $data = "($idUsuario, 0)";
        $sql = "INSERT INTO Venda (idUsuario, Concluida) VALUES $data";
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
        return $this->fetchData($result)[0];
    }

    public function getAllVendas() {
        $connection = $this->connect();
        $sql = "SELECT * FROM Venda";
        $result = $connection->query($sql);
        mysqli_close($connection);
        return $this->fetchData($result);
    }

    public function updateVenda($idVenda, $VendaData) {
        $connection = $this->connect();
        print_r($VendaData);
        $data = "idUsuario = $VendaData->idUsuario, Valor_Total = $VendaData->Valor_Total, Valor_Pago = $VendaData->Valor_Pago, Tipo_Transacao = \"$VendaData->Tipo_Transacao\" Concluida = $VendaData->Concluida";
        $sql = "UPDATE Venda SET $data WHERE idVenda = $idVenda";
        $res = mysqli_query($connection, $sql);
        mysqli_close($connection);
        return $this->getOneVenda($idVenda);
    }

    public function deleteVenda($idVenda) {
        $deleted = $this->getOneVenda($idVenda);
        $connection = $this->connect();
        $sql = "DELETE FROM Venda WHERE idVenda = $idVenda";
        print_r($sql);
        mysqli_query($connection, $sql);
        mysqli_close($connection);
        return $deleted;
    }

    private function fetchData($dataArray) {
        $res = array();
        foreach($dataArray as $Venda) {
            $Usuario = new UsuarioDAO();
            $usuario = $Usuario->getOneUsuario($idUsuario);
            $data = new Venda($Venda[idVenda], $usuario, $Venda[Valor_Total], $Venda[Valor_Pago], $Venda[Tipo_Transacao], $Venda[Concluida]);
            array_push($res, $data);
        }
        return $res;
    }
}
?>