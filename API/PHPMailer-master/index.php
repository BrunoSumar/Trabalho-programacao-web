<?php

print_r($_POST);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once(__DIR__.'/src/PHPMailer.php'); //chama a classe de onde você a colocou.
require_once(__DIR__.'/src/Exception.php'); //chama a classe de onde você a colocou.
require_once(__DIR__.'/src/SMTP.php'); //chama a classe de onde você a colocou.
$mail = new PHPMailer(); // instancia a classe PHPMailer

$mail->IsSMTP();

//configuração do gmail
$mail->Port = '465'; //porta usada pelo gmail.
$mail->Host = 'smtp.gmail.com';
$mail->IsHTML(true);
$mail ->charSet = "utf-8";
$mail->Mailer = 'smtp';
$mail->SMTPSecure = 'ssl';

//configuração do usuário do gmail
$mail->SMTPAuth = true;
$mail->Username = 'noreplymugs@gmail.com'; // usuario gmail.
$mail->Password = 'mugsbrabo'; // senha do email.

$mail->SingleTo = true;

// configuração do email a ver enviado.
$mail->From = $_POST['email'];
$mail->FromName = "Login MUGS";

$mail->addAddress($_POST['email']); // email do destinatario.

$mail->Subject = "Confirme seu Login!";
$mail->Body = 'Clique no link a seguir para validar seu login<br>'.$_POST['link'];

if (!$mail->Send()) {
    echo "Erro ao enviar Email:" . $mail->ErrorInfo;
} else {
    echo "Tudo certo";
}
