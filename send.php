<?php

//librerias
  require 'PHPMailer/PHPMailerAutoload.php';

//Create a new PHPMailer instance
$mail = new PHPMailer();
$mail->IsSMTP();

//Configuracion servidor mail
$mail->From = "dg414181@gmail.com"; //remitente
$mail->SMTPAuth = true;
$mail->SMTPSecure = 'tls'; //seguridad
$mail->Host = "smtp.gmail.com"; // servidor smtp
$mail->Port = 587; //puerto
$mail->Username ='dg414181@gmail.com'; //nombre usuario
$the_subject = "Phpmailer prueba by Sharkshop.com";
$mail->Password = 'nvxldjohxdawdvxw'; //contraseña
$the_subject = "Phpmailer prueba by Sharkshop.com";

//Agregar destinatario
$mail->AddAddress($_POST['email']);
$mail->Subject = $_POST['subject'];
$mail->Body = $_POST['message'];

//Avisar si fue enviado o no y dirigir al index
if ($mail->Send()) {
    echo'<script type="text/javascript">
           alert("Enviado Correctamente");
        </script>';
    header("Refresh:1; ./index.php");

} else {
    echo'<script type="text/javascript">
           alert("NO ENVIADO, intentar de nuevo");
        </script>';
}
