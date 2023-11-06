<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Suscripciones extends CI_Controller
{
	
	public function agregarEstudiante()
	{
		
		if($this->session->userdata('login'))
        {
			
			$this->load->view('inc/cabecera');
			$this->load->view('inc/menu');
			$this->load->view('inc/menulateral');
			// Consulta los datos de la tabla "otra_tabla"
    		$data['cursos'] = $this->cursos_model->listacursos(); // Asumiendo que tienes un método en tu modelo para obtener los datos

    		// Consulta los datos de la tabla "estudiante"
    		$data['estudiante'] = $this->estudiante_model->listaestudiante(); // Asumiendo que tienes un método en tu modelo para obtener los estudiantes

    		// Carga la vista con los datos
    		$this->load->view('inscribirfor', $data);
			$this->load->view('inc/pie');
        }
        else
        {
            redirect('usuarios/index/2','refresh');
        }
		
		
	} 
	public function inscribirbd() {
		$this->load->model('Inscripciones_model');

		// Iniciar la transacción
		$this->db->trans_start();

		if ($this->input->post()) {
			$data = array(
				'idEstudiante' => $this->input->post('id_estudiante'),
				'idCurso' => $this->input->post('id_curso'),
				'fechaInicio' => $this->input->post('fechaInicio'),  // Agregar fecha de inicio
				'fechaFin' => $this->input->post('fechaFin')  // Agregar fecha de fin
			);
	
			$inscripcion_id = $this->Inscripciones_model->insertar_inscripcion($data);
			
			// Realiza acciones adicionales si es necesario

			// Obtén el nombre del curso para mostrarlo en el mensaje
			if ($inscripcion_id) {
				// Inscripción exitosa, obtén el nombre del curso
				$curso = $this->Inscripciones_model->obtener_curso_por_id($data['idCurso']);
				$nombre_curso = $curso->titulo;
	
				$mensaje = "El estudiante ha sido inscrito correctamente en el curso: " . $nombre_curso;
			} else {
				// Error en la inscripción
				$mensaje = "Hubo un error al inscribir al estudiante en el curso.";
			}

			// Finalizar la transacción
			$this->db->trans_complete();

			if ($this->db->trans_status() === FALSE) {
				// Ocurrió un error en la transacción
				$mensaje = "Error en la transacción. La inscripción no se completó.";
			}
	
			// Carga la vista con el mensaje de inscripción
			// $data['mensaje'] = $mensaje;
			// $this->load->view('mensaje_inscripcion', $data);
			 // Almacena el mensaje en la sesión
			 $this->session->set_flashdata('mensaje', $mensaje);

			 // Redirige a la vista agregarEstudiante
			 redirect('suscripciones/agregarEstudiante');
		}
	}


	
	
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
						$this->load->view('suscritos_lista',$data);
						$this->load->view('incadmin/pie');
			} if ($tipo == 'empleado') {
				// Cargar la vista para el empleado
				$this->load->view('inc/cabecera');
				$this->load->view('inc/menu');
				$this->load->view('inc/menulateral');
				$this->load->view('suscritos_lista',$data);
				$this->load->view('inc/pie');
	
			} 
			if ($tipo == 'invitado') {
				// Cargar la vista para el empleado
				$this->load->view('incestudiante/cabecera');
				$this->load->view('incestudiante/menu');
				$this->load->view('incestudiante/menulateral');
				$this->load->view('suscritos_lista',$data);
				$this->load->view('inc/pie');
				
				
			}
        }
        else
        {
            redirect('usuarios/index/2','refresh');
        }
		
		
	}
	
	
	
	

	
	
// 	public function listaxls()
//  {
//  $lista=$this->Inscripciones_model->listainscri();
//  $lista=$lista->result();

//  header('Content-Type: application/vnd.ms-excel');
//  header('Content-Disposition: attachment;filename="inscritos.xlsx"');
//  $spreadsheet = new Spreadsheet();
//  $sheet = $spreadsheet->getActiveSheet();
//  $sheet->setCellValue('A1', 'ID');
//  $sheet->setCellValue('B1', 'Nombre');
//  $sheet->setCellValue('C1', 'Primer apellido');
//  $sheet->setCellValue('D1', 'Segundo apellido');
//  $sheet->setCellValue('E1', 'carrera');
//  $sn=2;
//  foreach ($lista as $row) {
//  $sheet->setCellValue('A'.$sn,$row->id);
//  $sheet->setCellValue('B'.$sn,$row->nombre);
//  $sheet->setCellValue('C'.$sn,$row->primerApellido);
//  $sheet->setCellValue('D'.$sn,$row->segundoApellido);
//  $sheet->setCellValue('E'.$sn,$row->carrera);
//  $sn++;
//  }
//  $writer = new Xlsx($spreadsheet);
//  $writer->save("php://output");
//  }


