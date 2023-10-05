<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Usuarios extends CI_Controller
{
	public function index()
	{
		
        if($this->session->userdata('login'))
        {
            redirect('usuarios/panel','refresh');
        }
        else
        {
			$data['msg']=$this->uri->segment(3);
            $this->load->view('login',$data);          
        }

	}
    public function validarusuario()
    {
        $login=$_POST['login'];
        $password=md5($_POST['password']);
        $consulta=$this->usuario_model->validar($login,$password);
        if($consulta->num_rows()>0)
        {
            foreach($consulta->result() as $row )
            {
                $this->session->set_userdata('idusuario',$row->idUsuario);
                $this->session->set_userdata('login',$row->login);
                $this->session->set_userdata('tipo',$row->tipo);
                redirect('usuarios/panel','refresh');

            }

        }
        else
        {
        	redirect('usuarios/index/1','refresh');
        }
    }

    public function panel()
    {

        if($this->session->userdata('login'))
        {
			$tipo=$this->session->userdata('tipo');
			if($tipo=='admin')
			{
			 redirect('base/index','refresh');
			}
			else
			{
				redirect('base/invitado','refresh');	
			}
           
        }
        else
        {
            redirect('usuarios/index/2','refresh');
        }
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('usuarios/index/3','refresh');
    }
	public function recuperarcontra()
	{
		//$this->load->view('inc/cabecera');
		//$this->load->view('inc/menu');
		//$this->load->view('inc/menulateral');
		$this->load->view('recuperarcont');
		//$this->load->view('inc/pie');
	}




	
	// public function res()
	// {
	// 	$this->load->view('inc/cabecera');
	// 	$this->load->view('inc/menu');
	// 	$this->load->view('inc/menulateral');
	// 	$this->load->view('resumen');
	// 	$this->load->view('inc/pie');
	// }
	// public function obj()
	// {
	// 	$this->load->view('inc/cabecera');
	// 	$this->load->view('inc/menu');
	// 	$this->load->view('inc/menulateral');
	// 	$this->load->view('objetivos');
	// 	$this->load->view('inc/pie');
	// }
	// public function salu()
	// {
	// 	$this->load->view('inc/cabecera');
	// 	$this->load->view('inc/menu');
	// 	$this->load->view('inc/menulateral');
	// 	$this->load->view('saludo');
	// 	$this->load->view('inc/pie');
	// }
	// public function emple()
	// {
	// 	//$lista=$this->empleado_model->listaempleados();
	// 	$lista = $this->empleado_model->listaempleados();
	// 	$data['empleado'] = $lista;
	// 	$this->load->view('inc/cabecera');
	// 	$this->load->view('inc/menu');
	// 	$this->load->view('inc/menulateral');
	// 	$this->load->view('emple_lista', $data);
	// 	$this->load->view('inc/pie');
	// }
	// public function agregar()
	// {
	// 	$this->load->view('inc/cabecera');
	// 	$this->load->view('inc/menu');
	// 	$this->load->view('inc/menulateral');
	// 	$this->load->view('emple_formulario');
	// 	$this->load->view('inc/pie');
	// }
	// public function agregarbd()
	// {
	// 	$data['nombre'] = $_POST['nombre'];
	// 	$data['primerApellido'] = $_POST['primerApellido'];
	// 	$data['segundoApellido'] = $_POST['segundoApellido'];
	// 	$data['departamento'] = $_POST['departamento'];
	// 	$data['fechaNacimiento'] = $_POST['fechaNac'];
	// 	$data['telefono'] = $_POST['telefono'];
	// 	$data['direccion'] = $_POST['direccion'];

	// 	$this->empleado_model->agregarempleado($data);
	// 	redirect('base/emple', 'refresh');
	// }
	// public function modificar()
	// {
	// 	$idempleado = $_POST['idempleado'];
	// 	$data['infoempleado'] = $this->empleado_model->recuperarempleado($idempleado);
	// 	$this->load->view('inc/cabecera');
	// 	$this->load->view('inc/menu');
	// 	$this->load->view('inc/menulateral');
	// 	$this->load->view('emple_modificar', $data);
	// 	$this->load->view('inc/pie');
	// }
	// public function modificarbd()
	// {
	// 	$idempleado = $_POST['idempleado'];
	// 	$data['nombre'] = $_POST['nombre'];
	// 	$data['primerApellido'] = $_POST['primerApellido'];
	// 	$data['segundoApellido'] = $_POST['segundoApellido'];
	// 	$data['departamento'] = $_POST['departamento'];
	// 	$data['fechaNacimiento'] = $_POST['fechaNac'];
	// 	$data['telefono'] = $_POST['telefono'];
	// 	$data['direccion'] = $_POST['direccion'];
	// 	$this->empleado_model->modificarempleado($idempleado, $data);
	// 	redirect('base/emple', 'refresh');
	// }


	// public function eliminarbd()
	// {
	// 	$idempleado = $_POST['idempleado'];
	// 	$this->empleado_model->eliminarempleado($idempleado);
	// 	redirect('base/emple', 'refresh');
	// }
	// public function deshabilitarbd()
	// {
	// 	$idempleado = $_POST['idempleado'];
	// 	$data['estado']='0';


	// 	$this->empleado_model->modificarempleado($idempleado, $data);
	// 	redirect('base/emple', 'refresh');

	// }
	// public function habilitarbd()
	// {
	// 	$idempleado = $_POST['idempleado'];
	// 	$data['estado']='1';


	// 	$this->empleado_model->modificarempleado($idempleado, $data);
	// 	redirect('base/deshabilitados', 'refresh');

	// }
	// public function deshabilitados()
	// {
	// 	$lista = $this->empleado_model->listaempleadosdes();
	// 	$data['empleado'] = $lista;
	// 	$this->load->view('inc/cabecera');
	// 	$this->load->view('inc/menu');
	// 	$this->load->view('inc/menulateral');
	// 	$this->load->view('emple_listades', $data);
	// 	$this->load->view('inc/pie');
	// }



	/* PRUEBA DE CONEXION DE BASE DE DATOS///
	public function pruebabd()
	{
		$query = $this->db->get('empleado');
		$execonsulta = $query->result();
		print_r($execonsulta);
	}
*/
}
