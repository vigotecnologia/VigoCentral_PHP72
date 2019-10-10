<?php

class Empresa_Model extends Model {

    public function Dados_Empresa($id_empresa) {

        $this->Conecta();

        $query = "SELECT * FROM sistema_empresas WHERE id='" . $id_empresa . "'";
        $row = $this->read($query);

        $this->Desconecta();

        return $row;
    }
}
?>