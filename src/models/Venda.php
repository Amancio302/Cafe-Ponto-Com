<?php

class Venda {

    public function __construct ($idVenda, $Usuario, $Valor_Total, $Valor_Pago, $Tipo_Transacao, $Concluido) {
        $this->idVenda = $idVenda;
        $this->Usuario = $Usuario;
        $this->Valor_Total = $Valor_Total;
        $this->Valor_Pago = $Valor_Pago;
        $this->Tipo_Transacao = $Tipo_Transacao;
        $this->Concluido = $Concluido;
    }
}
?>