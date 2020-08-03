<?php
require_once 'libs/Functions.php';
$funcoes = new Functions(); // Instancia a classe de FUNÇÕES BÁSICAS
$funcoes->verificaSessao();
?><section class="home">
    <div class="container">
        <h1>Ol&aacute; <strong><?php $nome = explode(' ', utf8_decode(utf8_encode($this->nome))); echo $nome[0]; ?></strong>, TUDO BEM ?</h1>
        <p><?php if (utf8_encode($this->sexo) == 'M') { echo 'Bem vindo';} else { echo 'Bem vinda';} ?> ao seu ambiente virtual !<br />Aqui voc&ecirc; pode acompanhar e gerenciar suas faturas, notas fiscais, servi&ccedil;os contratados, entre outros !</p>
        <ul class="icons">
            <li><a href="dados" title="Meus Dados"><span class="flaticon-dados"></span><div>Dados</div></a></li>
            <?php if ($_SESSION['CENTRAL_MOD_FATURAS'] == 'S'): ?>
                <li><a href="faturas" title="Minhas Faturas"><span class="flaticon-faturas"></span><div>Faturas</div></a></li>
            <?php endif; ?>
            <?php if ($_SESSION['CENTRAL_MOD_NFS'] == 'S'): ?>
                <li><a href="notasfiscais" title="Notas Fiscais"><span class="flaticon-nfiscal"></span><div>Notas Fiscais</div></a></li>
            <?php endif; ?>
            <?php if ($_SESSION['CENTRAL_MOD_SERVICOS'] == 'S'): ?>
                <li><a href="servicos" title="Meus Servi&ccedil;os"><span class="flaticon-servicos"></span><div>Servi&ccedil;os</div></a></li>
            <?php endif; ?>
            <?php if ($_SESSION['CENTRAL_MOD_ACESSOS'] == 'S'): ?>
                <li><a href="acessos" title="Meus Acessos"><span class="flaticon-acessos"></span><div>Acessos</div></a></li>
            <?php endif; ?>
            <?php if ($_SESSION['CENTRAL_MOD_GRAFICOS'] == 'S'): ?>
                <li><a href="graficos" title="Gr&aacute;ficos de Consumo"><span class="flaticon-graficos"></span><div>Gr&aacute;ficos</div></a></li>
            <?php endif; ?>
            <?php if ($_SESSION['CENTRAL_MOD_CONTRATOS'] == 'S'): ?>
                <li><a href="contratos" title="Meus Contratos"><span class="flaticon-contrato"></span><div>Contratos</div></a></li>
            <?php endif; ?>
            <?php if ($_SESSION['CENTRAL_MOD_ATENDIMENTOS'] == 'S'): ?>
                <li><a href="suporte" title="Meus Atendimentos"><span class="flaticon-suporte"></span><div>Atendimentos</div></a></li>
            <?php endif; ?>
            <li><a href="debitos" title="Débitos em Conta"><span class="flaticon-faturas"></span><div>Débitos Conta</div></a></li>
            <li><a id="botao_confianca" href="#" title="Liberação por confiança"><span class="flaticon-senha"></span><div>Liberação</div></a></li>
        </ul>
        <div class="clear"></div>
    </div><div class="clear"></div>
</section>
<div id="confianca1" class="messageBox" style="display: none;"><span class="close" onclick="javascript:document.getElementById('messageBox').className='fecharMessage';">&nbsp;</span><div class="sucesso"><p><strong>ACESSO LIBERADO</strong></p><p>O acesso foi liberado por confiança, desligue o roteador e aguarde alguns minutos para ligá-lo novamente.</p></div></div>
<div id="confianca2" class="messageBox" style="display: none;"><span class="close" onclick="javascript:document.getElementById('messageBox').className='fecharMessage';">&nbsp;</span><div class="erro"><p><strong>ERRO</strong></p><p>O acesso não está bloqueado para ser liberado.</p></div></div>
<div id="confianca3" class="messageBox" style="display: none;"><span class="close" onclick="javascript:document.getElementById('messageBox').className='fecharMessage';">&nbsp;</span><div class="erro"><p><strong>ERRO</strong></p><p>O acesso foi liberado por confiança recentemente, só é permitido uma liberação por confiança a cada 30 dias.</p></div></div>
<div id="confianca4" class="messageBox" style="display: none;"><span class="close" onclick="javascript:document.getElementById('messageBox').className='fecharMessage';">&nbsp;</span><div class="erro"><p><strong>ERRO</strong></p><p>Ocorreu um erro ao tentar liberar cadastro.</p></div></div>
<script>
    $("#botao_confianca").click(function () {
        var posting = $.post("libera");
        posting.done(function (data) {
            if (data.trim() === "OK") {
                document.getElementById('confianca1').style.display = 'block';
                setTimeout(function () { document.getElementById('confianca1').style.display = 'none'; }, 5000);
            } else if (data.trim() === "NOK") {
                document.getElementById('confianca2').style.display = 'block';
                setTimeout(function () { document.getElementById('confianca2').style.display = 'none'; }, 5000);
            } else if (data.trim() === "ERRO2") {
                document.getElementById('confianca3').style.display = 'block';
                setTimeout(function () { document.getElementById('confianca3').style.display = 'none'; }, 5000);
            } else if (data.trim() === "ERRO") {
                document.getElementById('confianca4').style.display = 'block';
                setTimeout(function () { document.getElementById('confianca4').style.display = 'none'; }, 5000);
            }
        });
    });
</script>
