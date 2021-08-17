<?php
require_once './PHPMailer/PHPMailer.php';
require_once './PHPMailer/SMTP.php';
require_once './PHPMailer/Exception.php';


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class controllerEmail
{

    private $mail;

    public function __construct()
    {
        $this->mail = new PHPMailer();
        $this->mail->isSMTP();
        $this->mail->Host = 'smtp.gmail.com';
        $this->mail->Port = 587;
        $this->mail->SMTPAuth = true;
        $this->mail->Username = 'suporteWedosvc@gmail.com';
        $this->mail->Password = 'bielferreira58';
        $this->mail->setFrom('suporteWedosvc@gmail.com', 'Wedo Serviços');
        $this->mail->isHTML(true);
        $this->mail->CharSet = "UTF-8";

    }

    public function enviarEmail($para, $assunto, $conteudo)
    {

        try {
            $this->mail->addAddress($para);
            $this->mail->Subject = $assunto;
            $this->mail->addEmbeddedImage('../imagens/logo.png', 'logo_ref');
            $this->mail->Body = $conteudo;

            if ($this->mail->send()) {
                return false;
            } else {
                return false;
            }
        } catch (Exception $e) {
            echo 'Exceção capturada: ', $e->getMessage(), "\n";
        }


    }


    public function suporte()
    {


        $nome = $_POST["nomeCompleto"];
        $email = $_POST["email"];
        $telefone = $_POST["telefone"];
        $mensagem = $_POST["mensagem"];
        $para = 'suporteWedosvc@gmail.com';
        $assunto = 'SUPORTE WEDO';

        require_once '../View/Layouts/suporteEmail.php';

         return $this->enviarEmail($para, $assunto, $conteudo);
    }
}