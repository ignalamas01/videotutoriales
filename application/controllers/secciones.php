<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Secciones extends CI_Controller
{
	
	public function seccion()
	{
		 $this->load->view('inc/cabecera');
		 $this->load->view('inc/menu');
		 $this->load->view('inc/menulateral');
		 $this->load->view('secciones');
		 $this->load->view('inc/pie');
	}

	
}
