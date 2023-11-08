<?php
defined('BASEPATH') or exit('No direct script access allowed');


// class Reportes extends CI_Controller
// {
// 	$this->load->model('Reportes_model');
	
// 	public function reportes()
// 	{
		
// 		if($this->session->userdata('login'))
//         {
			
// 			 $lista = $this->inscripciones_model->listainscritos();
// 			 $tipo = $this->session->userdata('tipo');

// 			$data['estudiante'] = $lista;
// 			//  $this->load->view('inc/cabecera');
// 			//  $this->load->view('inc/menu');
// 			//  $this->load->view('inc/menulateral');
// 			//  $this->load->view('suscritos_lista',$data);
// 			//  $this->load->view('inc/pie');
// 			if ($tipo == 'admin') {
// 				// Cargar la vista para el administrador
// 						$this->load->view('incadmin/cabecera');
// 						$this->load->view('incadmin/menu');
// 						$this->load->view('incadmin/menulateral');
// 						$this->load->view('verreporte',$data);
// 						$this->load->view('incadmin/pie');
// 			} if ($tipo == 'empleado') {
// 				// Cargar la vista para el empleado
// 				$this->load->view('inc/cabecera');
// 				$this->load->view('inc/menu');
// 				$this->load->view('inc/menulateral');
// 				$this->load->view('verreporte',$data);
// 				$this->load->view('inc/pie');
	
// 			} 
// 			if ($tipo == 'invitado') {
// 				// Cargar la vista para el empleado
// 				$this->load->view('incestudiante/cabecera');
// 				$this->load->view('incestudiante/menu');
// 				$this->load->view('incestudiante/menulateral');
// 				$this->load->view('verreporte',$data);
// 				$this->load->view('inc/pie');
				
				
// 			}
//         }
//         else
//         {
//             redirect('usuarios/index/2','refresh');
//         }
		
		
// 	}
	
// } 

class Reportes extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('Reportes_model');
    }

    public function estudiantes_cursos() {
        // Llama al método del modelo para obtener los datos de estudiantes y cursos
        $estudiantes_cursos = $this->Reportes_model->obtener_estudiantes_cursos();
        $cursos = $this->Reportes_model->obtener_titulos_cursos_por_estudiante();

        // Puedes pasar los datos a una vista para mostrarlos
        $data['estudiantes_cursos'] = $estudiantes_cursos;
        $data['cursos'] = $cursos;

        $this->load->view('incadmin/cabecera');
        $this->load->view('incadmin/menu');
        $this->load->view('incadmin/menulateral');
        $this->load->view('estudiantes_cursos_view', $data);
        $this->load->view('incadmin/pie');
    }
}



