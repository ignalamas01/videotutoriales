<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Cursos extends CI_Controller
{
	public function index()
	{
		if($this->session->userdata('login'))
        {
			$this->load->view('inc/cabecera');
			$this->load->view('inc/menu');
			$this->load->view('inc/menulateral');
			$this->load->view('inicio');
			$this->load->view('inc/pie');
        }
        else
        {
            redirect('usuarios/index/2','refresh');
        }
		
	}
	
	public function cursos()
	{
		
		if($this->session->userdata('login'))
        {
			//$lista=$this->empleado_model->listaempleados();
			$lista = $this->cursos_model->listacursos();


			$data['cursos'] = $lista;
			$this->load->view('inc/cabecera');
			$this->load->view('inc/menu');
			$this->load->view('inc/menulateral');
			$this->load->view('cursos_lista',$data);
			$this->load->view('inc/pie');
        }
        else
        {
            redirect('usuarios/index/2','refresh');
        }
		
		
	}
	public function listapdf()
	{
		if($this->session->userdata('login'))
        {
			
			$lista = $this->empleado_model->listaempleados();
			$lista =$lista->result();

			$this->pdf=new pdf();
			$this->pdf->AddPage();
			$this->pdf->AliasNbPages();
			$this->pdf->SetTitle("lista de empleados");
			
			$this->pdf->SetLeftMargin(15);
			$this->pdf->SetRightMargin(15);
			$this->pdf->SetFillColor(210,210,210);//RGB
			$this->pdf->SetFont('Arial','B',11);

			$this->pdf->Ln(5);
			$this->pdf->Cell(30);
			$this->pdf->Cell(120,10,'LISTA DE EMPLEADOS',0,0,'C',1);

			//ANCHO,ALTO,TEXT,BORDE GENERACION DE LA SIQUIENTE CELDA
			//0 DERECHA ,1 SIGUIENTE LINESA, 2 DEBAJO
			//ALINEACION LCR , FILL 0 1



			$this->pdf->Ln(10);
			$this->pdf->SetFont('Arial','',9);


			$this->pdf->Cell(30);
			$this->pdf->Cell(7,5,'No','TBLR',0,'L',0);
			$this->pdf->Cell(50,5,'NOMBRE','TBLR',0,'L',0);
			$this->pdf->Cell(30,5,'PRIMER APELLIDO','TBLR',0,'L',0);
			$this->pdf->Cell(35,5,'SEGUNDO APELLIDO','TBLR',0,'L',0);
			$this->pdf->Cell(30,5,'DEPARTAMENTO','TBLR',0,'L',0);
			$this->pdf->Cell(35,5,'FECHA DE NACIMIENTO','TBLR',0,'L',0);
			$this->pdf->Cell(30,5,'TELEFONO','TBLR',0,'L',0);
			$this->pdf->Cell(30,5,'DIRECCION','TBLR',0,'L',0);
			$this->pdf->Ln(5);

			$num=1;
			foreach($lista as $row)
			{
				
				$nombre=$row->nombre;
				$primerApellido=$row->primerApellido;
				$segundoApellido=$row->segundoApellido;
				$departamento=$row->departamento;
				$fechaNacimiento=$row->fechaNacimiento;
				$telefono=$row->telefono;
				$direccion=$row->direccion;


				$this->pdf->Cell(30);
				$this->pdf->Cell(7,5,$num,'TBLR',0,'L',0);
				$this->pdf->Cell(50,5,$nombre,'TBLR',0,'L',0);
				$this->pdf->Cell(30,5,$primerApellido,'TBLR',0,'L',0);
				$this->pdf->Cell(35,5,$segundoApellido,'TBLR',0,'L',0);
				$this->pdf->Cell(30,5,$departamento,'TBLR',0,'L',0);
				$this->pdf->Cell(35,5,$fechaNacimiento,'TBLR',0,'L',0);
				$this->pdf->Cell(30,5,$telefono,'TBLR',0,'L',0);
				$this->pdf->Cell(30,5,$direccion,'TBLR',0,'L',0);
				$this->pdf->Ln(5);
				$num++;
			}


			$this->pdf->Output("lista empleados.pdf","I");




			$data['empleado'] = $lista;
			$this->load->view('inc/cabecera');
			$this->load->view('inc/menu');
			$this->load->view('inc/menulateral');
			$this->load->view('emple_lista',$data);
			$this->load->view('inc/pie');
        }
        else
        {
            redirect('usuarios/index/2','refresh');
        }
		
	}
	

	public function agregar()
	{
		$this->load->view('inc/cabecera');
		$this->load->view('inc/menu');
		$this->load->view('inc/menulateral');
		$this->load->view('cursos_formulario');
		$this->load->view('inc/pie');
	}
	public function agregarbd()
	{
        
		$data['titulo'] = $_POST['titulo'];
		$data['descripcion'] = $_POST['descripcion'];
		$data['video'] = $_POST['video'];
		

		$this->cursos_model->agregarcursos($data);
		redirect('cursos/cursos', 'refresh');
	}
	public function modificar()
	{
		$idcursos = $_POST['idcursos'];
		$data['infocursos'] = $this->cursos_model->recuperarcursos($idcursos);
		$this->load->view('inc/cabecera');
		$this->load->view('inc/menu');
		$this->load->view('inc/menulateral');
		$this->load->view('cursos_modificar',$data);
		$this->load->view('inc/pie');
	}
	public function modificarbd()
	{
		$idcursos = $_POST['idcursos'];
		$data['titulo'] = $_POST['titulo'];
		$data['descripcion'] = $_POST['descripcion'];
		$data['video'] = $_POST['video'];
		
		$this->cursos_model->modificarcursos($idcursos,$data);
		redirect('cursos/cursos', 'refresh');
	}


	public function eliminarbd()
	{
		$idcursos = $_POST['idcursos'];
		$this->cursos_model->eliminarcursos($idcursos);
		redirect('cursos/cursos', 'refresh');
	}
	public function deshabilitarbd()
	{
		$idcursos = $_POST['idcursos'];
		$data['estado']='0';


		$this->cursos_model->modificarcursos($idcursos,$data);
		redirect('cursos/cursos', 'refresh');

	}
	public function habilitarbd()
	{
		$idcursos = $_POST['idcursos'];
		$data['estado']='1';


		$this->cursos_model->modificarcursos($idcursos,$data);
		redirect('cursos/deshabilitados', 'refresh');

	}
	public function deshabilitados()
	{
		$lista = $this->cursos_model->listacursosdes();
		$data['cursos'] = $lista;
		$this->load->view('inc/cabecera');
		$this->load->view('inc/menu');
		$this->load->view('inc/menulateral');
		$this->load->view('cursos_listades',$data);
		$this->load->view('inc/pie');
	}

	public function invitado()
	{
		

		if($this->session->userdata('login'))
		{
			$this->load->view('inc/cabecera');
			$this->load->view('inc/menu');
			$this->load->view('inc/menulateral');
			$this->load->view('emple_invitado');
			$this->load->view('inc/pie');
		}
		else
		{
			redirect('usuarios/index/2', 'refresh');
		}
		
		
	}
	public function subirfoto()
	{
		$data['id']=$_POST['idcursos'];
		$this->load->view('inc/cabecera');
		$this->load->view('inc/menu');
		$this->load->view('inc/menulateral');
		$this->load->view('subirformcursos',$data);
		$this->load->view('inc/pie');
	}
	public function subir()
	{
		$idcurso=$_POST['idCursos'];
		$nombrearchivo=$idcurso.".jpg";

		$config['upload_path']='./uploads/cursos/';
		
		$config['file_name']=$nombrearchivo;
		
		$direccion="./uploads/cursos/".$nombrearchivo;

		if(file_exists($direccion))
		{
		 unlink($direccion);
		}

		$config['allowed_types']='jpg|png';

		$this->load->library('upload',$config);

		if(!$this->upload->do_upload())
		{
		 $data['error']=$this->upload->display_errors();
		}
		else
		{
		 $data['video']=$nombrearchivo;
		 $this->cursos_model->modificarcursos($idcurso,$data);
		 $this->upload->data();
			
		}
		redirect('cursos/cursos', 'refresh');



	}
	public function subir_video()
	{
		 $this->load->view('inc/cabecera');
		 //$this->load->view('inc/menu');
		// $this->load->view('inc/menulateral');
		$this->load->view('subir_video');
		// $this->load->view('inc/pie');
	}
	public function listar_videos()
	{
		$this->load->view('inc/cabecera');
		// $this->load->view('inc/menu');
		// $this->load->view('inc/menulateral');
		$this->load->view('listar_videos');
		// $this->load->view('inc/pie');
	}
	public function ver_videos()
	{
		 $this->load->view('inc/cabecera');
		// $this->load->view('inc/menu');
		// $this->load->view('inc/menulateral');
		$this->load->view('ver_videos');
		// $this->load->view('inc/pie');
	}
	public function mostrar_video()
	{
        
		$this->load->view('inc/cabecera');
		// $this->load->view('inc/menu');
		// $this->load->view('inc/menulateral');
		   $this->load->view('mostrar_video');
		// $this->load->view('inc/pie');
		
	}
	public function editar_video()
	{
        
		//$this->load->view('inc/cabecera');
		// $this->load->view('inc/menu');
		// $this->load->view('inc/menulateral');
		   $this->load->view('editar_video');
		// $this->load->view('inc/pie');
		
	}
	public function eliminar_video()
	{
        
		//$this->load->view('inc/cabecera');
		// $this->load->view('inc/menu');
		// $this->load->view('inc/menulateral');
		   $this->load->view('eliminar_video');
		// $this->load->view('inc/pie');
		
	}
	
	

	







	/* PRUEBA DE CONEXION DE BASE DE DATOS///
	public function pruebabd()
	{
		$query = $this->db->get('empleado');
		$execonsulta = $query->result();
		print_r($execonsulta);
	}
*/
}
