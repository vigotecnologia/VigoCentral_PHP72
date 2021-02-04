<?php

class Index extends Controller {

    function __construct() {

        parent::__construct();

        @session_start();

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

        // Se não existir, adiciona as chaves na tabela: sistema_config
        if (!$config_model->Sistema_Config('MULTA')) { $config_model->Chave_Add('MULTA', '2,00', 'Define a taxa de multa por atraso'); }
        if (!$config_model->Sistema_Config('JUROS')) { $config_model->Chave_Add('JUROS', '0,33', 'Define a taxa de juros ao dia'); }
        if (!$config_model->Sistema_Config('CENTRAL_LOGIN')) { $config_model->Chave_Add('CENTRAL_LOGIN', 'wsconfig', 'Login de acesso para configurar a central'); }
        if (!$config_model->Sistema_Config('CENTRAL_SENHA')) { $config_model->Chave_Add('CENTRAL_SENHA', 'wsc1234', 'Senha de acesso para configurar a central'); }
        if (!$config_model->Sistema_Config('CENTRAL_TEMA')) { $config_model->Chave_Add('CENTRAL_TEMA', 'verde', 'Define o tema para central'); }
        if (!$config_model->Sistema_Config('CENTRAL_CONTRATO')) { $config_model->Chave_Add('CENTRAL_CONTRATO', 'custom', 'Define se o contrato é padrao ou personalizado'); }
        if (!$config_model->Sistema_Config('CENTRAL_GRAFICO')) { $config_model->Chave_Add('CENTRAL_GRAFICO', 'line', 'Define o tipo do grafico de acessos'); }
        if (!$config_model->Sistema_Config('CENTRAL_MOD_ALTERAR_SENHA')) { $config_model->Chave_Add('CENTRAL_MOD_ALTERAR_SENHA', 'S', 'Permite o cliente alterar a senha de acesso a central'); }
        if (!$config_model->Sistema_Config('CENTRAL_MOD_FATURAS')) { $config_model->Chave_Add('CENTRAL_MOD_FATURAS', 'S', 'Permite o cliente visualizar as faturas'); }
        if (!$config_model->Sistema_Config('CENTRAL_MOD_NFS')) { $config_model->Chave_Add('CENTRAL_MOD_NFS', 'S', 'Permite o cliente visualizar as notas fiscais'); }
        if (!$config_model->Sistema_Config('CENTRAL_MOD_SERVICOS')) { $config_model->Chave_Add('CENTRAL_MOD_SERVICOS', 'S', 'Permite o cliente visualizar os servicos contratados'); }
        if (!$config_model->Sistema_Config('CENTRAL_MOD_ACESSOS')) { $config_model->Chave_Add('CENTRAL_MOD_ACESSOS', 'S', 'Permite o cliente visualizar o extrato de acessos'); }
        if (!$config_model->Sistema_Config('CENTRAL_MOD_GRAFICOS')) { $config_model->Chave_Add('CENTRAL_MOD_GRAFICOS', 'S', 'Permite o cliente visualizar o grafico de acessos'); }
        if (!$config_model->Sistema_Config('CENTRAL_MOD_CONTRATOS')) { $config_model->Chave_Add('CENTRAL_MOD_CONTRATOS', 'S', 'Permite o cliente visualizar o contrato de prestacao de servico'); }
        if (!$config_model->Sistema_Config('CENTRAL_MOD_ATENDIMENTOS')) { $config_model->Chave_Add('CENTRAL_MOD_ATENDIMENTOS', 'S', 'Permite o cliente visualizar os atendimentos'); }
        if (!$config_model->Sistema_Config('CENTRAL_MOD_ABRIR_ATENDIMENTO')) { $config_model->Chave_Add('CENTRAL_MOD_ABRIR_ATENDIMENTO', 'S', 'Permite o cliente abrir atendimentos pela central'); }
        if (!$config_model->Sistema_Config('CENTRAL_MOD_ALTERAR_MKSENHA')) { $config_model->Chave_Add('CENTRAL_MOD_ALTERAR_MKSENHA', 'S', 'Permite o cliente alterar a senha de conexao'); }
        if (!$config_model->Sistema_Config('NF_IBPT_MUNICIPAL')) { $config_model->Chave_Add('NF_IBPT_MUNICIPAL', '2,00', 'Valor aproximado dos tributos municipais, fonte: IBPT'); }
        if (!$config_model->Sistema_Config('CENTRAL_MOD_TERMO_ACEITE')) { $config_model->Chave_Add('CENTRAL_MOD_TERMO_ACEITE', 'N', 'Define o termo de aceite para o cliente'); }

        // Aplica o tema da central
        $central_tema = $config_model->Sistema_Config('CENTRAL_TEMA');

        // Renderiza a view relacionada
        $this->view->config = new stdClass();
        $this->view->config->tema = $central_tema[0]['valor'];
        $this->view->empresa = $empresa;

        $this->view->render('index/index');
    }
}
?>
