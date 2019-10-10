<?php

class MkSenha_Model extends Model {

    public function Lista_MkLogins($cliente) {

        $this->Conecta("mikrotik");
        $query = "SELECT username, value FROM radcheck WHERE id_cliente='" . $cliente . "' AND attribute='MD5-Password' ORDER BY username";
        $row = $this->read($query);
        $this->Desconecta();

        return $row;
    }

    public function Troca_MkSenha($id_cliente, $mk_login, $mk_senha) {

        $this->Conecta("mikrotik");

        $query = "UPDATE radcheck SET value='" . $mk_senha . "' WHERE id_cliente='" . $id_cliente . "' AND username='" . $mk_login . "' AND attribute='ClearText-Password'";
        $row = $this->read($query);

        $query = "UPDATE radcheck SET value=md5('" . $mk_senha . "') WHERE id_cliente='" . $id_cliente . "' AND username='" . $mk_login . "' AND attribute='MD5-Password'";
        $row = $this->read($query);

        $this->Desconecta();

        return $row;
    }
}
?>