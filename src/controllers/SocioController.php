<?php
include_once "../models/Socio.php";
include_once "../libs/PHPMailer/Mailer.php";

class SocioController {
    public function crearSocio() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $socio = new Socio();
            $socio->nombre = ucfirst(strtolower($_POST['nombre']));
            $socio->apellido = ucfirst(strtolower($_POST['apellido']));
            $socio->dni = $_POST['dni'];            
            $socio->genero = $_POST['genero'];
            $socio->correo_electronico = $_POST['correo_electronico'];
            $socio->fecha_nacimiento = $_POST['fecha_nacimiento'];

            if (!preg_match('/^\d{8}$/', $socio->dni)) {
                echo "<script>alert('DNI inválido. Debe tener 8 dígitos.'); window.history.back();</script>";
                exit;
            }       

            $db = new Database();
            $conn = $db->connect();

            $stmt = $conn->prepare("SELECT COUNT(*) FROM socios WHERE correo_electronico = :correo");
            $stmt->bindParam(':correo', $socio->correo_electronico);
            $stmt->execute();
            $existe = $stmt->fetchColumn();

            if ($existe > 0) {
                echo "<script>alert('Correo ya registrado.'); window.history.back();</script>";
                exit;
            }

            $lastId = $socio->crear(); 
            if ($lastId) {
                $db = new Database();
                $conn = $db->connect();

                function calcularEdad($fechaNacimiento) {
                    $fechaNac = new DateTime($fechaNacimiento);
                    $hoy = new DateTime();
                    return $fechaNac->diff($hoy)->y;
                }
                
                $edad = calcularEdad($socio->fecha_nacimiento);
                
                // Determinar tipo de categoría por edad
                if ($edad >= 5 && $edad <= 17) {
                    $id_tipo_categoria = 2; // Infantil
                } elseif ($edad >= 18 && $edad <= 64) {
                    $id_tipo_categoria = 1; // Adherente
                } elseif ($edad >= 65 && $edad <= 99) {
                    $id_tipo_categoria = 3; // Vitalicio
                } else {
                    $id_tipo_categoria = null; 
                }
                
                if ($id_tipo_categoria !== null) {
                    $stmtCat = $conn->prepare("INSERT INTO categorias (id_socio, id_tipo_categoria) VALUES (:id_socio, :id_categoria)");
                    $stmtCat->execute([
                        'id_socio' => $lastId,
                        'id_categoria' => $id_tipo_categoria
                    ]);
                }        

                $token = bin2hex(random_bytes(32));

                $stmt = $conn->prepare("INSERT INTO activaciones (id_socio, token) VALUES (:id_socio, :token)");
                $stmt->bindParam(':id_socio', $lastId);
                $stmt->bindParam(':token', $token);
                $stmt->execute();

                Mailer::enviarCorreoActivacion(
                    $socio->correo_electronico,
                    $socio->nombre,
                    $socio->apellido,
                    $token
                );

                echo "<script>alert('Socio registrado correctamente. Se envió un correo de activación.'); window.location.href = '../views/CrearSocio.php';</script>";
                exit;
            } else {
                echo "<script>alert('Error al registrar el socio: " . $e->getMessage() . "'); window.history.back();</script>";
                exit;
            }
        }       

    }

}

if (isset($_POST['action'])) {
    $controller = new SocioController();
    if ($_POST['action'] == "crear_socio") {
        $controller->crearSocio();
    } elseif ($_POST['action'] == "eliminar_socio") {
        $controller->eliminarSocio();
    } elseif ($_POST['action'] == "actualizar_socio") {
        $controller->actualizarSocio();
    }
}
