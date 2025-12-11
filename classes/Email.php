<?php

namespace App;


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once __DIR__ . '/../includes/funciones.php';


class Email
{
    public $correo;
    public $token;
    public $nombre;
    public function __construct($correo, $token, $nombre)
    {
        $this->correo = $correo ?? '';
        $this->token = $token ?? '';
        $this->nombre = $nombre ?? '';
    }

    public function enviarCorreo()
    {
        $url=base_path();
        $mail = new PHPMailer(true);
        try {
            //Credenciales
            $host = 'medicable.com.mx';
            $usuario = 'club@medicable.com.mx';
            $password = 'club.medicable2025';
            $port = 465;

            //Server settings
            $mail->isSMTP();                                           //Send using SMTP
            $mail->Host       = $host;                                 //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                  //Enable SMTP authentication
            $mail->Username   = $usuario;                              //SMTP username
            $mail->Password   = $password;                             //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;           //Enable implicit TLS encryption
            $mail->Port       = $port;
            $mail->CharSet    = 'UTF-8';                               //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            //Enviar
            $mail->setFrom($usuario, 'club.medicable.com');
            $mail->addAddress($this->correo, $this->nombre);     //Add a recipient
            // $mail->addAddress('ellen@example.com');               //Name is optional
            // $mail->addReplyTo('info@example.com', 'Information');
            // $mail->addCC('cc@example.com');
            // $mail->addBCC('bcc@example.com');

            // //Attachments
            // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
            // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

            //Content
            $mail->isHTML(true);

            // Cargar la plantilla HTML
            $contenido = '<html>';                                  //creamos el contenido html
            $contenido .= "<p><strong>Hola " . $this->nombre . "</strong> Solicitaste la recuperación de tu cuenta, por favor da click en el siguiente enlace";
            $contenido .= "<p><a href='".$url."auth/restablecer-password.php?token=" . $this->token . "'>Confirmar</a>";
            $contenido .= '</html>';
            //fin creamos el contenido html
            $mail->Subject = 'Recupera tu cuenta';
            $mail->Body    = $contenido;
            // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            $mail->send();
        } catch (Exception $e) {
            echo "Error al enviar el correo: {$mail->ErrorInfo}";
        }
    }
}
