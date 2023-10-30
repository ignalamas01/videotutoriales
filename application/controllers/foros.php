<?php
class Foros extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Foros_model');
        $this->load->helper('form');
    }

    public function for() {
        $this->load->library('form_validation');
    
        // Reglas de validación para el formulario
        $this->form_validation->set_rules('titulo', 'Título', 'required');
        $this->form_validation->set_rules('descripcion', 'Descripción', 'required');
    
        if ($this->form_validation->run() === FALSE) {
            // Mostrar el formulario si no se ha enviado o hay errores de validación
            $this->load->view('inc/cabecera');
            $this->load->view('inc/menu');
            $this->load->view('inc/menulateral');
            $this->load->view('foros');
            $this->load->view('inc/pie');
        } else {
            // Obtener datos del formulario
            $titulo = $this->input->post('titulo');
            $descripcion = $this->input->post('descripcion');
            // Aquí puedes obtener estudiante_id y empleado_id de alguna manera, como a través de la sesión del usuario.
    
            // Llamar al método del modelo para crear el foro
            $idForoCreado = $this->Foros_model->crearForo($titulo, $descripcion, $estudiante_id, $empleado_id);
    
            if ($idForoCreado) {
                // Establecer un mensaje de éxito en flashdata
                $this->session->set_flashdata('alerta', 'El foro se creó correctamente.');
            
                // Redirigir a la página actual
                redirect(current_url());
            } else {
                // Mostrar un mensaje de error
                echo "Error al crear el foro.";
            }
        }
    }
    
    
    // En tu controlador
    public function mostrar_foros() {
    // Obtén la lista de foros desde tu modelo
    $data['foros'] = $this->Foros_model->obtener_foros();

    // Carga la vista y pasa los datos
    $this->load->view('foros', $data);
}


    // Otros métodos del controlador, como listar_foros, pueden ir aquí.

}
