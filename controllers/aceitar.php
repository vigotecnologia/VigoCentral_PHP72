<?php

class Aceitar extends Controller {

    function __construct() {

        parent::__construct();

        @session_start();

        // Verifica se existe uma seção criada
        $this->funcoes->verificaSessao();

        /* DEFINE O CALLBACK E RECUPERA O POST */
        $CallBack = 'Agree';
        $PostData = filter_input_array(INPUT_POST, FILTER_DEFAULT);

        /* VALIDA A AÇÃO */
        if ($PostData && $PostData['callback_action'] && $PostData['callback'] == $CallBack):

            /* PREPARA OS DADOS DO POST */
            $Case = $PostData['callback_action'];
            unset($PostData['callback'], $PostData['callback_action']);

            /* ELIMINA CÓDIGOS */
            $PostData = array_map('strip_tags', $PostData);

            /* SELECIONA AÇÃO */
            switch ($Case):

                /* MANAGER */
                case 'manager':

                    /* VERIFICA SE O USUÁRIO ACEITOU O TERMO */
                    if(isset($PostData['term_action']) && isset($PostData['term_check'])
                        && ($PostData['term_action'] == "Aceito") && ($PostData['term_check'] == "on")):

                        // Instancia a classe de MODEL relacionado
                        require 'models/sessao_model.php'; // O MODEL não é "auto-carregado" como as libs
                        $core_model = new Sessao_Model();

                        require 'models/aceite_model.php'; // O MODEL não é "auto-carregado" como as libs
                        $aceite_model = new Aceite_Model();

                        // Captura as informações do cliente autenticado corretamente
                        $dados = $core_model->Dados_Cliente($_SESSION['LOGIN']);

                        $cliente_id = (int) $dados[0]['id'];
                        $contrato_aceito = 'S';
                        $contrato_data = date('Y-m-d');
                        $contrato_hora = date('H:i:s');

                        // Processa e registra o aceite do termo
                        $aceite_model->Aceitar_Termo($cliente_id, $contrato_aceito, $contrato_data, $contrato_hora);

                        // Redireciona para o controller relacionado
                        @@header("Location: core");
                    else:

                        // SE NÃO ACEITOU O TERMO, POR SEGURANÇA FAZ O LOGOUT
                        @header("Location: logout");
                        exit;
                    endif;
                break;
            endswitch;
        else:
            // SE NÃO ACEITOU O TERMO, POR SEGURANÇA FAZ O LOGOUT
            @header("Location: logout");
            exit;
        endif;
    }
}
?>