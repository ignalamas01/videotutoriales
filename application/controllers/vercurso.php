

<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Vercurso extends CI_Controller
{
    public function ver($id)
{
    $tipo = $this->session->userdata('tipo');
			if ($tipo == 'admin') {
				// Cargar la vista para el administrador
				$this->load->view('incadmin/cabecera');
						$this->load->view('incadmin/menu');
						$this->load->view('incadmin/menulateral');
						$this->load->model('vercurso_model');
						// $this->load->view('incadmin/pie');
			} if ($tipo == 'empleado') {
				// Cargar la vista para el empleado
				$this->load->view('inc/cabecera');
				$this->load->view('inc/menu');
				$this->load->view('inc/menulateral');
				$this->load->model('vercurso_model');
				// $this->load->view('inc/pie');
			}
			if ($tipo == 'invitado') {
				// Cargar la vista para el empleado
				$this->load->view('incestudiante/cabecera');
				$this->load->view('incestudiante/menu');
				$this->load->view('incestudiante/menulateral');
				$this->load->model('vercurso_model');
				// $this->load->view('incestudiante/pie');
				
			}
    

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
    $this->load->view('incadmin/pie');
}
}
?>
