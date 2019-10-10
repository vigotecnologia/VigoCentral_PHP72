<?php

class MkSenha_Model extends Model {

    public function Lista_MkLogins($cliente) {

        $this->Conecta("mikrotik");
        $query = "SELECT Username, Value FROM radcheck WHERE id_cliente='" . $cliente . "' AND Attribute='MD5-Password' ORDER BY Username";
        $row = $this->read($query);
        $this->Desconecta();

        return $row;
    }

    public function Troca_MkSenha($id_cliente, $mk_login, $mk_senha) {

        $this->Conecta("mikrotik");

        $query = "UPDATE radcheck SET Value='" . $mk_senha . "' WHERE id_cliente='" . $id_cliente . "' AND Username='" . $mk_login . "' AND Attribute='ClearText-Password'";
        $row = $this->read($query);

        $query = "UPDATE radcheck SET Value=md5('" . $mk_senha . "') WHERE id_cliente='" . $id_cliente . "' AND Username='" . $mk_login . "' AND Attribute='MD5-Password'";
        $row = $this->read($query);

        $this->Desconecta();

        return $row;
    }
}
?>