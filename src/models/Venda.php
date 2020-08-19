<?php
class Venda {

    function __construct ($idVenda, $idUsuario, $valor_total, $valor_pago, $tipo_transacao, $email, $concluido) {
        $this->idVenda = $idVenda;
        $this->idUsuario = $idUsuario;
        $this->valor_total = $valor_total;
        $this->valor_pago = $valor_pago;
        $this->tipo_transacao = $tipo_transacao;
        $this->email = $email;
        $this->concluido = $concluido;
    }
}
?>