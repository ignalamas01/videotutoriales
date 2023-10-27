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
        $idEstudiante = $this->session->userdata('idusuario');
        
        // Obtener todas las evaluaciones del curso
        $evaluaciones = $this->certificados_model->obtener_evaluaciones_curso($idCurso);
        print_r($evaluaciones);
    
        // Inicializar variable para saber si todas las evaluaciones están aprobadas
        $todasAprobadas = true;
    
        // Verificar cada evaluación
        foreach ($evaluaciones as $evaluacion) {
            // Verificar si el estudiante ha obtenido al menos una nota mayor a 60 en esta evaluación
            $evaluacionAprobada = $this->certificados_model->verificar_aprobacion_curso($evaluacion->idEvaluacion, $idEstudiante);
            echo 'ID Evaluación: ' . $evaluacion->idEvaluacion . ' - Puntaje Total: ' . $evaluacion->puntajeTotal . '<br>';
            // Si alguna evaluación no está aprobada, marcar como falso
            if (!$evaluacionAprobada) {
                $todasAprobadas = false;
                break;
            }
        }
    
        // Si todas las evaluaciones están aprobadas, emitir el certificado
        if ($todasAprobadas) {
            $this->certificados_model->emitir_certificado($idCurso, $idEstudiante);
            echo '¡Certificado emitido!';
        } else {
            echo 'No cumples con los requisitos para obtener el certificado.';
        }
    }
}