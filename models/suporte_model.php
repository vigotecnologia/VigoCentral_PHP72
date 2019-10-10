<?php

class Suporte_Model extends Model {

    public function Lista_Atendimentos($cliente) {

        $this->Conecta();

        $query = "SELECT *, (CASE WHEN dt_fechamento IS NULL AND h_fechamento = '' AND fechado_por = '' THEN 'ABERTO' ELSE 'FECHADO' END) AS situacao FROM cadastro_atendimentos WHERE id_cliente='" . $cliente . "' ORDER BY situacao ASC, dt_abertura DESC, h_abertura DESC LIMIT 12";
        $row = $this->read($query);

        $this->Desconecta();

        return $row;
    }

    public function Lista_Anexos($cliente) {

        $this->Conecta();

        $query = "SELECT id, id_atendimento, tipo, extensao, descricao FROM cadastro_atendimentos_anexos WHERE id_cliente='" . $cliente . "' ORDER BY id_atendimento, id";
        $row = $this->read($query);

        $this->Desconecta();

        return $row;
    }

    public function Baixa_Anexo($id) {

        $this->Conecta();

        $query = "SELECT id, id_atendimento, tipo, extensao, descricao, dados FROM cadastro_atendimentos_anexos WHERE id='" . $id . "' and id_cliente='" . $_SESSION['ID_CLIENTE'] . "'";
        $row = $this->read($query);

        $this->Desconecta();

        return $row;
    }

    public function Lista_TiposAtendimento($id_empresa = null) {

        $this->Conecta();

        $query = "SELECT * FROM sistema_tipoatendimentos WHERE idempresa = " . $id_empresa . " ORDER BY descricao ASC";

        if (!$this->read($query)):
            $query = "SELECT * FROM sistema_tipoatendimentos WHERE idempresa = 9999 ORDER BY descricao ASC";
        endif;

        $row = $this->read($query);

        $this->Desconecta();

        return $row;
    }

    public function Abrir_Atendimento($id_empresa, $id_cliente, $id_funcionario, $desc_funcionario, $nome, $endereco, $bairro, $cep, $cidade, $uf, $telefone, $celular, $email, $numero_os, $dt_abertura, $dt_agendamento, $h_abertura, $h_agendamento, $descricao, $historico, $id_tatendimento, $desc_tatendimento, $aberto_por) {

        $this->Conecta();

        $query = "INSERT INTO cadastro_atendimentos (id_empresa, id_cliente, id_funcionario, desc_funcionario, nome, endereco, bairro, cep, cidade, uf, telefone, celular, email, numero_os, dt_abertura, dt_agendamento, h_abertura, h_agendamento, descricao, historico, id_tatendimento, desc_tatendimento, aberto_por) VALUES (" . $id_empresa . ", " . $id_cliente . ", " . $id_funcionario . ", '" . $desc_funcionario . "', '" . $nome . "', '" . $endereco . "', '" . $bairro . "', '" . $cep . "', '" . $cidade . "', '" . $uf . "', '" . $telefone . "', '" . $celular . "', '" . $email . "', '" . $numero_os . "', '" . $dt_abertura . "', '" . $dt_agendamento . "', '" . $h_abertura . "', '" . $h_agendamento . "', '" . $descricao . "', '" . $historico . "', " . $id_tatendimento . ", '" . $desc_tatendimento . "', '" . $aberto_por . "')";
        $row = $this->read($query);

        $this->Desconecta();

        return $row;
    }
}
?>