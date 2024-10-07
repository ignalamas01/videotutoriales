<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MenuLateral {

    protected $ci;

    public function __construct() {
        // Obtenemos una instancia de CodeIgniter para poder acceder a sus recursos
        $this->ci =& get_instance();
    }

    public function cargar_menu_lateral() {
        // Obtenemos el ID del usuario desde la sesión
        $idUsuario = $this->ci->session->userdata('idusuario');

        // Cargamos los modelos necesarios
        $this->ci->load->model('empleado_model');
        $this->ci->load->model('estudiante_model');

        // Obtenemos los datos del empleado o estudiante
        $data['empleado'] = $this->ci->empleado_model->obtener_empleado_por_usuario($idUsuario);
        $data['estudiante'] = $this->ci->estudiante_model->obtener_estudiante_por_usuario($idUsuario);

        // Cargamos la vista del menú lateral
        $this->ci->load->view('incestudiante/menulateral', $data);
    }
    public function cargar_menu_lateral_profe() {
        // Obtenemos el ID del usuario desde la sesión
        $idUsuario = $this->ci->session->userdata('idusuario');

        // Cargamos los modelos necesarios
        $this->ci->load->model('empleado_model');
        $this->ci->load->model('estudiante_model');

        // Obtenemos los datos del empleado o estudiante
        $data['empleado'] = $this->ci->empleado_model->obtener_empleado_por_usuario($idUsuario);
        $data['estudiante'] = $this->ci->estudiante_model->obtener_estudiante_por_usuario($idUsuario);

        // Cargamos la vista del menú lateral
        $this->ci->load->view('inc/menulateral', $data);
    }
}
