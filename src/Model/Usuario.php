<?php
public class Usuario {

    public $idUsuario;
    public $cpf;
    public $telefone;
    public $endereco;
    public $email;
    public $admin;
    public $qtd_vendas;
    public $valor_comissao;

    function __construct (idUsuario, cpf, telefone, endereco, email, boolen admin, qtd_vendas, valor_comissao) {
        $this->idUsuario = idUsuario;
        $this->cpf = cpf;
        $this->telefone = telefone;
        $this->endereco = endereco;
        $this->email = email;
        $this->admin = admin;
        $this->qtd_vendas = qtd_vendas;
        $this->valor_comissao = valor_comissao;
    }
}
?>