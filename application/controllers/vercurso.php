

<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Vercurso extends CI_Controller
{
    public function ver($id)
    {
        // Cargar el modelo de cursos
        $this->load->model('vercurso_model');

        // Obtener los detalles del curso por ID
        $data['curso'] = $this->vercurso_model->obtener_curso_por_id($id);

        // Cargar la vista detallada del curso
        $this->load->view('curso_detalle', $data);
    }
}
?>
