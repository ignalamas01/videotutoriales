<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Suscripciones extends CI_Controller
{
	
	public function agregarEstudiante()
	{
		
		if($this->session->userdata('login'))
        {
			
			$this->load->view('inc/cabecera');
			$this->load->view('inc/menu');
			$this->load->view('inc/menulateral');
			// Consulta los datos de la tabla "otra_tabla"
    		$data['cursos'] = $this->cursos_model->listacursos(); // Asumiendo que tienes un método en tu modelo para obtener los datos

    		// Consulta los datos de la tabla "estudiante"
    		$data['estudiante'] = $this->estudiante_model->listaestudiante(); // Asumiendo que tienes un método en tu modelo para obtener los estudiantes

    		// Carga la vista con los datos
    		$this->load->view('inscribirfor', $data);
			$this->load->view('inc/pie');
        }
        else
        {
            redirect('usuarios/index/2','refresh');
        }
		
		
	} 
	public function inscribirbd() {
		$this->load->model('Inscripciones_model');
		if ($this->input->post()) {
			$data = array(
				'idEstudiante' => $this->input->post('id_estudiante'),
				'idCurso' => $this->input->post('id_curso'),
				'fechaInicio' => $this->input->post('fechaInicio'),  // Agregar fecha de inicio
				'fechaFin' => $this->input->post('fechaFin')  // Agregar fecha de fin
			);
	
			$inscripcion_id = $this->Inscripciones_model->insertar_inscripcion($data);
			
			// Realiza acciones adicionales si es necesario

			// Obtén el nombre del curso para mostrarlo en el mensaje
			if ($inscripcion_id) {
				// Inscripción exitosa, obtén el nombre del curso
				$curso = $this->Inscripciones_model->obtener_curso_por_id($data['idCurso']);
				$nombre_curso = $curso->titulo;
	
				$mensaje = "El estudiante ha sido inscrito correctamente en el curso: " . $nombre_curso;
			} else {
				// Error en la inscripción
				$mensaje = "Hubo un error al inscribir al estudiante en el curso.";
			}
	
			// Carga la vista con el mensaje de inscripción
			// $data['mensaje'] = $mensaje;
			// $this->load->view('mensaje_inscripcion', $data);
			 // Almacena el mensaje en la sesión
			 $this->session->set_flashdata('mensaje', $mensaje);

			 // Redirige a la vista agregarEstudiante
			 redirect('suscripciones/agregarEstudiante');
		}
	}
	
	
		
    		
		


}
