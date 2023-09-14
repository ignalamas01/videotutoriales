<?php
defined('BASEPATH') or exit('No direct script access allowed');

// require FCPATH.'vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Base extends CI_Controller
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
	public function res()
	{

		$this->load->view('inc/cabecera');
		$this->load->view('inc/menu');
		$this->load->view('inc/menulateral');
		$this->load->view('resumen');
		$this->load->view('inc/pie');
	}
	public function obj()
	{
		$this->load->view('inc/cabecera');
		$this->load->view('inc/menu');
		$this->load->view('inc/menulateral');
		$this->load->view('objetivos');
		$this->load->view('inc/pie');
	}
	
	public function emple()
	{
		
		if($this->session->userdata('login'))
        {
			//$lista=$this->empleado_model->listaempleados();
			$lista = $this->empleado_model->listaempleados();


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
	public function listaxls()
	{
	  $lista=$this->empleado_model->listaempleados();
	  $lista=$lista->result();
   
	  header('Content-Type: application/vnd.ms-excel');
	  header('Content-Disposition: attachment;filename="empleados.xlsx"');
	  $spreadsheet = new Spreadsheet();
	  $sheet = $spreadsheet->getActiveSheet();
	  $sheet->setCellValue('A1', 'ID');
	  $sheet->setCellValue('B1', 'Nombre');
	  $sheet->setCellValue('C1', 'Primer apellido');
	  $sheet->setCellValue('D1', 'Segundo apellido');
	  $sheet->setCellValue('E1', 'departamento');
	  $sheet->setCellValue('F1', 'fechaNacimiento');
	  $sheet->setCellValue('G1', 'telefono');
	  $sheet->setCellValue('H1', 'direccion');
	  $sheet->setCellValue('I1', 'fecha de registro');
	  
	  $sn=2;
	  foreach ($lista as $row) {
	  $sheet->setCellValue('A'.$sn,$row->id);
	  $sheet->setCellValue('B'.$sn,$row->nombre);
	  $sheet->setCellValue('C'.$sn,$row->primerApellido);
	  $sheet->setCellValue('D'.$sn,$row->segundoApellido);
	  $sheet->setCellValue('E'.$sn,$row->departamento);
	  $sheet->setCellValue('F'.$sn,$row->fechaNacimiento);
	  $sheet->setCellValue('G'.$sn,$row->telefono);
	  $sheet->setCellValue('H'.$sn,$row->direccion);
	  $sheet->setCellValue('I'.$sn,$row->fechaRegistro);
	 
	  $sn++;
	  }
	  $writer = new Xlsx($spreadsheet);
	  $writer->save("php://output");
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
		$this->load->view('emple_formulario');
		$this->load->view('inc/pie');
	}
	public function agregarbd()
	{
		$data['nombre'] = $_POST['nombre'];
		$data['primerApellido'] = $_POST['primerApellido'];
		$data['segundoApellido'] = $_POST['segundoApellido'];
		$data['departamento'] = $_POST['departamento'];
		$data['fechaNacimiento'] = $_POST['fechaNac'];
		$data['telefono'] = $_POST['telefono'];
		$data['direccion'] = $_POST['direccion'];

		$this->empleado_model->agregarempleado($data);
		redirect('base/emple', 'refresh');
	}
	public function modificar()
	{
		$idempleado = $_POST['idempleado'];
		$data['infoempleado'] = $this->empleado_model->recuperarempleado($idempleado);
		$this->load->view('inc/cabecera');
		$this->load->view('inc/menu');
		$this->load->view('inc/menulateral');
		$this->load->view('emple_modificar',$data);
		$this->load->view('inc/pie');
	}
	public function modificarbd()
	{
		$idempleado = $_POST['idempleado'];
		$data['nombre'] = $_POST['nombre'];
		$data['primerApellido'] = $_POST['primerApellido'];
		$data['segundoApellido'] = $_POST['segundoApellido'];
		$data['departamento'] = $_POST['departamento'];
		$data['fechaNacimiento'] = $_POST['fechaNac'];
		$data['telefono'] = $_POST['telefono'];
		$data['direccion'] = $_POST['direccion'];
		$this->empleado_model->modificarempleado($idempleado,$data);
		redirect('base/emple', 'refresh');
	}


	public function eliminarbd()
	{
		$idempleado = $_POST['idempleado'];
		$this->empleado_model->eliminarempleado($idempleado);
		redirect('base/emple', 'refresh');
	}
	public function deshabilitarbd()
	{
		$idempleado = $_POST['idempleado'];
		$data['estado']='0';


		$this->empleado_model->modificarempleado($idempleado,$data);
		redirect('base/emple', 'refresh');

	}
	public function habilitarbd()
	{
		$idempleado = $_POST['idempleado'];
		$data['estado']='1';


		$this->empleado_model->modificarempleado($idempleado,$data);
		redirect('base/deshabilitados', 'refresh');

	}
	public function deshabilitados()
	{
		$lista = $this->empleado_model->listaempleadosdes();
		$data['empleado'] = $lista;
		$this->load->view('inc/cabecera');
		$this->load->view('inc/menu');
		$this->load->view('inc/menulateral');
		$this->load->view('emple_listades',$data);
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
		$data['id']=$_POST['idempleado'];
		$this->load->view('inc/cabecera');
		$this->load->view('inc/menu');
		$this->load->view('inc/menulateral');
		$this->load->view('subirform',$data);
		$this->load->view('inc/pie');
	}
	public function subir()
	{
		$idemple=$_POST['idEmpleado'];
		$nombrearchivo=$idemple.".jpg";

		$config['upload_path']='./uploads/empleados/';
		
		$config['file_name']=$nombrearchivo;
		
		$direccion="./uploads/empleados/".$nombrearchivo;

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
		 $data['foto']=$nombrearchivo;
		 $this->empleado_model->modificarempleado($idemple,$data);
		 $this->upload->data();
			
		}
		redirect('base/emple', 'refresh');



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
