<?php
require 'vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
include "./correo.php";

/* Carga de variables de entorno */
$dotenv = Dotenv\Dotenv::createImmutable('../');
$dotenv->load();

/* Variables */
$mail_remitente= $_POST["mail"];
$nombre = $_POST["nombre"];
$comentario = $_POST['mensaje'];
$mensaje= email_personalizado($nombre);
$mensajeDatos = "Nombre: ".$nombre."<br>\nCorreo: ".$mail_remitente."<br>\nMensaje: ".$comentario;


$mail = new PHPMailer(true);
$mail->CharSet = 'UTF-8';
$mail->isSMTP();
$mail->SMTPDebug=0;
$mail->SMTPAuth = true;
$mail->SMTPSecure = $_ENV["MAIL_PROTOCOL"];
$mail->Host=$_ENV["MAIL_HOST"];
$mail->Port = $_ENV["MAIL_PORT"];
$mail->Username = $_ENV["MAIL_USERNAME"];
$mail->Password = $_ENV["MAIL_PASSWORD"];
$mail->SetFrom($_ENV["MAIL_USERNAME"], 'Marcelo Jurado');
$mail->Subject = "Gracias por ponerte en contaco";
$mail->MsgHTML($mensaje);
$mail->AddAddress($mail_remitente, $nombre);

$mail2 = new PHPMailer(true);
$mail2->CharSet = 'UTF-8';
$mail2->isSMTP();
$mail2->SMTPDebug=0;
$mail2->SMTPAuth = true;
$mail2->SMTPSecure = $_ENV["MAIL_PROTOCOL"];
$mail2->Host=$_ENV["MAIL_HOST"];
$mail2->Port = $_ENV["MAIL_PORT"];
$mail2->Username = $_ENV["MAIL_USERNAME"];
$mail2->Password = $_ENV["MAIL_PASSWORD"];
$mail2->SetFrom($_ENV["MAIL_USERNAME"], 'Marcelo Jurado');
$mail2->Subject = "Contacto desde landing page";
$mail2->MsgHTML($mensajeDatos);
$mail2->AddAddress($_ENV["MAIL_USERNAME"], "landing page");

if(!$mail->Send() or !$mail2->Send()) {
echo "Error al enviar: " . $mail->ErrorInfo;
die();
} else {
echo '<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Mensaje enviado</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
      crossorigin="anonymous"
    />
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
    />
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=PT+Sans:ital,wght@0,400;0,700;1,400;1,700&display=swap"
      rel="stylesheet"
    />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Source+Code+Pro:ital,wght@0,200..900;1,200..900&display=swap"
      rel="stylesheet"
    />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap"
      rel="stylesheet"
    />
  </head>
  <body>
    <div class="container d-flex align-items-center justify-content-center" style="height: 100vh;">
        <div class="card d-flex flex-column align-items-center justify-content-between" style="width: 18rem;">
            <!-- <img src="..." class="card-img-top" alt="..."> -->
            <i class="bi bi-envelope-check" style="font-size: 10rem; color: rgb(80, 212, 80);"></i>
            <div class="card-body">
              <h5 class="card-title">Mensaje enviado</h5>
              <p class="card-text">Tu mensaje fue enviado, me estaré poniendo en contacto contigo pronto!</p>
              <a href="index.html" class="btn btn-success">Volver atras</a>
            </div>
          </div>
    </div>
  </body>
</html>';
}
?>