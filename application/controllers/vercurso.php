

<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Vercurso extends CI_Controller
{
    public function ver($id)
{
    $this->load->model('vercurso_model');

    // Obtener detalles del curso
    $data['curso'] = $this->vercurso_model->obtener_curso_por_id($id);

    if ($data['curso']) {
        // Obtener secciones del curso
        $data['secciones'] = $this->vercurso_model->obtener_secciones_por_curso($data['curso']->id);

        // Puedes agregar más datos aquí según sea necesario

        // Cargar la vista detallada del curso
        $this->load->view('curso_detalle', $data);
    } else {
        // Manejar el caso donde el curso no se encuentra
        $this->load->view('curso_no_encontrado');
    }
}
}
?>
