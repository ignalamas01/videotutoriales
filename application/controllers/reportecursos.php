<?php
defined('BASEPATH') or exit('No direct script access allowed');


	
	
	// class Cursos_creados_emple extends CI_Controller {
	// 	public function __construct() {
	// 		parent::__construct();
	// 		$this->load->model('graduados_model'); // Reemplaza 'TuModelo' con el nombre real de tu modelo
	// 	}
	
	// 	public function lista() {
	// 		// Llama al método del modelo para obtener los datos de estudiantes completos
	// 		$data['estudiantes_completos'] = $this->graduados_model->obtener_estudiantes_completos();
	
	// 		// Carga la vista y pasa los datos como un arreglo
	// 		 // Reemplaza 'tu_vista' con el nombre de tu vista

	// 		$this->load->view('incadmin/cabecera');
	// 	$this->load->view('incadmin/menu');
	// 	$this->load->view('incadmin/menulateral');
	// 	$this->load->view('cursos_creados_emple_lista', $data);
	// 	$this->load->view('incadmin/pie');
	// 	}
	// }
    


   
    
	class Reportecursos extends CI_Controller {

		public function __construct() {
			parent::__construct();
			$this->load->model('Creados_model'); // Asegúrate de que el nombre sea correcto
		}
	
		public function listacreados() {
			$data['v_cursos_creados_empleados'] = $this->Creados_model->obtener_cursos_empleados();
		   
			$this->load->view('incadmin/cabecera');
			$this->load->view('incadmin/menu');
			$this->load->view('incadmin/menulateral');
			$this->load->view('reportesempleados', $data);
			$this->load->view('incadmin/pie');
		}
	
	}
	
    


	
	
