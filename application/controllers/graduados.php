<?php
defined('BASEPATH') or exit('No direct script access allowed');
require(APPPATH . '../assets/fpdf/fpdf.php');

class PDF extends FPDF
{
    function Header()
    {
        $this->Image(APPPATH . '../assets/fpdf/logo_cepra.jpeg', 185, 5, 20);
        $this->SetFont('Arial', 'B', 19);
        $this->Cell(45);
        $this->SetTextColor(0, 0, 0);
        $this->Cell(110, 15, utf8_decode('CEPRA'), 1, 1, 'C', 0);
        $this->Ln(3);
        $this->SetTextColor(103);

        // Información de contacto
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

        // Título
        $this->SetTextColor(228, 100, 0);
        $this->Cell(50);
        $this->SetFont('Arial', 'B', 15);
        $this->Cell(100, 10, utf8_decode("REPORTE DE ESTUDIANTES GRADUADOS"), 0, 1, 'C', 0);
        $this->Ln(7);

        // Encabezado de tabla
        $this->SetFillColor(228, 100, 0);
        $this->SetTextColor(255, 255, 255);
        $this->SetDrawColor(163, 163, 163);
        $this->SetFont('Arial', 'B', 11);
        $this->Cell(10, 10, 'N°', 1, 0, 'C', 1);
        $this->Cell(70, 10, 'Nombres y apellidos', 1, 0, 'C', 1);
        $this->Cell(70, 10, 'Curso no concluido', 1, 0, 'C', 1);
        $this->Cell(40, 10, 'Porcentaje de avance', 1, 1, 'C', 1);
    }

    function Footer()
    {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, 'Página ' . $this->PageNo() . '/{nb}', 0, 0, 'C');
        $this->Cell(0, 10, date('d/m/Y'), 0, 0, 'R');
    }
}
	
class Graduados extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('graduados_model'); // Carga el modelo correspondiente
    }

    public function lista() {
        // Obtener las fechas desde el formulario
        $fecha_inicio = $this->input->post('fecha_inicio');
        $fecha_fin = $this->input->post('fecha_fin');

        // Llama al modelo para obtener los datos de estudiantes graduados dentro del rango de fechas
        $data['estudiantes_completos'] = $this->graduados_model->obtener_estudiantes_completos($fecha_inicio, $fecha_fin);

        // Pasar las fechas a la vista
        $data['fecha_inicio'] = $fecha_inicio;
        $data['fecha_fin'] = $fecha_fin;

        // Cargar las vistas con los datos
        $this->load->view('incadmin/cabecera');
        $this->load->view('incadmin/menu');
        $this->load->view('incadmin/menulateral');
        $this->load->view('graduados_lista', $data);
        $this->load->view('incadmin/pie');
    }

    public function generar_pdf() {
        // Obtener las fechas desde la URL
        $fecha_inicio = $this->input->get('fecha_inicio');
        $fecha_fin = $this->input->get('fecha_fin');

        // Crear una instancia del modelo y generar el reporte en PDF
        $this->load->model('graduados_model');
        $pdf = new PDF();
        $pdf->AddPage();
        $pdf->AliasNbPages();
        $pdf->SetFont('Arial', '', 12);
        $pdf->SetDrawColor(163, 163, 163);

        // Obtener datos de estudiantes graduados
        $graduados = $this->graduados_model->obtener_estudiantes_completos($fecha_inicio, $fecha_fin);

        // Imprimir datos en el PDF
        $i = 1;
        foreach ($graduados as $estudiante) {
            $pdf->Cell(10, 10, $i, 1, 0, 'C');
            $pdf->Cell(70, 10, utf8_decode($estudiante->nombreCompleto), 1, 0, 'L');
            $pdf->Cell(70, 10, utf8_decode($estudiante->tituloCurso), 1, 0, 'L');
            $pdf->Cell(40, 10, $estudiante->porcentajeCompletado . '%', 1, 1, 'C');
            $i++;
        }

        // Salida del archivo PDF
        $pdf->Output('reporte_graduados.pdf', 'I');
    }
}

	
