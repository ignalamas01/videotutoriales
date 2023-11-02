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
                $ultimoCertificado = $this->certificados_model->obtener_ultimo_certificado($idCurso, $idEstudiante);
                if (!$ultimoCertificado || $ultimoCertificado->emitido == 0) { 
                $this->certificados_model->emitir_certificado($idCurso, $idEstudiante);
                $this->certificados_model->generar_certificado_pdf($idCurso, $idEstudiante);
                echo '¡Certificado emitido!';
            } else {
                echo 'Ya se emitio un certificado anteriormente';
            }
        } else {
            echo 'No cumples con los requisitos para obtener el certificado.';
        }
    }
}
public function certificados_lista()
	{
		
		if($this->session->userdata('login'))
        {
			//$lista=$this->empleado_model->listaempleados();
			$lista = $this->cursos_model->listacursos();


			$data['cursos'] = $lista;
			$this->load->view('incestudiante/cabecera');
			$this->load->view('incestudiante/menu');
			$this->load->view('incestudiante/menulateral');
			//$this->load->view('cursos_lista',$data);
			$this->load->view('certificados_lista',$data);
			$this->load->view('incestudiante/pie');
        }
        else
        {
            redirect('usuarios/index/2','refresh');
        }
		
		
	}
    
}