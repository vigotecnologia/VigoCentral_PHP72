<?php

class Config_Model extends Model {

    public function Sistema_Config($chave) {

        $this->Conecta();
        $query = "SELECT * FROM sistema_config WHERE chave='" . $chave . "' LIMIT 1";
        $row = $this->read($query);
        $this->Desconecta();

        return $row;
    }

    public function Chave_Add($chave, $valor, $descricao) {

        $this->Conecta();
        $query = "INSERT INTO sistema_config VALUES ('" . $chave . "', '" . $valor . "', '" . $descricao . "')";
        $row = $this->read($query);
        $this->Desconecta();

        return $row;
    }

    public function Chave_Edit($chave, $valor) {

        $this->Conecta();
        $query = "UPDATE sistema_config SET valor='" . $valor . "' WHERE chave='" . $chave . "' LIMIT 1";
        $row = $this->read($query);
        $this->Desconecta();

        return $row;
    }
}
?>