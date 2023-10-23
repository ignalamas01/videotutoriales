<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Suscripciones extends CI_Controller
{
	
	public function inscribir()
	{
		
		if($this->session->userdata('login'))
        {
			
			$data['infocursos'] = $this->cursos_model->listaInscritosCursos();


			$this->load->view('inc/cabecera');
			$this->load->view('inc/menu');
			$this->load->view('inc/menulateral');
			$this->load->view('inscribir_formulario',$data);
			$this->load->view('inc/pie');
        }
        else
        {
            redirect('usuarios/index/2','refresh');
        }
		
		
	} public function listaInscritosCursos()
    {
        $this->db->select('*');
        $this->db->from('cursos');
        
        return $this->db->get();
    }
}
