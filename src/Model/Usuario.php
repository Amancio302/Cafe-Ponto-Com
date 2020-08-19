<?php
class Usuario {

    function __construct ($idUsuario, $cpf, $nome, $telefone, $endereco, $email, $admin, $qtd_vendas, $valor_comissao) {
        $this->idUsuario = $idUsuario;
        $this->cpf = $cpf;
        $this->nome = $nome;
        $this->telefone = $telefone;
        $this->endereco = $endereco;
        $this->email = $email;
        $this->admin = $admin;
        $this->qtd_vendas = $qtd_vendas;
        $this->valor_comissao = $valor_comissao;
    }
}
?>