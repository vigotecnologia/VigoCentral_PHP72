<?php

class Envia_Model extends Model {

    public function Pesquisa_Mail($email) {
        $this->Conecta();

        $query = "SELECT login, senha FROM cadastro_clientes WHERE email='" . $email . "' LIMIT 1";
        $row = $this->read2($query);

        $this->Desconecta();

        return $row; // Array, [0] = Login, [1] = Senha
    }
}
?>