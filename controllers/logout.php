<?php

class Logout extends Controller {

    function __construct() {

        parent::__construct();
        $this->view->render('logout/index');
    }
}
?>
