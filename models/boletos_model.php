<?php

class Boletos_Model extends Model {

    public function Lista_Boletos($cliente) {

        $this->Conecta();
        $query = "SELECT id, id_cliente, nossonumero, referencia, vencimento, valor, pago_data, pago_valor FROM financeiro_boletos WHERE id_cliente='" . $cliente . "' AND ativo='S' ORDER BY pago ASC, pago_data DESC, vencimento DESC";
        $row = $this->read($query);
        $this->Desconecta();

        return $row;
    }

    public function Referencia_Boleto($id_banco, $nosso_numero) {

        $this->Conecta();
        $query = "SELECT referencia FROM financeiro_boletos WHERE id_banco='" . $id_banco . "' AND nossonumero='" . $nosso_numero . "' LIMIT 1";
        $row = $this->read($query);
        $this->Desconecta();

        return $row;
    }

    public function Lista_Debitos($cliente) {

        $this->Conecta();
        $query = "SELECT * FROM financeiro_debconta_cliente WHERE id_cliente='" . $cliente . "' ORDER BY dt_vencimento DESC";
        $row = $this->read($query);
        $this->Desconecta();

        return $row;
    }
}
?>
