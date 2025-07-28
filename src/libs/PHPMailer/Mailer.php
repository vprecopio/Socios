<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Requiere los archivos de PHPMailer
require_once __DIR__ . '/src/Exception.php';
require_once __DIR__ . '/src/PHPMailer.php';
require_once __DIR__ . '/src/SMTP.php';

class Mailer {
    public static function enviarCorreoActivacion($correo, $nombre, $apellido, $token) {
        $mail = new PHPMailer(true);
        $mail->CharSet = 'UTF-8';

        try {
            // Configuración del servidor SMTP de Gmail
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'emanuelprecopio@gmail.com';       // <-- CAMBIÁ ESTO
            $mail->Password   = 'qpnq viux yycy ypvz ';             // <-- CAMBIÁ ESTO
            $mail->SMTPSecure = 'tls';
            $mail->Port       = 587;

            // Remitente y destinatario
            $mail->setFrom('tu_correo@gmail.com', 'Gestión de Socios');
            $mail->addAddress($correo, "$nombre $apellido");

            // Construcción del enlace de activación
            // Construcción del enlace de activación (CORREGIDO)
            $url = "http://localhost:8062/controllers/ActivarCuentaController.php?token=" . urlencode($token);


            // Contenido del correo
            $mail->isHTML(true);
            $mail->Subject = 'Activá tu cuenta de socio';
            $mail->Body = "
                <h2>¡Bienvenido $nombre $apellido!</h2>
                <p>Ya sos parte de nuestro sistema de socios.</p>
                <p><strong>Tu carnet ya fue generado</strong>.</p>
                <p>Para activar tu cuenta, hacé clic en el siguiente enlace:</p>
                <p><a href='$url'>$url</a></p>
                <p>Este enlace te llevará a una pantalla para establecer tu contraseña.</p>
            ";

            $mail->send();
        } catch (Exception $e) {
            error_log("Error al enviar correo: {$mail->ErrorInfo}");
        }
    }

    public static function enviarCorreoRecuperacion($correo, $nombre, $apellido, $token) {
        $mail = new PHPMailer(true);
        $mail->CharSet = 'UTF-8';
        
        try {
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'emanuelprecopio@gmail.com';
            $mail->Password   = 'qpnq viux yycy ypvz';
            $mail->SMTPSecure = 'tls';
            $mail->Port       = 587;
    
            $mail->setFrom('tu_correo@gmail.com', 'Gestión de Socios');
            $mail->addAddress($correo, "$nombre $apellido");
    
            $url = "http://localhost:8062/views/RestablecerContra.php?token=" . urlencode($token);
    
            $mail->isHTML(true);
            $mail->Subject = 'Restablecer contraseña';
            $mail->Body = "
                <h2>Hola $nombre $apellido</h2>
                <p>Recibimos una solicitud para restablecer tu contraseña.</p>
                <p><a href='$url'>Hacé clic acá para restablecerla</a></p>
            ";
    
            $mail->send();
        } catch (Exception $e) {
            error_log("Error al enviar correo de recuperación: {$mail->ErrorInfo}");
        }
    }
    

}
