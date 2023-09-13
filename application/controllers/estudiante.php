<?php
defined('BASEPATH') or exit('No direct script access allowed');

require FCPATH.'vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Estudiante extends CI_Controller
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
	
	
	public function est()
	{
		
		if($this->session->userdata('login'))
        {
			
			$lista = $this->estudiante_model->listaestudiante();


			$data['estudiante'] = $lista;
			$this->load->view('inc/cabecera');
			$this->load->view('inc/menu');
			$this->load->view('inc/menulateral');
			$this->load->view('est_lista',$data);
			$this->load->view('inc/pie');
        }
        else
        {
            redirect('usuarios/index/2','refresh');
        }
		
		
	}
	public function listaxls()
 {
 $lista=$this->estudiante_model->listaestudiante();
 $lista=$lista->result();

 header('Content-Type: application/vnd.ms-excel');
 header('Content-Disposition: attachment;filename="estudiante.xlsx"');
 $spreadsheet = new Spreadsheet();
 $sheet = $spreadsheet->getActiveSheet();
 $sheet->setCellValue('A1', 'ID');
 $sheet->setCellValue('B1', 'Nombre');
 $sheet->setCellValue('C1', 'Primer apellido');
 $sheet->setCellValue('D1', 'Segundo apellido');
 $sheet->setCellValue('E1', 'carrera');
 $sn=2;
 foreach ($lista as $row) {
 $sheet->setCellValue('A'.$sn,$row->id);
 $sheet->setCellValue('B'.$sn,$row->nombre);
 $sheet->setCellValue('C'.$sn,$row->primerApellido);
 $sheet->setCellValue('D'.$sn,$row->segundoApellido);
 $sheet->setCellValue('E'.$sn,$row->carrera);
 $sn++;
 }
 $writer = new Xlsx($spreadsheet);
 $writer->save("php://output");
 }


	public function listapdf()
	{
		if($this->session->userdata('login'))
        {
			
			$lista = $this->estudiante_model->listaestudiante();
			$lista =$lista->result();

			$this->pdf=new pdf();
			$this->pdf->AddPage();
			$this->pdf->AliasNbPages();
			$this->pdf->SetTitle("lista de estudiantes");
			
			$this->pdf->SetLeftMargin(15);
			$this->pdf->SetRightMargin(15);
			$this->pdf->SetFillColor(210,210,210);//RGB
			$this->pdf->SetFont('Arial','B',11);

			$this->pdf->Ln(5);
			$this->pdf->Cell(30);
			$this->pdf->Cell(120,10,'LISTA DE ESTUDIANTES',0,0,'C',1);

			//ANCHO,ALTO,TEXT,BORDE GENERACION DE LA SIQUIENTE CELDA
			//0 DERECHA ,1 SIGUIENTE LINESA, 2 DEBAJO
			//ALINEACION LCR , FILL 0 1



			$this->pdf->Ln(15);
			$this->pdf->SetFont('Arial','',9);


			$this->pdf->Cell(3);
			$this->pdf->Cell(7,5,'No','TBLR',0,'L',0);
			$this->pdf->Cell(50,5,'NOMBRE','TBLR',0,'L',0);
			$this->pdf->Cell(30,5,'PRIMER APELLIDO','TBLR',0,'L',0);
			$this->pdf->Cell(35,5,'SEGUNDO APELLIDO','TBLR',0,'L',0);
			$this->pdf->Cell(30,5,'CARRERA','TBLR',0,'L',0);
			$this->pdf->Cell(35,5,'FECHA DE NACIMIENTO','TBLR',0,'L',0);
			$this->pdf->Cell(30,5,'DIRECCION','TBLR',0,'L',0);
			//$this->pdf->Cell(30,5,'DIRECCION','TBLR',0,'L',0);
			$this->pdf->Ln(5);

			$num=1;
			foreach($lista as $row)
			{
				
				$nombre=$row->nombre;
				$primerApellido=$row->primerApellido;
				$segundoApellido=$row->segundoApellido;
				$carrera=$row->carrera;
				$fechaNacimiento=$row->fechaNacimiento;
				$direccion=$row->direccion;
				


				$this->pdf->Cell(3);
				$this->pdf->Cell(7,5,$num,'TBLR',0,'L',0);
				$this->pdf->Cell(50,5,$nombre,'TBLR',0,'L',0);
				$this->pdf->Cell(30,5,$primerApellido,'TBLR',0,'L',0);
				$this->pdf->Cell(35,5,$segundoApellido,'TBLR',0,'L',0);
				$this->pdf->Cell(30,5,$carrera,'TBLR',0,'L',0);
				$this->pdf->Cell(35,5,$fechaNacimiento,'TBLR',0,'L',0);
				$this->pdf->Cell(30,5,$direccion,'TBLR',0,'L',0);
				//$this->pdf->Cell(30,5,$direccion,'TBLR',0,'L',0);
				$this->pdf->Ln(5);
				$num++;
			}


			$this->pdf->Output("lista estudiantes.pdf","I");




			$data['estudiante'] = $lista;
			$this->load->view('inc/cabecera');
			$this->load->view('inc/menu');
			$this->load->view('inc/menulateral');
			$this->load->view('est_lista',$data);
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
		$this->load->view('est_formulario');
		$this->load->view('inc/pie');
	}
	public function agregarbd()
	{
		$data['nombre'] = $_POST['nombre'];
		$data['primerApellido'] = $_POST['primerApellido'];
		$data['segundoApellido'] = $_POST['segundoApellido'];
		$data['carrera'] = $_POST['carrera'];
		$data['fechaNacimiento'] = $_POST['fechaNac'];
		
		$data['direccion'] = $_POST['direccion'];
		

		$this->estudiante_model->agregarestudiante($data);
		redirect('estudiante/est', 'refresh');
	}
	public function modificar()
	{
		$idestudiante = $_POST['idestudiante'];
		$data['infoestudiante'] = $this->estudiante_model->recuperarestudiante($idestudiante);
		$this->load->view('inc/cabecera');
		$this->load->view('inc/menu');
		$this->load->view('inc/menulateral');
		$this->load->view('est_modificar',$data);
		$this->load->view('inc/pie');
	}
	public function modificarbd()
	{
		$idestudiante = $_POST['idestudiante'];
        $data['nombre'] = $_POST['nombre'];
		$data['primerApellido'] = $_POST['primerApellido'];
		$data['segundoApellido'] = $_POST['segundoApellido'];
		$data['carrera'] = $_POST['carrera'];
		$data['fechaNacimiento'] = $_POST['fechaNac'];
		$data['direccion'] = $_POST['direccion'];

		$this->estudiante_model->modificarestudiante($idestudiante,$data);
		redirect('estudiante/est', 'refresh');
	}


	public function eliminarbd()
	{
		$idestudiante = $_POST['idestudiante'];
		$this->estudiante_model->eliminarestudiante($idestudiante);
		redirect('estudiante/est', 'refresh');
	}
	public function deshabilitarbd()
	{
		$idestudiante = $_POST['idestudiante'];
		$data['estado']='0';


		$this->estudiante_model->modificarestudiante($idestudiante,$data);
		redirect('estudiante/est', 'refresh');

	}
	public function habilitarbd()
	{
		$idestudiante = $_POST['idestudiante'];
		$data['estado']='1';


		$this->estudiante_model->modificarestudiante($idestudiante,$data);
		redirect('estudiante/deshabilitados', 'refresh');

	}
	public function deshabilitados()
	{
		$lista = $this->estudiante_model->listaestudiantedes();
		$data['estudiante'] = $lista;
		$this->load->view('inc/cabecera');
		$this->load->view('inc/menu');
		$this->load->view('inc/menulateral');
		$this->load->view('est_listades',$data);
		$this->load->view('inc/pie');
	}

	public function invitado()
	{
		

		if($this->session->userdata('login'))
		{
			$this->load->view('inc/cabecera');
			$this->load->view('inc/menu');
			$this->load->view('inc/menulateral');
			$this->load->view('est_invitado');
			$this->load->view('inc/pie');
		}
		else
		{
			redirect('usuarios/index/2', 'refresh');
		}
		
		
	}
	public function subirfoto()
	{
		$data['id']=$_POST['idestudiante'];
		$this->load->view('inc/cabecera');
		$this->load->view('inc/menu');
		$this->load->view('inc/menulateral');
		$this->load->view('subirformest',$data);
		$this->load->view('inc/pie');
	}
	public function subir()
	{
		$idestud=$_POST['idEstudiante'];
		$nombrearchivo=$idestud.".jpg";

		$config['upload_path']='./uploads/estudiantes/';
		
		$config['file_name']=$nombrearchivo;
		
		$direccion="./uploads/estudiantes/".$nombrearchivo;

		if(file_exists($direccion))
		{
		 unlink($direccion);
		}

		$config['allowed_types']='jpg|png|mp4';

		$this->load->library('upload',$config);

		if(!$this->upload->do_upload())
		{
		 $data['error']=$this->upload->display_errors();
		}
		else
		{
		 $data['foto']=$nombrearchivo;
		 $this->estudiante_model->modificarestudiante($idestud,$data);
		 $this->upload->data();
			
		}
		redirect('estudiante/est', 'refresh');



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
