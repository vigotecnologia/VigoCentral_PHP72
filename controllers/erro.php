<?php

class Erro extends Controller {

    function __construct() {

        parent::__construct();
        $this->view->render('erro/index');
    }
}
?>
