<?php
defined('BASEPATH') or exit('No direct script access allowed');

class System extends CI_Controller
{
	public function index()
	{
        $this->load->view('inc/cabecera');
		//$this->load->view('inc/menu');
		//$this->load->view('inc/menulateral');
		$this->load->view('start');
		//$this->load->view('inc/pie');
       

	}

   
}
