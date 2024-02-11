<?php
require 'vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

$mail_remitente= $_POST["mail"];
$nombre = $_POST["nombre"];
$mensaje= $nombre." gracias por contactarte conmigo!!! Me escribiste lo siguiente: \"".$_POST["mensaje"]."\"";

$mail = new PHPMailer(true);
$mail->isSMTP();
$mail->SMTPDebug=0;
$mail->SMTPAuth = true;
$mail->SMTPSecure = "ssl";
$mail->Host="smtp.zoho.com";
$mail->Port = 465;
$mail->Username = "notificaciones@marcelojurado.com.ar";
$mail->Password = "c5LyebMM3ydR";
$mail->SetFrom('notificaciones@marcelojurado.com.ar', 'Marcelo Jurado');
$mail->AddBCC("notificaciones@marcelojurado.com.ar","Marcelo Jurado");
$mail->Subject = "Contacto desde landing page";
$mail->MsgHTML($mensaje);
$mail->AddAddress($mail_remitente, $nombre);
if(!$mail->Send()) {
echo "Error al enviar: " . $mail->ErrorInfo;
} else {
echo "Mensaje enviado!";
}
?>