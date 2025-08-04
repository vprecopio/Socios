<?php
date_default_timezone_set('America/Argentina/Buenos_Aires');
require_once 'Database.php';

class Pago {
    private $db;

    public function __construct() {
        $this->db = (new Database())->connect();
    }

    public function registrarPago($id_socio, $mes, $monto, $medio_pago) {
        $fecha_pago = date('Y-m-d H:i:s');
        $stmt = $this->db->prepare("INSERT INTO pagos (id_socio, fecha_pago, mes, monto, medio_pago) VALUES (?, ?, ?, ?, ?)");
        if ($stmt->execute([$id_socio, $fecha_pago, $mes, $monto, $medio_pago])) {
            return $this->db->lastInsertId(); // Devuelve el ID del pago insertado
        }
        return false;
    }    

    public function obtenerPagosPorSocio($id_socio) {
        $stmt = $this->db->prepare("SELECT mes FROM pagos WHERE id_socio = ?");
        $stmt->execute([$id_socio]);
        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }

    public function obtenerPagosPorMes($mes) {
        $stmt = $this->db->prepare("
            SELECT s.nombre, s.apellido, s.dni, p.fecha_pago
            FROM pagos p 
            JOIN socios s ON p.id_socio = s.id_socio 
            WHERE p.mes = ?
        ");
        $stmt->execute([$mes]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }    

    public function obtenerPagosDetallesPorSocio($id_socio) {
        $stmt = $this->db->prepare("SELECT mes, fecha_pago, monto, medio_pago FROM pagos WHERE id_socio = ?");
        $stmt->execute([$id_socio]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}
?>