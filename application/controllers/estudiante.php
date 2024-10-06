<?php
defined('BASEPATH') or exit('No direct script access allowed');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require FCPATH.'vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Estudiante extends CI_Controller
{
	// public function index()
	// {
	// 	if($this->session->userdata('login'))
    //     {
	// 		$this->load->view('incestudiante/cabecera');
	// 		$this->load->view('incestudiante/menu');
	// 		$this->load->view('incestudiante/menulateral');
	// 		$this->load->view('inicio');
	// 		$this->load->view('incestudiante/pie');
    //     }
    //     else
    //     {
    //         redirect('usuarios/index/2','refresh');
    //     }
		
	// }
	public function index()
{
    if ($this->session->userdata('login')) {
        // Obtener idUsuario de la sesión, si está disponible
        $idUsuario = $this->session->userdata('idUsuario');

        // Consultar los datos del estudiante
        $data['estudiante'] = $this->Estudiante_model->getEstudianteByUsuario($idUsuario);

        // Cargar las vistas
        $this->load->view('incestudiante/cabecera');
        $this->load->view('incestudiante/menu');
        $this->load->view('incestudiante/menulateral', $data); // Pasar los datos del estudiante aquí
        $this->load->view('inicio');
        $this->load->view('incestudiante/pie');
    } else {
        // redirect('usuarios/index/2', 'refresh');
    }
}

	
	public function est()
	{
		
		if($this->session->userdata('login'))
        {
			
			$lista = $this->estudiante_model->listaestudiante();


			$data['estudiante'] = $lista;
			$this->load->view('incadmin/cabecera');
			$this->load->view('incadmin/menu');
			$this->load->view('incadmin/menulateral');
			$this->load->view('est_lista',$data);
			$this->load->view('incadmin/pie');
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
	
	// public function agregar()
	// {
	// 	$this->load->view('incadmin/cabecera');
	// 	$this->load->view('incadmin/menu');
	// 	$this->load->view('incadmin/menulateral');
	// 	$this->load->view('est_formulario');
	// 	$this->load->view('incadmin/pie');
	// }
	public function agregar()
{
    
        $this->load->view('incadmin/cabecera');
        $this->load->view('incadmin/menu');
        $this->load->view('incadmin/menulateral');
        $this->load->view('est_formulario');
        $this->load->view('incadmin/pie');
   
}


	// public function agregarbd()
	// {
		// $data['nombre'] = $_POST['nombre'];
		// $data['primerApellido'] = $_POST['primerApellido'];
		// $data['segundoApellido'] = $_POST['segundoApellido'];
		// $data['carrera'] = $_POST['carrera'];
		// $data['fechaNacimiento'] = $_POST['fechaNac'];
		
		// $data['direccion'] = $_POST['direccion'];
		

		// $this->estudiante_model->agregarestudiante($data);
		// redirect('estudiante/est', 'refresh');
	public function agregarbd()
	{
		$correo = $this->input->post("destinatario");

    // Verificar si el correo ya existe en la base de datos
    if ($this->estudiante_model->correoExiste($correo)) {
        // Mostrar mensaje de error o redirigir a una página de error
        // echo "El correo electrónico ya existe en la base de datos";
		$this->session->set_flashdata('error_correo', 'El correo electrónico ya está registrado en la base de datos');
        redirect('estudiante/agregar', 'refresh');
		return;
    }
		// redirect('base/emple', 'refresh');
		// $this->load->view('success_message');
	

    // Crear datos para la tabla 'usuario'
    
		try {
			function generarUsuarioAleatorio() {
				// Generar un usuario aleatorio (personaliza esta lógica según tus necesidades)
				$usuario = 'usuariocepra' . rand(1000, 9999);
				return $usuario;
			}
		
			// Función para generar una contraseña aleatoria de 8 dígitos
			function generarContrasenaAleatoria() {
				$caracteres = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ@#$%&*';
    $contrasena = substr(str_shuffle($caracteres), 0, 8);
    return $contrasena;
			}
		
			// Generar la cuenta de usuario y la contraseña
			$usuario = generarUsuarioAleatorio();
			$contrasena = generarContrasenaAleatoria();
			$contrasena_cifrada = md5($contrasena);
		
			// Resto del código para configurar y enviar el correo electrónico
			// ...
		
			// Incluir la cuenta de usuario y la contraseña en el cuerpo del correo
			
		
			// Resto del código para enviar el correo electrónico
			// ...


					// Contenido del correo
					// print("Esta parte se está ejecutando.");
					$asunto    = $this->input->post("asunto");
					// $data['asunto'] = $_POST['asunto'];
					// $data['contenido'] = $_POST['contenido'];
					// $data['destinatario'] = $_POST['destinatario'];
					$contenido = $this->input->post("contenido");
					$para      = $this->input->post("destinatario");
			
					if (!filter_var($para, FILTER_VALIDATE_EMAIL)) {
						throw new Exception('Dirección de correo electrónico no válida.');
					}
					// error_log("La función post_gmail se está ejecutando.");
					// Cargar la librería PHPMailer
					// $this->load->library('phpmailer_lib');
					require 'vendor/autoload.php';
					$mail                = new PHPMailer(true);
			        $mail->SMTPOptions = [
						'ssl' => [
							'verify_peer' => false,
							'verify_peer_name' => false,
							'allow_self_signed' => true,
						],
					];
					// Crear una instancia de PHPMailer
					// $mail = $this->phpmailer_lib->load();
					// error_log("La función post_gmail se está ejecutando.");
					// Configurar el servidor SMTP
					// $mail->SMTPDebug = SMTP::DEBUG_SERVER;
					$mail->isSMTP();
					$mail->Host = 'smtp.gmail.com';
					$mail->Port = 587; // o 465 si prefieres SSL
					$mail->SMTPSecure = 'tls'; // o 'ssl' para SSL
					$mail->SMTPAuth = true;
			
					// Credenciales de la cuenta de Gmail
					$email = 'bikeracealvaro@gmail.com';
					$mail->Username = $email;
					$mail->Password = 'gzncuwbkwelnxwys';
			
					// Configurar el remitente y destinatario
					$mail->setFrom($email, 'Roberto Orozco');
					$mail->addReplyTo('replyto@panchos.com', 'Pancho Doe');
					$mail->addAddress($para, 'John Doe');
			
					// Asunto del correo
					$mail->Subject = $asunto;
			
					// Contenido HTML del correo
					$mail->IsHTML(true);
					$mail->CharSet = 'UTF-8';
					// $mail->Body = sprintf('<h1>El mensaje es:</h1><br><p>%s</p>', $contenido);
					$mail->Body = sprintf('<h1>El mensaje es:</h1><br><p>%s</p><p>Cuenta de usuario: %s</p><p>Contraseña: %s</p>', $contenido, $usuario, $contrasena);
			
					// Texto alternativo
					$mail->AltBody = 'No olvides suscribirte a nuestro canal.';
			
					// Enviar el correo
					if (!$mail->send()) {
						throw new Exception($mail->ErrorInfo);
					}
			
					// Redireccionar con un mensaje de éxito
					$this->session->set_flashdata('success', 'Mensaje enviado con éxito a ' . $para);
					// redirect('base/emple', 'refresh'); // Cambia 'base/index' a la URL deseada después del envío exitoso
			
				} catch (Exception $e) {
					// Manejar errores y redireccionar con un mensaje de error
					$this->session->set_flashdata('error', $e->getMessage());
					// redirect('base/index');
					// redirect('base/emple', 'refresh'); // Cambia 'base/index' a la URL deseada en caso de error
				}


			$usuarioData = array(
				'login' => $usuario, // Puedes personalizar la lógica aquí
				'password' => $contrasena_cifrada,// Cambia 'contrasena' por la contraseña deseada
				'tipo' => 'invitado',
				'estado' => 1, // Puedes personalizar según tu lógica de activación
				'fechaRegistro' => date('Y-m-d H:i:s'),
				'fechaActualizacion' => date('Y-m-d H:i:s'),
				'email' => $_POST['destinatario'], // Usar el correo proporcionado en el formulario
				// 'idUsuario' => $idEmpleado, // Asignar el ID del empleado como ID de usuario
			);
		
			// Agregar usuario
			$this->estudiante_model->agregarUsuario($usuarioData);
			$idUsuario = $this->db->insert_id();
			$data['nombre'] = $_POST['nombre'];
			$data['primerApellido'] = $_POST['primerApellido'];
			$data['segundoApellido'] = $_POST['segundoApellido'];
			$data['carrera'] = $_POST['carrera'];
			
			$data['fechaNacimiento'] = $_POST['fechaNac'];
			$data['direccion'] = $_POST['direccion'];
			$data['telefono'] = $_POST['telefono'];
		
		
			
			$data['idUsuario'] = $idUsuario;
			$data['departamento'] = $_POST['departamento'];
		

		$this->estudiante_model->agregarestudiante($data);
			redirect('estudiante/est', 'refresh');
			
		
	}
	
	public function modificar()
	{
		$idestudiante = $_POST['idestudiante'];
		$data['infoestudiante'] = $this->estudiante_model->recuperarestudiante($idestudiante);
		$this->load->view('incadmin/cabecera');
		$this->load->view('incadmin/menu');
		$this->load->view('incadmin/menulateral');
		$this->load->view('est_modificar',$data);
		$this->load->view('incadmin/pie');
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
		$this->load->view('incadmin/cabecera');
		$this->load->view('incadmin/menu');
		$this->load->view('incadmin/menulateral');
		$this->load->view('est_listades',$data);
		$this->load->view('incadmin/pie');
	}

	
	// public function invitado()
	// {
		

	// 	if($this->session->userdata('login'))
	// 	{
	// 		$this->load->view('incestudiante/cabecera');
	// 		// $this->load->view('incestudiante/menu');
	// 		$this->load->view('incestudiante/menu');
	// 		$this->load->view('incestudiante/menulateral');
	// 		$this->load->view('est_invitado');
	// 		$this->load->view('incestudiante/pie');
	// 	}
	// 	else
	// 	{
	// 		redirect('usuarios/index/2', 'refresh');
	// 	}
		
		
	// }
	public function invitado() {
		if($this->session->userdata('login')) {
			$idUsuario = $this->session->userdata('idusuario');
			// echo "ID Usuario: " . $idUsuario; 
			// Obtener los datos del estudiante basado en idUsuario
			$data['estudiante'] = $this->estudiante_model->obtener_estudiante_por_usuario($idUsuario);
			
			$this->load->view('incestudiante/cabecera', $data);
			$this->load->view('incestudiante/menu', $data);
			$this->load->view('incestudiante/menulateral', $data);
			$this->load->view('inicio', $data);
			$this->load->view('incestudiante/pie', $data);
		} else {
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
	// public function index2() {
    //     // Cargar el modelo si aún no lo has hecho
    //     $this->load->model('Estudiante_model');

    //     // Obtener los datos del estudiante (supongamos que está basado en el idUsuario)
    //     $idUsuario = $this->session->userdata('idUsuario'); // O cualquier forma en que obtengas el idUsuario
    //     $estudiante = $this->Estudiante_model->getEstudianteByIdUsuario($idUsuario);

    //     // Pasar los datos a la vista
    //     $data['estudiante'] = $estudiante;

    //     // Cargar la vista y pasar los datos
    //     $this->load->view('incestudiante/menulateral', $data);
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
