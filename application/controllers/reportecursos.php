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
        $this->Cell(100, 10, utf8_decode("REPORTE DE CURSOS CREADOS POR EMPLEADOS"), 0, 1, 'C', 0);
        $this->Ln(7);

        // Encabezado de tabla
        $this->SetFillColor(228, 100, 0);
        $this->SetTextColor(255, 255, 255);
        $this->SetDrawColor(163, 163, 163);
        $this->SetFont('Arial', 'B', 11);
        $this->Cell(10, 10, 'N°', 1, 0, 'C', 1);
        $this->Cell(50, 10, 'Nombre Completo', 1, 0, 'C', 1);
        $this->Cell(30, 10, 'Seudónimo', 1, 0, 'C', 1);
        $this->Cell(30, 10, 'Cantidad Cursos', 1, 0, 'C', 1);
        $this->Cell(50, 10, 'Título del Curso', 1, 0, 'C', 1);
        $this->Cell(30, 10, 'Fecha Actualización', 1, 1, 'C', 1);
    }

    function Footer()
    {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, 'Página ' . $this->PageNo() . '/{nb}', 0, 0, 'C');
        $this->Cell(0, 10, date('d/m/Y'), 0, 0, 'R');
    }
}

class Reportecursos extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Creados_model');
    }

    public function listacreados() {
        $fecha_inicio = $this->input->get('fecha_inicio');
        $fecha_fin = $this->input->get('fecha_fin');
        
        $data['v_cursos_creados_empleados'] = $this->Creados_model->obtener_cursos_empleados($fecha_inicio, $fecha_fin);
        $data['fecha_inicio'] = $fecha_inicio;
        $data['fecha_fin'] = $fecha_fin;
        
        $this->load->view('incadmin/cabecera');
        $this->load->view('incadmin/menu');
        $this->load->view('incadmin/menulateral');
        $this->load->view('reportesempleados', $data);
        $this->load->view('incadmin/pie');
    }

    public function generar_pdf() {
		$fecha_inicio = $this->input->get('fecha_inicio'); // Parámetro de fecha inicial
		$fecha_fin = $this->input->get('fecha_fin'); // Parámetro de fecha final
	
		// Obtener los datos desde el modelo
		$cursos = $this->Creados_model->obtener_cursos_empleados($fecha_inicio, $fecha_fin);
	
		// Cargar la biblioteca FPDF
		$this->load->library('fpdf');
	
		// Crear un nuevo PDF usando la clase personalizada PDF
		$pdf = new PDF();  // Aquí usamos la clase PDF que contiene el Header y Footer personalizados
		$pdf->AddPage();
		
		// Puedes ajustar la fuente para el contenido si es necesario
		$pdf->SetFont('Arial', 'B', 12);
	
		// Título del documento (ya lo tienes en el Header, pero si quieres agregar uno adicional, lo puedes hacer aquí)
		$pdf->Cell(0, 10, 'Reporte de Cursos Creados por Empleados', 0, 1, 'C');
		$pdf->Ln(5); // Salto de línea
	
		// Encabezados de la tabla
		$pdf->SetFont('Arial', 'B', 10);
		$pdf->Cell(50, 10, 'Nombre Completo', 1);
		$pdf->Cell(30, 10, 'Seudonimo', 1);
		$pdf->Cell(30, 10, 'Cantidad Cursos', 1);
		$pdf->Cell(50, 10, 'Titulo del Curso', 1);
		$pdf->Cell(30, 10, 'Fecha Actualizacion', 1);
		$pdf->Ln();
	
		// Datos de la tabla
		$pdf->SetFont('Arial', '', 10);
		if (!empty($cursos)) {
			foreach ($cursos as $curso) {
				// Asegúrate de que las propiedades existan
				$nombre_completo = isset($curso->nombreCompleto) ? utf8_decode($curso->nombreCompleto) : 'N/A';
				$seudonimo = isset($curso->seudonimo) ? utf8_decode($curso->seudonimo) : 'N/A';
				$cantidad_cursos = isset($curso->cantidadTotalCursosCreados) ? $curso->cantidadTotalCursosCreados : 0;
				$titulo = isset($curso->nombresCursos) ? utf8_decode($curso->nombresCursos) : 'Sin Título';
				$fecha_actualizacion = isset($curso->fechaActualizacion) ? $curso->fechaActualizacion : 'N/A';
	
				$pdf->Cell(50, 10, $nombre_completo, 1);
				$pdf->Cell(30, 10, $seudonimo, 1);
				$pdf->Cell(30, 10, $cantidad_cursos, 1);
				$pdf->Cell(50, 10, $titulo, 1);
				$pdf->Cell(30, 10, $fecha_actualizacion, 1);
				$pdf->Ln();
			}
		} else {
			$pdf->Cell(190, 10, 'No se encontraron datos.', 1, 1, 'C');
		}
	
		// Salida del PDF
		$pdf->Output('D', 'reporte_cursos_empleados.pdf');
	}
	
	
}
