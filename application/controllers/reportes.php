<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Reportes extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('Reportes_model');
    }

   public function estudiantes_cursos() {
    // Llama al método del modelo para obtener los datos de estudiantes y cursos
    $estudiantes_cursos = $this->Reportes_model->obtener_estudiantes_cursos();
    
    // Llama al método del modelo para obtener los títulos de cursos activos
    $cursos_activos = $this->Reportes_model->obtener_cursos_activos();
    $data['cursos'] = $this->cursos_model->listacursos(); // Asumiendo que tienes un método en tu modelo para obtener los datos

    		// Consulta los datos de la tabla "estudiante"
    		
    // Puedes pasar los datos a una vista para mostrarlos
    $data['estudiantes_cursos'] = $estudiantes_cursos;
    $data['cursos_activos'] = $cursos_activos;
    
    $this->load->view('incadmin/cabecera');
    $this->load->view('incadmin/menu');
    $this->load->view('incadmin/menulateral');
    $this->load->view('estudiantes_cursos_view', $data);
    $this->load->view('incadmin/pie');
}

    
}




