<?php
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
$mail->Mailer = 'smtp';
$mail->SMTPSecure = 'ssl';

//configuração do usuário do gmail
$mail->SMTPAuth = true;
$mail->Username = 'noreplymugs@gmail.com'; // usuario gmail.
$mail->Password = 'mugsbrabo'; // senha do email.

$mail->SingleTo = true;

// configuração do email a ver enviado.
$mail->From = "stevemberg100@gmail.com";
$mail->FromName = "Nome do remetente.";

$mail->addAddress("stevemberg100@gmail.com"); // email do destinatario.

$mail->Subject = "Aqui vai o assunto do email, pode vim atraves de variavel.";
$mail->Body = "Aqui vai a mensagem, que tambem pode vim por variavel.";

// if (!$mail->Send()) {
//     echo "Erro ao enviar Email:" . $mail->ErrorInfo;
// }else{
//     echo "Tudo certo"
// }
