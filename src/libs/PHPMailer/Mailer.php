<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Requiere los archivos de PHPMailer
require_once __DIR__ . '/src/Exception.php';
require_once __DIR__ . '/src/PHPMailer.php';
require_once __DIR__ . '/src/SMTP.php';
require_once __DIR__ . '/../../models/ComprobantePDF.php'; 

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
            $url = "http://149.50.133.15:8062/controllers/ActivarCuentaController.php?token=" . urlencode($token);


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
    
            $url = "http://149.50.133.15:8062/views/RestablecerContra.php?token=" . urlencode($token);
    
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

    public static function enviarComprobantePago($correo, $nombre, $apellido, $mes, $monto, $medio_pago, $fecha_pago, $id_pago) {
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
    
            $mail->isHTML(true);
            $mail->Subject = 'Comprobante de pago - ' . $mes;
            $mail->Body = "
                <h2>Comprobante de pago</h2>
                <p><strong>Nombre:</strong> $nombre $apellido</p>
                <p><strong>Mes abonado:</strong> $mes</p>
                <p><strong>Monto:</strong> AR$ $monto</p>
                <p><strong>Medio de pago:</strong> $medio_pago</p>
                <p><strong>Fecha:</strong> " . date('d/m/Y H:i', strtotime($fecha_pago)) . "</p>
                <p>Este comprobante también está adjunto en formato PDF.</p>
            ";
    
            // Crear el PDF
            $rutaPDF = ComprobantePDF::generar([
                'id_pago'     => $id_pago,
                'nombre'      => $nombre,
                'apellido'    => $apellido,
                'mes'         => $mes,
                'monto'       => $monto,
                'medio_pago'  => $medio_pago,
                'fecha_pago'  => $fecha_pago
            ]);
    
            $mail->addAttachment($rutaPDF, 'comprobante_pago.pdf');
    
            $mail->send();
    
        } catch (Exception $e) {
            error_log("Error al enviar comprobante: {$mail->ErrorInfo}");
        }
    }
    
}
