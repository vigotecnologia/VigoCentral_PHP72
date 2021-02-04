<?php

class Aceite extends Controller {

    function __construct() {

        parent::__construct();

        @session_start();

        $funcoes = new Functions();

        // Instancia a classe de MODEL relacionado
        require 'models/empresa_model.php';
        $empresa_model = new Empresa_Model();

        require 'models/config_model.php'; // O MODEL não é "auto-carregado" como as libs
        $config_model = new Config_Model();

        // Consulta dados da empresa para exibição da logo
        $id_empresa = 1;
        $dados_empresa = $empresa_model->Dados_Empresa($id_empresa);

        $empresa = new stdClass();
        $empresa->foto = $dados_empresa[0]['foto'];
        $empresa->fantasia = utf8_encode($dados_empresa[0]['fantasia']);

        // Aplica o tema da central
        $central_tema = $config_model->Sistema_Config('CENTRAL_TEMA');

        // Renderiza a view relacionada
        $this->view->config = new stdClass();
        $this->view->config->tema = $central_tema[0]['valor'];
        $this->view->empresa = $empresa;
        $this->view->termo = $funcoes->carregaAceite();

        $this->view->render('aceite/index');
    }
}
?>
