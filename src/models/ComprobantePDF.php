<?php
require_once __DIR__ . '/../vendor/autoload.php';

use Fpdf\Fpdf;

class ComprobantePDF
{
    public static function generar($datos)
    {
        $pdf = new FPDF();
        $pdf->AddPage();
        $pdf->SetFont('Arial', 'B', 16);
        $pdf->Cell(0, 10, 'Comprobante de Pago', 0, 1, 'C');
        $pdf->Ln(10);
        $pdf->SetFont('Arial', '', 12);

        $pdf->Cell(0, 10, 'ID de Pago: ' . $datos['id_pago'], 0, 1);
        $pdf->Cell(0, 10, 'Nombre: ' . $datos['nombre'] . ' ' . $datos['apellido'], 0, 1);
        $pdf->Cell(0, 10, 'Mes abonado: ' . $datos['mes'], 0, 1);
        $pdf->Cell(0, 10, 'Monto: AR$ ' . number_format($datos['monto'], 2, ',', '.'), 0, 1);
        $pdf->Cell(0, 10, 'Medio de pago: ' . ucfirst($datos['medio_pago']), 0, 1);
        $pdf->Cell(0, 10, 'Fecha: ' . date('d/m/Y H:i', strtotime($datos['fecha_pago'])), 0, 1);

        $ruta = __DIR__ . '/../comprobantes/comprobante_' . $datos['id_pago'] . '.pdf';
        $pdf->Output('F', $ruta);

        return $ruta;
    }
}
