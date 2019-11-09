<?php
include 'class.phpmailer.php';
include 'class.smtp.php';

function enviarmail ($address, $subject, $mensaje)
{
    $mail = new PHPMailer();

    $mail->mailer="smtp";
    $mail->Helo="www.Outlook.com";
    $mail->SMTPDebug = 2;
    $mail->SMTPAuth = true;
    $mail->SMPTSecure = "tls";
    $mail->Host = "smtp-mail.outlook.com";
    $mail->Port = 587;
    $mail->Username= "miguel.santamaria3@Outlook.com";
    $mail->Passwordd= "Angel5395";
    $mail->SetFrom("miguel.santamaria3@Outlook.com","Mike");
    $mail->AddReplyTo("miguel.santamaria3@Outlook.com","Mike");
    $mail->subject = $subject;
    $mail->MsgHTML("$mensaje");
    $mail->AddAddress($address, $address);
    if (! $mail->send()){
        echo "Error al enviar: " . $mail->ErrorInfo;
    } else {
        echo "mensaje enviado!";
    }
}


?>