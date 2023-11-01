<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Certificados extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        // Cargar modelos necesarios
        $this->load->model('certificados_model');
    }

    public function emitir_certificado() {
        $idCurso = $this->input->post('idCurso');
        
        $idUsuario = $this->session->userdata('idusuario');
        $estudiante = $this->db->get_where('estudiante', array('idUsuario' => $idUsuario))->row();

        if ($estudiante) {
            $idEstudiante = $estudiante->id;
            
            // Obtener evaluaciones activas del curso y sección
            $evaluaciones = $this->certificados_model->obtener_evaluaciones_activas_seccion($idCurso);
            
            // Variable de control para saber si se encontró una evaluación aprobada
            $evaluacionAprobadaEncontrada = false;

            foreach ($evaluaciones as $evaluacion) {
                $puntajeTotal = $this->certificados_model->obtener_puntaje_total($idCurso, $evaluacion->idEvaluacion, $idEstudiante);

                // Verificar si el estudiante ha aprobado esta evaluación
                $evaluacionAprobada = $this->certificados_model->verificar_aprobacion_curso($idCurso, $idEstudiante, $evaluacion->idEvaluacion);

                // Si alguna evaluación está aprobada, marcar como verdadero y salir del bucle
                if ($evaluacionAprobada) {
                    $evaluacionAprobadaEncontrada = true;
                    break;
                }
            }

            // Si se encontró una evaluación aprobada, emitir el certificado
            if ($evaluacionAprobadaEncontrada) {
                // $this->certificados_model->emitir_certificado($idCurso, $idEstudiante);
                // $this->certificados_model->generar_certificado_pdf($idCurso, $idEstudiante);
                echo '¡Certificado emitido!';
            } else {
                echo 'No cumples con los requisitos para obtener el certificado.';
            }
        } else {
            echo 'No se encontró información del estudiante.';
        }
    }

    
}