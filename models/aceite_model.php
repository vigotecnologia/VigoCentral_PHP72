<?php

class Aceite_Model extends Model {

    public function Aceitar_Termo($cliente_id, $contrato_aceito, $contrato_data, $contrato_hora) {

        $this->Conecta();
        $query = "UPDATE cadastro_clientes SET contrato_aceito = '{$contrato_aceito}', contrato_data = '{$contrato_data}', contrato_hora = '{$contrato_hora}' WHERE id='{$cliente_id}'";
        $row = $this->read($query);
        $this->Desconecta();

        return $row;
    }
}
?>
