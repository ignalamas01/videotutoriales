<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Suscripciones extends CI_Controller
{
	
    public function __construct() {
        parent::__construct();
        // Cargar el modelo
        $this->load->model('Inscripciones_model');
    }
	
	public function agregarEstudiante()
	{
		
		if($this->session->userdata('login'))
        {
			
			$this->load->view('incadmin/cabecera');
			$this->load->view('incadmin/menu');
			$this->load->view('incadmin/menulateral');
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

		// Iniciar la transacción
		$this->db->trans_start();

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

			// Finalizar la transacción
			$this->db->trans_complete();

			if ($this->db->trans_status() === FALSE) {
				// Ocurrió un error en la transacción
				$mensaje = "Error en la transacción. La inscripción no se completó.";
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


	
	
	public function lista()
	{
		
		if($this->session->userdata('login'))
        {
			
			 $lista = $this->inscripciones_model->listainscritos();
			 $tipo = $this->session->userdata('tipo');

			$data['estudiante'] = $lista;
			//  $this->load->view('inc/cabecera');
			//  $this->load->view('inc/menu');
			//  $this->load->view('inc/menulateral');
			//  $this->load->view('suscritos_lista',$data);
			//  $this->load->view('inc/pie');
			if ($tipo == 'admin') {
				// Cargar la vista para el administrador
						$this->load->view('incadmin/cabecera');
						$this->load->view('incadmin/menu');
						$this->load->view('incadmin/menulateral');
						$this->load->view('suscritos_lista',$data);
						$this->load->view('incadmin/pie');
			} if ($tipo == 'empleado') {
				// Cargar la vista para el empleado
				$this->load->view('inc/cabecera');
				$this->load->view('inc/menu');
				$this->load->view('inc/menulateral');
				$this->load->view('suscritos_lista',$data);
				$this->load->view('inc/pie');
	
			} 
			if ($tipo == 'invitado') {
				// Cargar la vista para el empleado
				$this->load->view('incestudiante/cabecera');
				$this->load->view('incestudiante/menu');
				$this->load->view('incestudiante/menulateral');
				$this->load->view('suscritos_lista',$data);
				$this->load->view('inc/pie');
				
				
			}
        }
        else
        {
            redirect('usuarios/index/2','refresh');
        }
		
		
	}
	public function listar_inscritos($curso_id = null) {
        $data['inscripciones'] = $this->Inscripciones_model->listainscritos($curso_id);
        $this->load->view('tu_vista_lista_inscritos', $data);
    }
	public function ver_inscripcion($idSuscripcion) {
        $data['suscripcion'] = $this->Inscripciones_model->obtener_inscripcion($idSuscripcion);
        $this->load->view('tu_vista_ver_inscripcion', $data);
    }
	public function editar($idSuscripcion) {
		if ($this->session->userdata('login')) {
			$data['suscripcion'] = $this->Inscripciones_model->obtener_inscripcion($idSuscripcion);
			$data['cursos'] = $this->cursos_model->listacursos();
			$data['estudiantes'] = $this->estudiante_model->listaestudiante();
			
			$this->load->view('incadmin/cabecera');
			$this->load->view('incadmin/menu');
			$this->load->view('incadmin/menulateral');
			$this->load->view('editar_suscripcion', $data);
			$this->load->view('incadmin/pie');
		} else {
			redirect('usuarios/index/2', 'refresh');
		}
	}
	
	public function actualizar() {
		$idSuscripcion = $this->input->post('idSuscripcion');
		if ($this->session->userdata('login')) {
			// Obtener los datos del formulario
			$fechaInicio = $this->input->post('fechaInicio');
			$fechaFin = $this->input->post('fechaFin');
	
			$data = array(
				'fechaInicio' => $fechaInicio,
				'fechaFin' => $fechaFin,
			);
	
			// Actualizar la suscripción
			if ($this->inscripciones_model->actualizar_inscripcion($idSuscripcion, $data)) {
				// Redirigir o cargar vista de éxito
				redirect('suscripciones/lista', 'refresh');
			} 
			else {
				// Manejo de error, puedes redirigir a una página de error o mostrar un mensaje
				// Para simplicidad, aquí redirigimos a la misma página
				redirect('suscripciones/lista', 'refresh');
			}
		 } 
		//  else {
		// 	redirect('usuarios/index/2', 'refresh');
		// }
	}
	
	
	
	public function eliminar($id) {
		$this->load->model('Inscripciones_model');
		$this->Inscripciones_model->eliminar_inscripcion($id);
		$this->session->set_flashdata('mensaje', 'Suscripción eliminada correctamente.');
		redirect('suscripciones/lista');
	}
	// En Suscripciones.php
public function inhabilitar($idSuscripcion) {
    if ($this->session->userdata('login')) {
        // Llama al modelo para inhabilitar la suscripción
        if ($this->Inscripciones_model->inhabilitar_inscripcion($idSuscripcion)) {
            // Redirige a la lista de suscripciones con un mensaje de éxito
            $this->session->set_flashdata('success', 'Suscripción inhabilitada correctamente.');
            redirect('suscripciones/lista', 'refresh');
        } else {
            // Manejo de error si no se pudo inhabilitar
            $this->session->set_flashdata('error', 'No se pudo inhabilitar la suscripción. Intente de nuevo.');
            redirect('suscripciones/lista', 'refresh');
        }
    } else {
        redirect('usuarios/index/2', 'refresh');
    }
}

	

	
	







// 			
				


// 				$this->pdf->Cell(3);
// 				$this->pdf->Cell(7,5,$num,'TBLR',0,'L',0);
// 				$this->pdf->Cell(50,5,$nombre,'TBLR',0,'L',0);
// 				$this->pdf->Cell(30,5,$primerApellido,'TBLR',0,'L',0);
// 				$this->pdf->Cell(35,5,$segundoApellido,'TBLR',0,'L',0);
// 				$this->pdf->Cell(30,5,$carrera,'TBLR',0,'L',0);
// 				$this->pdf->Cell(35,5,$fechaNacimiento,'TBLR',0,'L',0);
// 				$this->pdf->Cell(30,5,$direccion,'TBLR',0,'L',0);
// 				//$this->pdf->Cell(30,5,$direccion,'TBLR',0,'L',0);
// 				$this->pdf->Ln(5);
// 				$num++;
// 			}


// 			$this->pdf->Output("lista estudiantes.pdf","I");




// 			$data['suscripciones'] = $lista;
// 			$this->load->view('inc/cabecera');
// 			$this->load->view('inc/menu');
// 			$this->load->view('inc/menulateral');
// 			$this->load->view('suscritos_lista',$data);
// 			$this->load->view('inc/pie');
//         }
//         else
//         {
//             redirect('usuarios/index/2','refresh');
//         }
		
// 	}
	
	
		
    		
		


}
