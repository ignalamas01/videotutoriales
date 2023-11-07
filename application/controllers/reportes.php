<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Reportes extends CI_Controller
{
	
	public function reportes()
	{
		

		 $this->load->view('inc/cabecera');
		 $this->load->view('inc/menu');
		 $this->load->view('inc/menulateral');
		 $this->load->view('verreporte');
		 $this->load->view('inc/pie');
	}

	
}
