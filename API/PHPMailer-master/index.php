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
$mail->Body = '<style> .button {
  background-color: #4CAF50; /* Green */
  border: none;
  color: white;
  padding: 16px 32px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 4px 2px;
  transition-duration: 0.4s;
  cursor: pointer;
}

.button1 {
    background-color: white; 
    color: black; 
    border: 2px solid #f44336;
}

.button1:hover {
    background-color: #f44336;
    color: white;
}



</style>Clique no link a seguir para validar seu login<br><button class="button button1">Green</button>'.$_POST['link'];

if (!$mail->Send()) {
    echo "Erro ao enviar Email:" . $mail->ErrorInfo;
} else {
    echo "Tudo certo";
}
