<?php
include_once("Database_Connect.php, @/models/Venda.php");

class Venda extends Database_Connect{

    public function createVenda($idUsuario, $valor_total, $valor_pago, $tipo_transacao, $concluido) {
        $connection = $this->connect();
        $data = "(\"$idUsuario\", \"$valor_total\", \"$valor_pago\", \"$tipo_transacao\", \"$concluido\")";
        $sql = "INSERT INTO Venda (idUsuario, valor_total, valor_pago, tipo_transacao, concluido) VALUES $data";
        mysqli_query($connection, $sql);
        $idVenda = mysqli_insert_id($connection);
        mysqli_close($connection);
        return new Venda($idVenda, $idUsuario, $valor_total, $valor_pago, $tipo_transacao, $concluido);
    }

    public function getOneVenda($idVenda) {
        $connection = $this->connect();
        $sql = "SELECT * FROM Venda WHERE idVenda = $idVenda";
        $result = mysqli_fetch_all(mysqli_query($connection, $sql), MYSQLI_ASSOC);
        mysqli_close($connection);
        return $result;
    }

    public function getAllVendas() {
        $connection = $this->connect();
        $sql = "SELECT * FROM Venda";
        $query = mysqli_query($connection, $sql);
        $result = mysqli_fetch_all($query, MYSQLI_ASSOC);
        mysqli_close($connection);
        return $result;
    }

    public function updateVenda($idVenda, $VendaData) {
        $connection = $this->connect();
        $data = "(idUsuario = \"$idUsuario\", valor_total = \"$valor_total\", valor_pago \"$valor_pago\", tipo_transacao = \"$tipo_transacao\", concluido = \"$concluido\")";
        $sql = "UPDATE Venda SET $data WHERE idVenda = $VendaData->idVenda";
        mysqli_query($connection, $sql);
        mysqli_close($connection);
    }

    public function deleteVenda($idVenda) {
        $connection = $this->connect();
        $sql = "DELETE FROM Venda WHERE idVenda = $idVenda";
        mysqli_query($connection, $sql);
        mysqli_close($connection);
    }
}
?>