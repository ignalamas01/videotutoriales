<?php
defined('BASEPATH') or exit('No direct script access allowed');
require(APPPATH . '../assets/fpdf/fpdf.php');

// Definir la clase PDF fuera de cualquier función
class PDF extends FPDF
{
    function Header() {
        $this->Image(APPPATH . '../assets/fpdf/logo_cepra.jpeg', 185, 5, 20);
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
        $this->Cell(10, 10, 'N', 1, 0, 'C', 1);
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


class Reportes extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('Reportes_model');
        $this->load->library('fpdf'); 
    }

    // public function estudiantes_cursos() {
    //     // Obtener datos de estudiantes y cursos
    //     $estudiantes_cursos = $this->Reportes_model->obtener_estudiantes_cursos();
        
    //     // Inicializar arrays para los títulos de cursos y cantidades
    //     $data['titulos_cursos'] = [];
    //     $data['cantidad_inscritos'] = [];
        
    //     // Asegúrate de que $estudiantes_cursos tenga las propiedades correctas
    //     foreach ($estudiantes_cursos as $curso) {
    //         if (isset($curso->nombre_curso) && isset($curso->cantidad_inscritos)) {
    //             $data['titulos_cursos'][] = $curso->nombre_curso; // Nombre del curso
    //             $data['cantidad_inscritos'][] = (int)$curso->cantidad_inscritos; // Cantidad de inscritos (convertir a int)
    //         }
    //     }
        
    //     // Pasar los datos a la vista
    //     $data['estudiantes_cursos'] = $estudiantes_cursos;
        
    //     // Cargar las vistas
    //     $this->load->view('incadmin/cabecera');
    //     $this->load->view('incadmin/menu');
    //     $this->load->view('incadmin/menulateral');
    //     $this->load->view('estudiantes_cursos_view', $data);
    //     $this->load->view('incadmin/pie');
    // }
    public function estudiantes_cursos() {
        // Obtener datos de las fechas desde el formulario
        $fecha_inicio = $this->input->post('fecha_inicio');
        $fecha_fin = $this->input->post('fecha_fin');
    
        // Obtener datos de estudiantes y cursos, aplicando el filtro de fechas
        $estudiantes_cursos = $this->Reportes_model->obtener_estudiantes_cursos($fecha_inicio, $fecha_fin);
    
        // Inicializar arrays para los títulos de cursos y cantidades
        $data['titulos_cursos'] = [];
        $data['cantidad_inscritos'] = [];
    
        foreach ($estudiantes_cursos as $curso) {
            if (isset($curso->nombre_curso) && isset($curso->cantidad_inscritos)) {
                $data['titulos_cursos'][] = $curso->nombre_curso;
                $data['cantidad_inscritos'][] = (int)$curso->cantidad_inscritos;
            }
        }
    
        $data['estudiantes_cursos'] = $estudiantes_cursos;
        $data['fecha_inicio'] = $fecha_inicio;
        $data['fecha_fin'] = $fecha_fin;
    
        // Cargar las vistas
        $this->load->view('incadmin/cabecera');
        $this->load->view('incadmin/menu');
        $this->load->view('incadmin/menulateral');
        $this->load->view('estudiantes_cursos_view', $data);
        $this->load->view('incadmin/pie');
    }
    
    
    public function generar_pdf()
    {
        $fecha_inicio = $this->input->get('fecha_inicio');
        $fecha_fin = $this->input->get('fecha_fin');
         // Obtener una instancia de CodeIgniter y cargar el modelo
    $CI =& get_instance();
    $CI->load->model('Reportes_model');

    // Crear una instancia de PDF y configurar el documento
    $pdf = new PDF();
    $pdf->AddPage();
    $pdf->AliasNbPages();
    $pdf->SetFont('Arial', '', 12);
    $pdf->SetDrawColor(163, 163, 163);

    // Obtener datos de estudiantes inscritos a cursos usando el modelo cargado
    // $fecha_inicio = null; // Coloca las fechas que necesitas
    // $fecha_fin = null;    // Coloca las fechas que necesitas
    $estudiantes_cursos = $CI->Reportes_model->obtener_estudiantes_cursos($fecha_inicio, $fecha_fin);
 // Establecer las posiciones iniciales para las celdas
 $xInicial = 10;  // Posición X para el número
 $xNombre = 20;   // Posición X para el nombre del estudiante
 $xCantidadCursos = 90; // Posición X para la cantidad de cursos
 $xCursos = 120;  // Posición X para los cursos
    // Imprimir datos en el PDF
    $i = 1;
    foreach ($estudiantes_cursos as $estudiante) {
        $pdf->SetX($xInicial); // Asegura que la posición X es correcta
        $pdf->Cell(10, 10, $i, 1, 0, 'C');
        $pdf->SetX($xNombre);  // Asegura que la posición X para el nombre es correcta
        $pdf->Cell(70, 10, utf8_decode($estudiante->nombre_estudiante), 1, 0, 'C');
        $pdf->SetX($xCantidadCursos); 
        $pdf->Cell(30, 10, $estudiante->cantidad_cursos, 1, 0, 'C');

        // Imprimir cada curso en una fila separada
        $titulos_cursos = explode(',', $estudiante->titulos_cursos); // Asumiendo que los cursos están separados por comas
        foreach ($titulos_cursos as $curso) {
            $pdf->SetX($xCursos); // Restablece la posición X para cada curso
            $pdf->Cell(80, 10, utf8_decode($curso), 1, 1, 'C'); // Cada curso en una nueva fila
        }

        $i++;
    }

    // Salida del archivo PDF
    $pdf->Output('reporte_estudiantes.pdf', 'I');
    }

    
}




