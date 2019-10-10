<?php

class Model {

    private $db;
    private $result;
    private $conexao;

    function __construct() {
        $funcoes = new Functions();
        $this->conexao = $funcoes->carregaBDS();
    }

    protected function Conecta($database = null) {
        if ($database == null ? $database = "vigo" : $database);
        $this->db = @mysqli_connect($this->conexao[$database][0], $this->conexao[$database][2], $this->conexao[$database][3]) or die("Erro ao tentar conectar no banco de dados !");
        @mysqli_set_charset($this->db, "utf8");
        @mysqli_select_db($this->db, $this->conexao[$database][1]);
    }

    protected function executar($sql) {
        $result = @mysqli_query($this->db, $sql);
        return $result;
    }

    protected function MySQLFetchAll($resultado) {
        $buscarTudo = array();
        while ($buscarTudo[] = @mysqli_fetch_assoc($resultado)) {
        }
        return $buscarTudo;
    }

    protected function read($query) {
        $resultado = $this->executar($query);
        $dados = $this->MySQLFetchAll($resultado);
        if (end($dados) == null)
            array_pop($dados);
        return $dados;
    }

    protected function read2($query) {
        $resultado = $this->executar($query);
        $dados = mysqli_fetch_row($resultado);
        return $dados;
    }

    protected function Desconecta() {
        @mysqli_free_result($this->result);
        @mysqli_close($this->db);
    }
}
?>
