<?php

class Mksenha extends Controller {

    function __construct() {

        parent::__construct();

        // Verifica se existe uma seção criada
        $this->funcoes->verificaSessao();

        // Remove aspas do conteúdo postado (segurança contra SQL Injection) e limitando a 50 caracteres
        @$mkLogin = substr($this->funcoes->removeAspas($_POST['txtLogin']), 0, 50);
        @$senhaAtual = substr($this->funcoes->removeAspas($_POST['txtSenhaAtual']), 0, 50);
        @$senhaNova = substr($this->funcoes->removeAspas($_POST['txtSenhaNova']), 0, 50);
        @$senhaConfirma = substr($this->funcoes->removeAspas($_POST['txtSenhaConfirma']), 0, 50);

        // Instancia a classe de MODEL relacionado
        require 'models/mksenha_model.php'; // O MODEL não é "auto-carregado" como as libs
        $mksenha_model2 = new MkSenha_Model();

        // Consulta os mk_logins do cliente
        $query_lista = $mksenha_model2->Lista_MkLogins($_SESSION['ID_CLIENTE']);

        if (($senhaAtual != '') && ($senhaNova != '') && ($senhaConfirma != '')) {

            if (md5($senhaAtual) == $query_lista[0][Value]):

                if ($senhaNova == $senhaConfirma):

                    // Troca a senha
                    $mksenha_model2->Troca_MkSenha($_SESSION['ID_CLIENTE'], $mkLogin, $senhaNova);

                    // Exibe a mensagem informando que a senha foi alterada
                    @session_start();
                    $_SESSION['ALERTA_TIPO'] = 'sucesso';
                    $_SESSION['ALERTA_TITULO'] = 'TUDO CERTO: SENHA ALTERADA';
                    $_SESSION['ALERTA_MENSAGEM'] = 'Sua senha foi alterada com sucesso.';

                    header("Location: mksenha");
                    exit;

                else:

                    // Exibe a mensagem informando que as senhas são diferentes
                    @session_start();
                    $_SESSION['ALERTA_TIPO'] = 'erro';
                    $_SESSION['ALERTA_TITULO'] = 'ERRO: SENHAS DIFERENTES';
                    $_SESSION['ALERTA_MENSAGEM'] = 'As senhas digitadas n&atilde;o correspondem. Por favor, verifique !';

                    header("Location: mksenha");
                    exit;

                endif;

            else:

                // Exibe a mensagem informando que a senha atual é inválida
                @session_start();
                $_SESSION['ALERTA_TIPO'] = 'erro';
                $_SESSION['ALERTA_TITULO'] = 'ERRO: SENHA ATUAL INV&Aacute;LIDA';
                $_SESSION['ALERTA_MENSAGEM'] = 'A senha informada est&aacute; incorreta. Tente novamente !';

                header("Location: mksenha");
                exit;

            endif;
        }

        $this->view->lista_mklogins2 = $query_lista;

        // Renderiza a view relacionada
        $this->view->renderJQ('mksenha/index');
    }
}
?>