// 	public function listapdf()
// 	{
// 		if($this->session->userdata('login'))
//         {
			
// 			$lista = $this->estudiante_model->listaestudiante();
// 			$lista =$lista->result();

// 			$this->pdf=new pdf();
// 			$this->pdf->AddPage();
// 			$this->pdf->AliasNbPages();
// 			$this->pdf->SetTitle("lista de estudiantes");
			
// 			$this->pdf->SetLeftMargin(15);
// 			$this->pdf->SetRightMargin(15);
// 			$this->pdf->SetFillColor(210,210,210);//RGB
// 			$this->pdf->SetFont('Arial','B',11);

// 			$this->pdf->Ln(5);
// 			$this->pdf->Cell(30);
// 			$this->pdf->Cell(120,10,'LISTA DE ESTUDIANTES',0,0,'C',1);

// 			//ANCHO,ALTO,TEXT,BORDE GENERACION DE LA SIQUIENTE CELDA
// 			//0 DERECHA ,1 SIGUIENTE LINESA, 2 DEBAJO
// 			//ALINEACION LCR , FILL 0 1



// 			$this->pdf->Ln(15);
// 			$this->pdf->SetFont('Arial','',9);


// 			$this->pdf->Cell(3);
// 			$this->pdf->Cell(7,5,'No','TBLR',0,'L',0);
// 			$this->pdf->Cell(50,5,'NOMBRE','TBLR',0,'L',0);
// 			$this->pdf->Cell(30,5,'PRIMER APELLIDO','TBLR',0,'L',0);
// 			$this->pdf->Cell(35,5,'SEGUNDO APELLIDO','TBLR',0,'L',0);
// 			$this->pdf->Cell(30,5,'CARRERA','TBLR',0,'L',0);
// 			$this->pdf->Cell(35,5,'FECHA DE NACIMIENTO','TBLR',0,'L',0);
// 			$this->pdf->Cell(30,5,'DIRECCION','TBLR',0,'L',0);
// 			//$this->pdf->Cell(30,5,'DIRECCION','TBLR',0,'L',0);
// 			$this->pdf->Ln(5);

// 			$num=1;
// 			foreach($lista as $row)
// 			{
				
// 				$nombre=$row->nombre;
// 				$primerApellido=$row->primerApellido;
// 				$segundoApellido=$row->segundoApellido;
// 				$carrera=$row->carrera;
// 				$fechaNacimiento=$row->fechaNacimiento;
// 				$direccion=$row->direccion;
				


// 				$this->pdf->Cell(3);
// 				$this->pdf->Cell(7,5,$num,'TBLR',0,'L',0);
// 				$this->pdf->Cell(50,5,$nombre,'TBLR',0,'L',0);
// 				$this->pdf->Cell(30,5,$primerApellido,'TBLR',0,'L',0);
// 				$this->pdf->Cell(35,5,$segundoApellido,'TBLR',0,'L',0);
// 				$this->pdf->Cell(30,5,$carrera,'TBLR',0,'L',0);
// 				$this->pdf->Cell(35,5,$fechaNacimiento,'TBLR',0,'L',0);
// 				$this->pdf->Cell(30,5,$direccion,'TBLR',0,'L',0);
// 				//$this->pdf->Cell(30,5,$direccion,'TBLR',0,'L',0);
// 				$this->pdf->Ln(5);
// 				$num++;
// 			}


// 			$this->pdf->Output("lista estudiantes.pdf","I");




// 			$data['suscripciones'] = $lista;
// 			$this->load->view('inc/cabecera');
// 			$this->load->view('inc/menu');
// 			$this->load->view('inc/menulateral');
// 			$this->load->view('suscritos_lista',$data);
// 			$this->load->view('inc/pie');
//         }
//         else
//         {
//             redirect('usuarios/index/2','refresh');
//         }
		
// 	}
	
	
		
    		
		


}
