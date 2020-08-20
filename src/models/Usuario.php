<?php

class Usuario {

    public function __construct ($idUsuario, $CPF, $Nome, $Telefone, $Endereco, $Email, $Admin, $Qtd_Vendas, $Valor_Comissao) {
        $this->idUsuario = $idUsuario;
        $this->CPF = $CPF;
        $this->Nome = $Nome;
        $this->Telefone = $Telefone;
        $this->Endereco = $Endereco;
        $this->Email = $Email;
        $this->Admin = $Admin;
        $this->Qtd_Vendas = $Qtd_Vendas;
        $this->Valor_Comissao = $Valor_Comissao;
    }
}

?>