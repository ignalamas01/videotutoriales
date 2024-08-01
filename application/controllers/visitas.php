<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Visitas extends CI_Controller {
public function actualizar_ultima_visita($idEstudiante, $idCurso) {
    // Lógica para actualizar la última visita en el modelo correspondiente
    $this->load->model('visita_model');
    $this->visita_model->actualizar_ultima_visita($idEstudiante, $idCurso);
    
   
}
}
?>
