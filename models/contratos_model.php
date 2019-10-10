<?php

class Contratos_Model extends Model {

    public function Lista_Contratos($cliente) {

        $this->Conecta();
        $query = "SELECT * FROM cadastro_ged WHERE id_cliente='" . $cliente . "' AND descricao LIKE '%CONTRATO%'";
        $row = $this->read($query);
        $this->Desconecta();

        return $row;
    }

    public function Exibir_Contrato($cliente, $contrato) {

        $this->Conecta();
        $query = "SELECT * FROM cadastro_ged WHERE id_cliente='" . $cliente . "' AND id='" . $contrato . "'";
        $row = $this->read($query);
        $this->Desconecta();

        return $row;
    }
}
?>