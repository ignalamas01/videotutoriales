<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Comentarios extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Comentarios_model');
    }

    public function guardar_comentario() {
        
        
        // Obtener los datos del formulario
        $idForo = $this->input->post('idForo'); // Asegúrate de tener una entrada oculta con el ID del foro
        $idUsuario = $this->input->post('idUsuario'); // Asegúrate de tener una entrada oculta con el ID del usuario
        $contenido = $this->input->post('contenido');
    
        // Cargar el modelo de comentarios
        $this->load->model('Comentarios_model');
        

        $idUsuario = $this->session->userdata('idusuario');
    
        // Llamar al método del modelo para crear el comentario
        $comentarioId = $this->Comentarios_model->crearComentario($idForo, $idUsuario, $contenido);
    
        if ($comentarioId) {
            // El comentario se guardó con éxito
            // Realizar acciones adicionales si es necesario
            redirect('foros'); // Redirigir a la página de foros u otra página apropiada
        } else {
            // Error al guardar el comentario
            // Manejar el error apropiadamente
        }
    }
    
}
