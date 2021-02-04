<div class="telaAceite">
    <?php if ($this->empresa->foto == ''): ?>
        <div class="login_topo">
            <div class="box_logo">
                <span class="seta-01">&nbsp;</span>
                <span class="seta-02">&nbsp;</span>
                <span class="seta-03">&nbsp;</span>
                <span class="seta-04">&nbsp;</span>
                <span class="seta-05">&nbsp;</span>
                <span class="seta-06">&nbsp;</span>
                <span class="seta-07">&nbsp;</span>
                <span class="seta-08">&nbsp;</span>
            </div>
            <span>Central do Cliente</span>
        </div>
    <?php else: ?>
        <div class="login_topo" style="margin: 0px;">
            <img class="img_ico_topo" width="200" height="90" title="<?php echo $this->empresa->fantasia; ?>" src="data:image/jpeg;base64,<?php echo base64_encode($this->empresa->foto); ?>" />
        </div>
    <?php endif; ?>
    <h1>TERMO DE ACEITE</h1>
    <div class="boxAceite">
        <div class="container">
            <form id="formTermAccept" name="formTermAccept" action="aceitar" method="post">
                <input type="hidden" name="callback" value="Agree">
                <input type="hidden" name="callback_action" value="manager">

                <div name="termo_aceite" style="text-align: justify; border: 1px solid rgba(0,0,0,0.1); width: 100%; max-width: 1200px; height: 500px; margin: 0 auto; padding: 30px; font-size: 1.1em; overflow: hidden scroll; box-sizing: border-box;">
                    <?= $this->termo; ?>
                </div>
                <label style="margin: 20px auto; display: flex; align-content: center; justify-content: center; align-items: center;">
                    <input id="term_check" class="input" type="checkbox" name="term_check" style="margin: 0px 10px 0px 0px;"/>
                    <span>Eu li e concordo com os termos</span>
                </label>
                <div style="width: auto !important; margin: 20px 0px; display: flex; align-content: center; justify-content: center; align-items: center;">
                    <input type="submit" name="term_action" id="btnDisagree" class="btnTermAgree" value="Discordo" style="width: auto !important; margin: 5px; padding: 5px 15px;"/>
                    <input type="submit" name="term_action" id="btnAgree" class="btnTermAgree btnDisabled" value="Aceito" disabled style="width: auto !important; margin: 5px; padding: 5px 15px;"/>
                </div>
            </form>
        </div>
    </div>
</div>