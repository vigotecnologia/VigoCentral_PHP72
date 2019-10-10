<?php

class Extrato_Model extends Model {

    public function Lista_MkLogins($cliente) {

        $this->Conecta("mikrotik");
        $query = "SELECT DISTINCT username FROM radcheck WHERE id_cliente='" . $cliente . "' AND attribute='MD5-Password' ORDER BY username";
        $row = $this->read($query);
        $this->Desconecta();

        return $row;
    }

    public function Lista_Acessos($login, $dtInicio, $dtFinal) {

        $this->Conecta("mikrotik");
        $query = "SELECT * FROM radacct WHERE (username='" . $login . "') AND (acctstarttime BETWEEN '" . $dtInicio . "' AND '" . $dtFinal . "') AND (acctstoptime is null) ORDER by acctstarttime ASC";
        $row = $this->read($query);
        $this->Desconecta();

        return $row;
    }

    public function Exibir_Plano($login) {

        $this->Conecta("mikrotik");
        $query = "SELECT DISTINCT ug.username, ug.groupname, radgroupreply.attribute, radgroupreply.value FROM radcheck LEFT JOIN usergroup ug ON radcheck.username=ug.username LEFT JOIN radgroupreply using(groupname) WHERE radgroupreply.attribute='Mikrotik-Rate-Limit' AND ug.username='" . $login . "'";
        $row = $this->read($query);
        $this->Desconecta();

        return $row;
    }
}
?>