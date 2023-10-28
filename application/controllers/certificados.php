<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Certificados extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        // Cargar modelos necesarios
        $this->load->model('certificados_model');
    }

    public function emitir_certificado() {
        // Obtener datos del formulario
        $idCurso = $this->input->post('idCurso');
        $idUsuario = $this->session->userdata('idusuario');

// Obtener idEstudiante de la tabla estudiante usando idUsuario
$estudiante = $this->db->get_where('estudiante', array('idUsuario' => $idUsuario))->row();

if ($estudiante) {
    $idEstudiante = $estudiante->id;
    // Resto del código...
} else {
    // Manejar el caso en que no se encuentra el estudiante
    echo 'No se encontró información del estudiante.';
}
        // Obtener todas las evaluaciones del curso
        $evaluaciones = $this->certificados_model->obtener_evaluaciones_curso($idCurso);
        // print_r($evaluaciones);
    
        // Variable de control para saber si se encontró una evaluación aprobada
        $evaluacionAprobadaEncontrada = false;
    
        // Verificar cada evaluación
        foreach ($evaluaciones as $evaluacion) {
            // Obtener puntaje total
            $puntajeTotal = $this->certificados_model->obtener_puntaje_total($idCurso, $evaluacion->idEvaluacion, $idEstudiante);
    
            // Imprimir puntaje total
            // echo 'ID Evaluación: ' . $evaluacion->idEvaluacion . ' - Puntaje Total (puntajesevaluacion): ' . $puntajeTotal . '<br>';
    
            // Verificar si el estudiante ha obtenido al menos una nota mayor a 60 en esta evaluación
            $evaluacionAprobada = $puntajeTotal > 60;
    
            // Si alguna evaluación está aprobada, marcar como verdadero y salir del bucle
            if ($evaluacionAprobada) {
                $evaluacionAprobadaEncontrada = true;
                break;
            }
        }
    
        // Si se encontró una evaluación aprobada, emitir el certificado
        if ($evaluacionAprobadaEncontrada) {
            $this->certificados_model->emitir_certificado($idCurso, $idEstudiante);
            $this->certificados_model->generar_certificado_pdf($idCurso, $idEstudiante);
            echo '¡Certificado emitido!';
        } else {
            echo 'No cumples con los requisitos para obtener el certificado.';
        }
    }
    

    
}