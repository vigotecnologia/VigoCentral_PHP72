<?php

class Email
{
    private $Mail;
    private $Data;
    private $Assunto;
    private $Mensagem;
    private $RemetenteNome;
    private $RemetenteEmail;
    private $DestinoNome;
    private $DestinoEmail;
    private $Error;
    private $Result;

    function __construct() {

        $this->Mail = new PHPMailer();
        $this->Mail->CharSet = "UTF-8";

        // Limite diário de 300 envios
        $this->Mail->Host = "webmail.vigo.com.br";
        $this->Mail->Port = 587;
        $this->Mail->Username = "sites@vigo.com.br";
        $this->Mail->Password = "xxxxxxxxxxxxxxxxx";
    }

    public function Enviar(array $Data) {
        $this->Data = $Data;
        $this->Clear();

        if (in_array('', $this->Data)) {
            $this->Error = "Erro ao enviar e-mail, você deve preencher todos os campos.";
            $this->Result = false;
        }
        else {
            $this->setMail();
            $this->setConfig();
            $this->sendMail();
        }
    }

    public function getError() {
        return $this->Error;
    }

    public function getResult() {
        return $this->Result;
    }

    private function Clear() {
        array_map('strip_tags', $this->Data);
        array_map('trim', $this->Data);
    }

    private function setMail() {
        $this->Assunto = $this->Data['Assunto'];
        $this->Mensagem = $this->Data['Mensagem'];
        $this->RemetenteNome = $this->Data['RemetenteNome'];
        $this->RemetenteEmail = $this->Data['RemetenteEmail'];
        $this->DestinoNome = $this->Data['DestinoNome'];
        $this->DestinoEmail = $this->Data['DestinoEmail'];

        $this->Data = null;
        $this->setMsg();
    }

    private function setConfig() {
        $this->Mail->isSMTP();
        $this->Mail->SMTPAuth = true;
        $this->Mail->isHTML(true);
        $this->Mail->From = $this->Mail->Username;
        $this->Mail->FromName = $this->RemetenteNome;
        $this->Mail->addReplyTo($this->RemetenteEmail, $this->RemetenteNome);
        $this->Mail->Subject = $this->Assunto;
        $this->Mail->Body = $this->Mensagem;
        $this->Mail->addAddress($this->DestinoEmail, $this->DestinoNome);
    }

    private function setMsg() {
        $this->Mensagem = "{$this->Mensagem}<br><small>".date('d/m/Y H:i')."</small>";
    }

    private function sendMail() {
        if ($this->Mail->send()) {
            $this->Error = "E-mail enviado com sucesso !";
            $this->Result = true;
        }
        else {
            $this->Error = "Erro ao enviar e-mail. Info: {$this->Mail->ErrorInfo}";
            $this->Result = false;
        }
    }
}
