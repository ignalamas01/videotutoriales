<?php
// Incluir el framework de CodeIgniter
include_once __DIR__ . '/../../index.php'; // Ajusta la ruta en función de la ubicación

// Obtener una instancia de CodeIgniter y cargar el modelo
$CI =& get_instance();
$CI->load->model('Reportes_model');

// Incluir FPDF
require('./fpdf.php');

class PDF extends FPDF
{
    function Header() {
        $this->Image('logo_cepra.jpeg', 185, 5, 20);
        $this->SetFont('Arial', 'B', 19);
        $this->Cell(45);
        $this->SetTextColor(0, 0, 0);
        $this->Cell(110, 15, utf8_decode('CEPRA'), 1, 1, 'C', 0);
        $this->Ln(3);
        $this->SetTextColor(103);

        /* Información de contacto */
        $this->Cell(110);
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(96, 10, utf8_decode("Ubicación: Parque la Torre N°434"), 0, 0, '', 0);
        $this->Ln(5);
        $this->Cell(110);
        $this->Cell(59, 10, utf8_decode("Teléfono: 79988432"), 0, 0, '', 0);
        $this->Ln(5);
        $this->Cell(110);
        $this->Cell(85, 10, utf8_decode("Correo: CEPRA_instituto@cepra.com"), 0, 0, '', 0);
        $this->Ln(5);
        $this->Cell(110);
        $this->Cell(85, 10, utf8_decode("Sucursal: Pacata baja calle Beni, N°524"), 0, 0, '', 0);
        $this->Ln(10);

        /* Título */
        $this->SetTextColor(228, 100, 0);
        $this->Cell(50);
        $this->SetFont('Arial', 'B', 15);
        $this->Cell(100, 10, utf8_decode("REPORTE DE ESTUDIANTES INSCRITOS A CURSOS"), 0, 1, 'C', 0);
        $this->Ln(7);

        /* Encabezado de tabla */
        $this->SetFillColor(228, 100, 0);
        $this->SetTextColor(255, 255, 255);
        $this->SetDrawColor(163, 163, 163);
        $this->SetFont('Arial', 'B', 11);
        $this->Cell(10, 10, 'N°', 1, 0, 'C', 1);
        $this->Cell(70, 10, 'Nombre Estudiante', 1, 0, 'C', 1);
        $this->Cell(30, 10, 'Cantidad Cursos', 1, 0, 'C', 1);
        $this->Cell(80, 10, 'Cursos Inscritos', 1, 1, 'C', 1);
    }

    function Footer() {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, 'Página '.$this->PageNo().'/{nb}', 0, 0, 'C');
        $this->SetY(-15);
        $this->Cell(355, 10, date('d/m/Y'), 0, 0, 'C');
    }
}

// Crear una instancia de PDF y configurar el documento
$pdf = new PDF();
$pdf->AddPage();
$pdf->AliasNbPages();
$pdf->SetFont('Arial', '', 12);
$pdf->SetDrawColor(163, 163, 163);

// Obtener datos de estudiantes inscritos a cursos usando el modelo cargado
$fecha_inicio = null; // Coloca las fechas que necesitas
$fecha_fin = null;    // Coloca las fechas que necesitas
$estudiantes_cursos = $CI->Reportes_model->obtener_estudiantes_cursos($fecha_inicio, $fecha_fin);

// Imprimir datos en el PDF
$i = 1;
foreach ($estudiantes_cursos as $estudiante) {
    $pdf->Cell(10, 10, $i, 1, 0, 'C');
    $pdf->Cell(70, 10, utf8_decode($estudiante->nombre_estudiante), 1, 0, 'C');
    $pdf->Cell(30, 10, $estudiante->cantidad_cursos, 1, 0, 'C');
    $pdf->Cell(80, 10, utf8_decode($estudiante->titulos_cursos), 1, 1, 'C');
    $i++;
}

// Salida del archivo PDF
$pdf->Output('reporte_estudiantes.pdf', 'I');
?>
