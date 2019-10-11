<?php

class Segvia_Model extends Model {

    public function Pesquisa_Banco($id) {

        $this->Conecta();
        $query = "SELECT id, nomebanco, agencia, conta, convenio, complemento, codigoescritural, codigotransmissao, tipo, cedente, idempresa FROM financeiro_bancos WHERE id='" . $id . "'";
        $row = $this->read2($query);
        $this->Desconecta();

        return $row;
    }

    public function Pesquisa_Boleto($id, $idcliente) {

        $this->Conecta();
        $query = "SELECT id, id_banco, id_cliente, id_empresa, nome, cpfcgc, endereco, cidade, bairro, uf, cep, referencia, numero, nossonumero, seunumero, emissao, vencimento, valor, obs, grupo_cliente, plano_conta, pago, pago_agencia, pago_data, pago_valor, pago_credito, pago_tarifa, pago_local, linhadigitavel, codigobarras, banco, agencia, conta, convenio, complemento, numerobanco, localpagamento, codigocedente, carteira, ativo, considerado, enviado, nf_arquivo, nf_numero, nf_situacao FROM financeiro_boletos WHERE id='" . $id . "' AND id_cliente='" . $idcliente . "' AND ativo='S'";
        $row = $this->read2($query);
        $this->Desconecta();

        return $row;
    }

    public function Pesquisa_Cliente($id) {

        $this->Conecta();
        $query = "SELECT * FROM cadastro_clientes WHERE id='" . $id . "'";
        $row = $this->read($query);
        $this->Desconecta();

        return $row;
    }
}
?>
