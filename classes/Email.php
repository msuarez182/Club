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
        $url = base_path();
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
            $mail->setFrom($usuario, 'club.medicable.com.mx');
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
            $contenido .= "<p><strong>Hola " . $this->nombre . "</strong>  solicitaste la recuperación de tu cuenta; para continuar, por favor, da clic en el siguiente enlace: ";
            $contenido .= "<p><a href='" . $url . "auth/restablecer-password.php?token=" . $this->token . "'>Confirmar</a>";
            $contenido .= "<p>Si no solicitaste la recuperación de tu cuenta, puedes omitir este correo. A fin de proteger tu cuenta, no reenvíes este mensaje de correo electrónico. <p>";
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

    public function enviarConfirmacion($correo,  $nombre,  $titulo, $fecha, $link_plataforma)
    {
        $this->correo = $correo;
        $this->nombre = $nombre;


        $url = base_path();
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
            $mail->setFrom($usuario, 'club.medicable.com.mx');
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
            $contenido .= "<p><strong>Hola estimado " . $this->nombre . "</strong>. Le confirmamos que su participación en la siguiente sesión ha sido registrada exitosamente:</p>";
            $contenido .="<p> Evento: {$titulo} </p>";
            $contenido .="<p>Fecha: {$fecha}</p>";
            $contenido .="<p> Agradecemos su interés y esperamos contar con su presencia.<br>
            Saludos cordiales.</p> ";
            $contenido .= "<p><a href='".$link_plataforma."'>Acceder al evento</a>";
            $contenido .= "<p>Por favor, no responda a este mensaje. Este mensaje se genera automáticamente </p>";
            $contenido .= '</html>';
            //fin creamos el contenido html
            $mail->Subject = 'Club Medicable - Confirmación Sesión Virtual: ' . $titulo;
            $mail->Body    = $contenido;
            // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            $mail->send();
        } catch (Exception $e) {
            echo "Error al enviar el correo: {$mail->ErrorInfo}";
        }
    }
}
