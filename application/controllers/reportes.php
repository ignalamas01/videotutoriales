<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Reportes extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('Reportes_model');
    }

    public function estudiantes_cursos() {
        // Obtener datos de estudiantes y cursos
        $estudiantes_cursos = $this->Reportes_model->obtener_estudiantes_cursos();
        
        // Inicializar arrays para los títulos de cursos y cantidades
        $data['titulos_cursos'] = [];
        $data['cantidad_inscritos'] = [];
        
        // Asegúrate de que $estudiantes_cursos tenga las propiedades correctas
        foreach ($estudiantes_cursos as $curso) {
            if (isset($curso->nombre_curso) && isset($curso->cantidad_inscritos)) {
                $data['titulos_cursos'][] = $curso->nombre_curso; // Nombre del curso
                $data['cantidad_inscritos'][] = (int)$curso->cantidad_inscritos; // Cantidad de inscritos (convertir a int)
            }
        }
        
        // Pasar los datos a la vista
        $data['estudiantes_cursos'] = $estudiantes_cursos;
        
        // Cargar las vistas
        $this->load->view('incadmin/cabecera');
        $this->load->view('incadmin/menu');
        $this->load->view('incadmin/menulateral');
        $this->load->view('estudiantes_cursos_view', $data);
        $this->load->view('incadmin/pie');
    }
    
    

    
}




