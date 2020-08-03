<?php
require_once 'libs/Functions.php';
$funcoes = new Functions(); // Instancia a classe de FUNÇÕES BÁSICAS
$funcoes->verificaSessao();
?>
<section class="dados">
    <div class="container">
        <h1>Meus Débitos em Conta</h1>
        <ul class="caminho">
            <span>Voc&ecirc; est&aacute; em: </span>
            <li class="target">
                <a href="core">HOME</a>
            </li>
            <li class="target">
                <a href="financeiro">FINANCEIRO</a>
            </li>
            <li class="target">DÉBITOS EM CONTA</li>
        </ul>
        <p>O quadro abaixo segue um padr&atilde;o l&oacute;gico de demonstra&ccedil;&atilde;o dos &uacute;ltimos débitos efetuados em sua conta e permite um controle de f&aacute;cil visualiza&ccedil;&atilde;o das cobran&ccedil;as por data.</p>
        <p>Possui uma legenda colorida para ajudar a compreender a sua situa&ccedil;&atilde;o atual. Uma forma inteligente de administrar a sua conta.</p>
        <div class="lColorDark legenda flaticon-legenda">&nbsp;Débitos pagos</div>
        <div class="separador">&nbsp;</div>
        <div class="lColorRed legenda flaticon-legenda">&nbsp;Débitos em aberto</div>
        <h3>Débitos em Conta</h3>
        <?php if (empty($this->lista_debitos)) { ?>
        <div class="tHeader">
            <span class="align-c vazio">&nbsp;Nenhum débito em conta emitido para este cliente !</span>
        </div>
        <?php } else { ?>
        <ul class="tabela">
            <div class="tHeader">
                <li class="tRow">
                    <span class="align-l">Agência</span>
                    <span class="align-l">Conta</span>
                    <span class="align-c">Emissão</span>
                    <span class="align-c">Vencimento</span>
                    <span class="align-r">Valor</span>
                    <span class="align-c">Pago</span>
                    <span class="align-l">Motivo</span>
                </li>
            </div>
            <div class="tBody">
                <?php
                  $total_debitos = 0;
                  $valor_total = 0;
                  $total_pago = 0;

                  foreach ($this->lista_debitos as $debitos) {

                      $total_debitos ++;
                      $valor_total += $debitos['valor'];
                      $total_pago += $debitos['valor_pago'];

                      $data_pgto = $funcoes->dataToBR($boletos['dt_vencimento']);
                      if ($data_pgto == '01/01/0001')
                          $data_pgto = '';

                      $valor_pago = number_format($debitos['valor_pago'], 2, ',', '.');

                      if ($valor_pago <= 0)
                          $valor_pago = '';

                      if ($debitos['valor_pago'] <= 0) {
                          $txtBoletos = 'tRow tBoletoAberto';
                          $legBoletos = 'lColorRed';
                          $btnBoletos = '&nbsp;';
                      } else {
                          $txtBoletos = 'tRow';
                          $legBoletos = 'lColorDark';
                          $btnBoletos = '&nbsp;';
                      }
                ?>
                <li class="<?php echo $txtBoletos; ?>">
                    <span data-th="Agência" class="align-l">
                        <div class="<?php echo $legBoletos; ?> legenda flaticon-legenda">
                            &nbsp;<?php echo utf8_encode($debitos['agencia']); ?>
                        </div>
                    </span>
                    <span data-th="Conta" class="align-l maiusculo">
                        <?php echo utf8_decode(utf8_encode($debitos['conta'])); ?>
                    </span>
                    <span data-th="Emissão" class="align-c">
                        <?php echo $funcoes->dataToBR($debitos['dt_emissao']); ?>
                    </span>
                    <span data-th="Vencimento" class="align-c">
                        <?php echo $funcoes->dataToBR($debitos['dt_vencimento']); ?>
                    </span>
                    <span data-th="Valor" class="align-r">
                        <?php echo number_format($debitos['valor'], 2, ',', '.'); ?>
                    </span>
                    <span data-th="Pago" class="align-r">
                        <?php echo number_format($debitos['valor_pago'], 2, ',', '.'); ?>
                    </span>
                    <span data-th="Motivo" class="align-l">
                        <?php echo $debitos['motivo'] . " - " . $debitos['motivo_descricao']; ?>
                    </span>
                </li>
                <?php } ?>
            </div>
            <div class="tHeader">
                <li class="tRow">
                    <span class="align-l">
                        Débitos:
                        <strong>
                            <?php echo $total_debitos; ?>
                        </strong>
                    </span>
                    <span class="align-l">&nbsp;</span>
                    <span class="align-l">&nbsp;</span>
                    <span class="align-l">&nbsp;</span>
                    <span class="align-r">
                        &nbsp;<?php echo number_format($valor_total, 2, ',', '.'); ?>
                    </span>
                    <span class="align-r">
                        &nbsp;<?php echo number_format($total_pago, 2, ',', '.'); ?>
                    </span>
                    <span class="align-l">&nbsp;</span>
                </li>
            </div>
        </ul>
        <?php } ?>
        <div class="clear"></div>
    </div>
    <div class="clear"></div>
</section>