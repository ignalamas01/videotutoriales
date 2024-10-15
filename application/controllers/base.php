<?php
defined('BASEPATH') or exit('No direct script access allowed');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require FCPATH.'vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Base extends CI_Controller
{
	public function __construct() {
        parent::__construct();
        // Cargar la librería MenuLateral
        $this->load->library('MenuLateral');
    }
	public function index()
	{
		if($this->session->userdata('login'))
        {
			// $this->load->view('inc/cabecera');
			// $this->load->view('inc/menu');
			// $this->load->view('inc/menulateral');
			// $this->load->view('inicio');
			// $this->load->view('inc/pie');
			$tipo = $this->session->userdata('tipo');
			if ($tipo == 'admin') {
				// Cargar la vista para el administrador
				$this->load->view('inc/cabecera');
						$this->load->view('incadmin/menu');
						$this->load->view('incadmin/menulateral');
						$this->load->view('inicio');
						$this->load->view('incadmin/pie');
			} if ($tipo == 'empleado') {
				// Cargar la vista para el empleado
				$this->load->view('inc/cabecera');
				$this->load->view('inc/menu');
				$this->load->view('inc/menulateral');
				$this->load->view('inicio');
				$this->load->view('inc/pie');
			}
			if ($tipo == 'invitado') {
				// Cargar la vista para el empleado
				$this->load->view('incestudiante/cabecera');
				$this->load->view('incestudiante/menu');
				$this->load->view('incestudiante/menulateral');
				$this->load->view('inicio');
				$this->load->view('incestudiante/pie');
			}
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
		// $this->load->view('inc/cabecera');
		// $this->load->view('inc/menu');
		// $this->load->view('inc/menulateral');
		// $this->load->view('objetivos');
		// $this->load->view('inc/pie');
		$tipo = $this->session->userdata('tipo');
			if ($tipo == 'admin') {
				// Cargar la vista para el administrador
				$this->load->view('incadmin/cabecera');
						$this->load->view('incadmin/menu');
						$this->load->view('incadmin/menulateral');
						$this->load->view('objetivos');
						$this->load->view('incadmin/pie');
			} if ($tipo == 'empleado') {
				// Cargar la vista para el empleado
				$this->load->view('inc/cabecera');
				$this->load->view('inc/menu');
				$this->load->view('inc/menulateral');
				$this->load->view('objetivos');
				$this->load->view('inc/pie');
			}
			if ($tipo == 'invitado') {
				// Cargar la vista para el empleado
				$this->load->view('incestudiante/cabecera');
				$this->load->view('incestudiante/menu');
				$this->load->view('incestudiante/menulateral');
				$this->load->view('objetivos');
				$this->load->view('incestudiante/pie');
				
			}
        
			// else
			// {
			// 	redirect('usuarios/index/2','refresh');
			// }
		
	}
	
	public function emple()
	{
		
		if($this->session->userdata('login'))
        {
			//$lista=$this->empleado_model->listaempleados();
			$lista = $this->empleado_model->listaempleados();


			$data['empleado'] = $lista;
			$this->load->view('incadmin/cabecera');
			$this->load->view('incadmin/menu');
			$this->load->view('incadmin/menulateral');
			$this->load->view('emple_lista',$data);
			$this->load->view('incadmin/pie');
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
		
		$this->load->view('incadmin/cabecera');
		$this->load->view('incadmin/menu');
		$this->load->view('incadmin/menulateral');
		$this->load->view('emple_formulario');
		$this->load->view('incadmin/pie');
	}
	
	public function agregarbd()
{
    $correo = $this->input->post("destinatario");

    // Verificar si el correo ya existe en la base de datos
    if ($this->empleado_model->correoExiste($correo)) {
        $this->session->set_flashdata('error_correo', 'El correo electrónico ya está registrado en la base de datos');
        redirect('base/agregar', 'refresh');
        return;
    }

    // Generar datos para la tabla 'usuario'
    try {
        // Función para generar usuario aleatorio
        function generarUsuarioAleatorio() {
            $usuario = 'usuariocepra' . rand(1000, 9999);
            return $usuario;
        }

        // Función para generar una contraseña aleatoria de 8 dígitos
        function generarContrasenaAleatoria() {
            $caracteres = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ@#$%&*';
            $contrasena = substr(str_shuffle($caracteres), 0, 8);
            return $contrasena;
        }

        // Generar usuario y contraseña
        $usuario = generarUsuarioAleatorio();
        $contrasena = generarContrasenaAleatoria();
        $contrasena_cifrada = md5($contrasena); // Encriptación

        // Lógica para enviar el correo con las credenciales
        require 'vendor/autoload.php';
        $mail = new PHPMailer(true);
        $mail->SMTPOptions = [
            'ssl' => [
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true,
            ],
        ];
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->Port = 587;
        $mail->SMTPSecure = 'tls';
        $mail->SMTPAuth = true;

        // Credenciales de Gmail
        $email = 'bikeracealvaro@gmail.com';
        $mail->Username = $email;
        $mail->Password = 'gzncuwbkwelnxwys';

        // Configurar remitente y destinatario
        $mail->setFrom($email, 'Roberto Orozco');
        $mail->addAddress($correo);

        // Asunto y cuerpo del correo
        $mail->Subject = 'Credenciales de acceso';
        $mail->IsHTML(true);
        $mail->CharSet = 'UTF-8';
        $mail->Body = sprintf('<h1>Bienvenido</h1><p>Su cuenta de usuario es: %s</p><p>Su contraseña es: %s</p>', $usuario, $contrasena);

        // Enviar el correo
        if (!$mail->send()) {
            throw new Exception($mail->ErrorInfo);
        }

        // Crear datos para la tabla 'usuario'
        $usuarioData = array(
            'login' => $usuario,
            'password' => $contrasena_cifrada,
            'tipo' => 'empleado',
            'estado' => 1,
            'fechaRegistro' => date('Y-m-d H:i:s'),
            'fechaActualizacion' => date('Y-m-d H:i:s'),
            'email' => $correo,
        );

        // Insertar usuario en la base de datos
        $this->empleado_model->agregarUsuario($usuarioData);
        $idUsuario = $this->db->insert_id(); // Obtener el ID del nuevo usuario insertado

        // Crear datos para la tabla 'empleado'
        $data = array(
            'nombre' => $this->input->post("nombre"),
            'primerApellido' => $this->input->post("primerApellido"),
            'segundoApellido' => $this->input->post("segundoApellido"),
            'departamento' => $this->input->post("departamento"),
            'fechaNacimiento' => $this->input->post("fechaNac"),
            'telefono' => $this->input->post("telefono"),
            'direccion' => $this->input->post("direccion"),
			'seudonimo' => $this->input->post("seudonimo"),
            'idUsuario' => $idUsuario
        );

        // Insertar empleado en la base de datos
        $this->empleado_model->agregarempleado($data);
        $idEmpleado = $this->db->insert_id(); // Obtener el ID del nuevo empleado

        
// Establecer la ruta de carga
$uploadPath = 'C:/xampp/htdocs/videotutoriales/uploads/firmas/'; // Usar barras inclinadas hacia adelante
$config['upload_path']   = $uploadPath;
$config['allowed_types'] = 'jpg|jpeg|png';
$config['max_size']      = 2048; // Tamaño máximo del archivo (2MB)
$config['file_name']     = $idUsuario . $idEmpleado; // Nombre base del archivo

// Inicializar la librería de carga
$this->load->library('upload', $config);

// Intentar subir el archivo
if ($this->upload->do_upload('firma')) { // 'firma' es el nombre del campo input file en tu formulario
    $fileData = $this->upload->data();
    
    // Obtener la extensión del archivo subido
    $fileExt = $fileData['file_ext']; // .jpg, .jpeg o .png

    // Renombrar el archivo con el ID combinado y la extensión correcta
    $newFileName = $idUsuario . $idEmpleado . $fileExt; // Combina ID y extensión
    $newFilePath = $uploadPath . $newFileName; // Nueva ruta completa

    // Renombrar el archivo en el sistema de archivos
    rename($fileData['full_path'], $newFilePath);

    // Actualizar la tabla 'empleado' con la ruta completa de la firma
    $this->empleado_model->actualizarFirmaEmpleado($idEmpleado, $newFilePath); // Guardar la ruta completa

    // Mensaje de éxito
    $this->session->set_flashdata('success', 'Empleado agregado exitosamente.');
} else {
    // Manejo de errores
    $this->session->set_flashdata('error', $this->upload->display_errors());
}

// Redireccionar a la vista deseada
redirect('base/emple', 'refresh');

    } catch (Exception $e) {
        // Manejo de errores
        $this->session->set_flashdata('error', $e->getMessage());
        redirect('base/agregar', 'refresh');
    }
}

	public function modificar()
	{
		$idempleado = $_POST['idempleado'];
		$data['infoempleado'] = $this->empleado_model->recuperarempleado($idempleado);
		$this->load->view('incadmin/cabecera');
		$this->load->view('incadmin/menu');
		$this->load->view('incadmin/menulateral');
		$this->load->view('emple_modificar',$data);
		$this->load->view('incadmin/pie');
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
		$data['seudonimo'] = $_POST['seudonimo'];
		$this->empleado_model->modificarempleado($idempleado,$data);
		redirect('base/emple', 'refresh');
	}


	public function eliminarbd()
	{
		// $idempleado = $_POST['idempleado'];
		// $this->empleado_model->eliminarempleado($idempleado);
		// redirect('base/emple', 'refresh');
		$idempleado = $_POST['idempleado'];

    // Llamada al modelo para eliminar en ambas tablas
    if ($this->empleado_model->eliminarempleado($idempleado)) {
        // La eliminación se realizó con éxito
        $this->session->set_flashdata('success', 'Empleado y usuario eliminados con éxito');
    } else {
        // Ocurrió un error
        $this->session->set_flashdata('error', 'Error al eliminar el empleado y usuario');
    }

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
		$this->load->view('incadmin/cabecera');
		$this->load->view('incadmin/menu');
		$this->load->view('incadmin/menulateral');
		$this->load->view('emple_listades',$data);
		$this->load->view('incadmin/pie');
	}
	public function verificar_correo_existente() {
		$destinatario = $this->input->post('destinatario');
	
		$this->load->model('empleado_model');
		$existe = $this->empleado_model->correoExiste($destinatario);
	
		echo ($existe) ? 'existe' : 'no_existe';
	}

	// public function invitado()
	// {
		

	// 	if($this->session->userdata('login'))
	// 	{
	// 		$this->load->view('incestudiante/cabecera');
	// 		$this->load->view('incestudiante/menu');
	// 		$this->load->view('incestudiante/menulateral');
	// 		$this->load->view('emple_invitado');
	// 		$this->load->view('incestudiante/pie');
	// 	}
	// 	else
	// 	{
	// 		redirect('usuarios/index/2', 'refresh');
	// 	}
		
		
	// }
	
	
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
	public function index2() {
		if($this->session->userdata('login')) {
			$idUsuario = $this->session->userdata('idusuario');
			// echo "ID Usuario: " . $idUsuario; 
			// Obtener los datos del estudiante basado en idUsuario
			$data['empleado'] = $this->empleado_model->obtener_empleado_por_usuario($idUsuario);
			// echo "idusus" . $idUsuario;
			$this->load->view('inc/cabecera', $data);
			$this->load->view('inc/menu', $data);
			$this->menulateral->cargar_menu_lateral_profe();
			$this->load->view('inicio', $data);
			$this->load->view('inc/pie', $data);
		} else {
			redirect('base/index', 'refresh');
		}
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
