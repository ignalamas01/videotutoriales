<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Graduados extends CI_Controller
{
	
	
	public function lista()
	{
		
		if($this->session->userdata('login'))
        {
			
			 $lista = $this->inscripciones_model->listainscritos();
			 $tipo = $this->session->userdata('tipo');

			$data['estudiante'] = $lista;
			//  $this->load->view('inc/cabecera');
			//  $this->load->view('inc/menu');
			//  $this->load->view('inc/menulateral');
			//  $this->load->view('suscritos_lista',$data);
			//  $this->load->view('inc/pie');
			if ($tipo == 'admin') {
				// Cargar la vista para el administrador
						$this->load->view('incadmin/cabecera');
						$this->load->view('incadmin/menu');
						$this->load->view('incadmin/menulateral');
						$this->load->view('graduados_lista',$data);
						$this->load->view('incadmin/pie');
			} if ($tipo == 'empleado') {
				// Cargar la vista para el empleado
				$this->load->view('inc/cabecera');
				$this->load->view('inc/menu');
				$this->load->view('inc/menulateral');
				$this->load->view('graduados_lista',$data);
				$this->load->view('inc/pie');
	
			} 
			if ($tipo == 'invitado') {
				// Cargar la vista para el empleado
				$this->load->view('incestudiante/cabecera');
				$this->load->view('incestudiante/menu');
				$this->load->view('incestudiante/menulateral');
				$this->load->view('graduados_lista',$data);
				$this->load->view('inc/pie');
				
				
			}
        }
        else
        {
            redirect('usuarios/index/2','refresh');
        }
		
		
	}
	
} 