<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Nograduados extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('nograduados_model');
    }

    public function lista() {

        if($this->session->userdata('login'))
		{
        // Llama al método del modelo para obtener los datos de estudiantes no graduados
        $data['estudiantes_no_graduados'] = $this->nograduados_model->obtener_estudiantes_no_graduados();

        // Carga la vista y pasa los datos como un arreglo
        $this->load->view('incadmin/cabecera');
        $this->load->view('incadmin/menu');
        $this->load->view('incadmin/menulateral');
        $this->load->view('nograduados_lista', $data);
        $this->load->view('incadmin/pie');
       
    }
        else
		{
			redirect('usuarios/index/2', 'refresh');
		} 
    }
}
?>

	
