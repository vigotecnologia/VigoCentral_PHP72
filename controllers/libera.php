<?php

class Libera extends Controller {

    function __construct() {

        parent::__construct();

        session_start();

        $cliente_vigoweb   = "https://provedor.vigo.com.br";
        $login_funcionario = "teste";
        $senha_funcionario = "abc123";

        //----------------------------------------------------------------------------------------------
        // Aqui é feito o processo de autenticação para aquisição do TOKEN DINÂMICO (15 dias)
        //----------------------------------------------------------------------------------------------

        $curl = curl_init();

        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_URL, $cliente_vigoweb . '/api/auth');
        curl_setopt($curl, CURLOPT_POSTFIELDS, '{ "login": "' . $login_funcionario . '", "senha": "' . $senha_funcionario . '" }');
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_HTTPHEADER, ["Content-Type: application/json", "X-Content-Type-Options:nosniff", "Accept:application/json", "Cache-Control:no-cache"]);

        $result = curl_exec($curl);
        curl_close($curl);

        if(!$result){die("ERRO");}

        if (strpos($result, '[ERRO]') !== false) {
            echo "ERRO";
            die;
        }

        $obj = json_decode($result);
        $token =  $obj->{'senha'};

        //----------------------------------------------------------------------------------------------
        // Efetua a liberação com base no CPF/CNPJ
        //----------------------------------------------------------------------------------------------

        $curl = curl_init();

        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_URL, $cliente_vigoweb . '/api/app_libera');
        curl_setopt($curl, CURLOPT_POSTFIELDS, '{ "cpf_cnpj": "' . str_replace(['/', '-', '.'], '', $_SESSION['CPFCNPJ']) . '" }');
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_HTTPHEADER, ['Content-Type: application/json', "Authorization: Bearer " . $token]);

        $result = curl_exec($curl);
        curl_close($curl);

        if(!$result){die("ERRO");}

        echo $result;
        die;
    }
}
?>
