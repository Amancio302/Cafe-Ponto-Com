<?php
include_once("Database_Connect.php, @/models/Produto.php");

class Produto extends Database_Connect{

    public function createProduto($cpf, $nome, $telefone, $endereco, $email, $admin, $qtd_vendas, $valor_comissao) {
        $connection = $this->connect();
        $data = "(\"$cpf\", \"$nome\", \"$telefone\", \"$endereco\", \"$email\", \"$admin\", \"$qtd_vendas\", \"$valor_comissao\")";
        $sql = "INSERT INTO Produto (cpf, nome, telefone, endereco, email, admin, qtd_vendas, valor_comissao) VALUES $data";
        mysqli_query($connection, $sql);
        $idProduto = mysqli_insert_id($connection);
        mysqli_close($connection);
        return new Produto($idProduto, $cpf, $nome, $telefone, $endereco, $email, $admin, $qtd_vendas, $valor_comissao);
    }

    public function getOneProduto($idProduto) {
        $connection = $this->connect();
        $sql = "SELECT * FROM Produto WHERE idProduto = $idProduto";
        $result = mysqli_fetch_all(mysqli_query($connection, $sql), MYSQLI_ASSOC);
        mysqli_close($connection);
        return $result;
    }

    public function getAllProdutos() {
        $connection = $this->connect();
        $sql = "SELECT * FROM Produto";
        $query = mysqli_query($connection, $sql);
        $result = mysqli_fetch_all($query, MYSQLI_ASSOC);
        mysqli_close($connection);
        return $result;
    }

    public function updateProduto($idProduto, $ProdutoData) {
        $connection = $this->connect();
        $data = "(cpf = \"$cpf\", nome = \"$nome\", telefone = \"$telefone\", endereco = \"$endereco\", email = \"$email\", admin = \"$admin\", qtd_vendas = \"$qtd_vendas\", valor_comissao = \"$valor_comissao\")";
        $sql = "UPDATE Produto SET $data WHERE idProduto = $ProdutoData->idProduto";
        mysqli_query($connection, $sql);
        mysqli_close($connection);
    }

    public function deleteProduto($idProduto) {
        $connection = $this->connect();
        $sql = "DELETE FROM Produto WHERE idProduto = $idProduto";
        mysqli_query($connection, $sql);
        mysqli_close($connection);
    }
}
?>