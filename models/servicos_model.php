<?php

class Servicos_Model extends Model {

    public function Lista_Servicos($cliente) {

        $this->Conecta();
        $query = "SELECT * FROM financeiro_planos_clientes WHERE idcliente='" . $cliente . "' ORDER BY descricao";
        $row = $this->read($query);
        $this->Desconecta();

        return $row;
    }
}
?>