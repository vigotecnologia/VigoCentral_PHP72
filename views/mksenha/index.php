<?php
require_once 'libs/Functions.php';

$funcoes = new Functions(); // Instancia a classe de FUNÇÕES BÁSICAS
$funcoes->verificaSessao();

if (isset($_SESSION['ALERTA_MENSAGEM']) AND ( $_SESSION['ALERTA_MENSAGEM'] != NULL)) {
    echo "<div class='messageBox' id='messageBox'><span class='close' onclick=\"javascript:document.getElementById('messageBox').className='fecharMessage';\">&nbsp;</span><div class='" . $_SESSION['ALERTA_TIPO'] . "'><p><strong>" . $_SESSION['ALERTA_TITULO'] . "...</strong><br />" . $_SESSION['ALERTA_MENSAGEM'] . "</p></div></div>";
}

$_SESSION['ALERTA_TIPO'] = NULL;
$_SESSION['ALERTA_TITULO'] = NULL;
$_SESSION['ALERTA_MENSAGEM'] = NULL;

unset($_SESSION['ALERTA_TIPO']);
unset($_SESSION['ALERTA_TITULO']);
unset($_SESSION['ALERTA_MENSAGEM']);
?><div style="display:none;" class="messageBox" id="messageBox"></div>
<section class="dados">
    <div class="container">
        <h1>Senha de Conex&atilde;o</h1>
        <ul class="caminho">
            <span>Voc&ecirc; est&aacute; em: </span>
            <li class="target"><a href="core">HOME</a></li>
            <li class="target"><a href="conectividade">CONECTIVIDADE</a></li>
            <li class="target">SENHA DE CONEX&Atilde;O</li>
        </ul>
        <h3>Altera&ccedil;&atilde;o da Senha de Conex&atilde;o</h3>
<?php 
if (!empty($this->lista_mklogins2)) { ?>
            <div class="formSenha">
                <form name="formSenha" action="mksenha" method="post">
                    <label for="txtLogin">
                        <span>Login de Acesso:</span>
                        <select name="txtLogin" id="login" onchange="AlteraClasse();">
                            <option value="Selecione">Selecione um login</option>
                            <?php foreach ($this->lista_mklogins2 as $mklogins2) {
                                echo '<option value="'. $mklogins2['Username'] . '">' . $mklogins2['Username'] . '</option>';
                            } ?>
                        </select>
                    </label>
                    <label id="lblSenhaAtual" for="txtSenhaAtual" class="optSenha disabled">
                        <span>Senha Atual:</span>
                        <input type="password" required="required" disabled name="txtSenhaAtual" id="txtSenhaAtual" class="txtSenhaAtual" maxlength="15" autofocus />
                    </label>
                    <label id="lblSenhaNova" for="txtNovaSenha" class="disabled">
                        <span>Nova Senha:</span>
                        <input type="password" required="required" disabled name="txtSenhaNova" id="txtNovaSenha" class="txtNovaSenha" maxlength="15" />
                    </label>
                    <label id="lblSenhaConfirma" for="txtSenhaConfirma" class="optSenha disabled">
                        <span>Confirme a Senha:</span>
                        <input type="password" required="required" disabled name="txtSenhaConfirma" id="txtSenhaConfirma" class="txtSenhaConfirma" maxlength="15" />
                    </label>
                    <input class="botao btnExtra" type="submit" value="Alterar Senha" />
                </form>
            </div>
<?php } else { ?>
            <div class="tHeader vazio">
                <span class="align-c">&nbsp;Nenhum login de conectividade para este cliente !</span>
            </div>
<?php } ?>
        <p><strong>Aviso Legal</strong><br />Todos os dados s&atilde;o confidenciais, n&atilde;o os informem a ningu&eacute;m. Nenhum funcion&aacute;rio do Provedor est&aacute; autorizado a solicit&aacute;-la.</p>
        <div class="clear"></div>
    </div><div class="clear"></div>
</section>