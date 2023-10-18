<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Foros extends CI_Controller
{
	
	public function for()
	{
		 $this->load->view('inc/cabecera');
		 $this->load->view('inc/menu');
		 $this->load->view('inc/menulateral');
		 $this->load->view('foros');
		 $this->load->view('inc/pie');
	}

	

	
}
