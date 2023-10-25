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
	public function cursos2()
	{
		
		if($this->session->userdata('login'))
        {
			//$lista=$this->empleado_model->listaempleados();
			$lista = $this->cursos_model->listacursos();


			$data['cursos'] = $lista;
			$this->load->view('incestudiante/cabecera');
			$this->load->view('incestudiante/menu');
			$this->load->view('incestudiante/menulateral');
			//$this->load->view('cursos_lista',$data);
			$this->load->view('cursos_lista2',$data);
			$this->load->view('incestudiante/pie');
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
        $idUsuario = $this->session->userdata('idusuario');
		$data['titulo'] = $_POST['titulo'];
		$data['descripcion'] = $_POST['descripcion'];
		$data['foto'] = $_POST['foto'];
		$data['idUsuario'] = $idUsuario;

		$this->cursos_model->agregarcursos($data);
		$curso_id = $this->db->insert_id();
		


    // Procesar datos de las secciones
    $numero_secciones = $this->input->post('numeroSecciones');
    for ($i = 1; $i <= $numero_secciones; $i++) {
        $data = array(
            
            'nombre' => $this->input->post("titulo_seccion_$i"),
            'descripcion' => $this->input->post("descripcion_seccion_$i"),
			'idCurso' => $curso_id,
            // Otros campos de la seccións
        );
		
        // Insertar datos de la sección en la tabla secciones
        $seccion_id =$this->cursos_model->agregar_seccion($data);

        // Procesar datos de los archivos de la sección
        // ... Lógica para procesar archivos ...
        
        // Procesar datos de los videos de la sección
        // ... Lógica para procesar videos ...
    
	$numero_archivos = $this->input->post("numeroArchivos");
	for ($j = 1; $j <= $numero_archivos; $j++) {
		
		$data_archivo = array(
			'nombreArchivo' => $this->input->post("titulo_archivo_{$i}_{$j}"),
            'rutaArchivo' => $this->input->post("ruta_archivo_{$i}_{$j}"),
			'idSeccion' => $seccion_id,
		);
		$this->cursos_model->agregarArchivo($data_archivo);
	}
	$numero_videos = $this->input->post("numeroVideos");
for ($k = 1 ; $k <= $numero_videos ; $k++) {
	
    $data_video = array(
		'tituloVideo' => $this->input->post("titulo_video_{$i}_{$k}"),
		'descripcionVideo' => $this->input->post("descripcion_video_{$i}_{$k}"),
		'enlaceVideo' => $this->input->post("ruta_video_{$i}_{$k}"),
        'idSeccion' => $seccion_id,
    );
    $this->cursos_model->agregarVideo($data_video);
}
}
    // Redireccionar o mostrar un mensaje de éxito
	// redirect('cursos/cursos', 'refresh');
	var_dump($data);
	$numero_secciones = $this->input->post('numeroSecciones');
echo 'Número de secciones: ' . $numero_secciones;

for ($i = 1; $i <= $numero_secciones; $i++) {
    echo "Datos de la sección $i:";
    echo $this->input->post("titulo_seccion_$i");
    echo $this->input->post("descripcion_seccion_$i");
    // Otros campos de la sección
}

		
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
		$data['foto'] = $_POST['foto'];
		
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
		 $data['foto']=$nombrearchivo;
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
	public function ver_videosest()
	{
		 $this->load->view('inc/cabecera');
		// $this->load->view('inc/menu');
		// $this->load->view('inc/menulateral');
		$this->load->view('ver_videos1');
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
	
	public function crear_evaluacion()
	{
	// 	$this->load->model('evaluaciones_model');
    //     $this->load->model('cursos_model');
    //     $this->load->model('Secciones_model');
    // // Asegúrate de cargar el modelo de secciones

    // // Obtener todos los cursos y secciones disponibles
    // $data['cursos'] = $this->cursos_model->listacursos()->result();
    // $data['secciones'] = $this->Secciones_model->listasecciones()->result();
	// Cargar el modelo de evaluaciones
    $this->load->model('evaluaciones_model');
    $this->load->model('cursos_model');
    $this->load->model('Secciones_model');

    // Obtener todos los cursos
    $data['cursos'] = $this->cursos_model->listacursos()->result();

    // Obtener el ID del curso seleccionado (supongamos que viene del formulario)
    $idCursoSeleccionado = $this->input->post('curso'); // Ajusta esto según tu formulario

    // Obtener las secciones correspondientes al curso seleccionado
    $data['secciones'] = $this->Secciones_model->obtener_secciones_por_curso($idCursoSeleccionado);

    
    // Cargar la vista con los datos
    
    
		// $this->load->view('inc/cabecera');
		// $this->load->view('inc/menu');
		// $this->load->view('inc/menulateral');
		$this->load->view('crear_evaluacion', $data);
		// $this->load->view('inc/pie');
		
	}
public function realizar_evaluacion()
{
    // Obtener la última evaluación
    $ultima_evaluacion = $this->evaluaciones_estudiante_model->obtener_ultima_evaluacion();
	// var_dump($ultima_evaluacion);
    // Verificar si hay alguna evaluación
    if ($ultima_evaluacion) {
        // Obtener las preguntas de la última evaluación
        $data['preguntas'] = $this->evaluaciones_estudiante_model->obtener_preguntas_evaluacion($ultima_evaluacion['idEvaluacion']);
		$data['tituloEvaluacion'] = $ultima_evaluacion['tituloEvaluacion'];
$data['descripcionEvaluacion'] = $ultima_evaluacion['descripcionEvaluacion'];
$data['puntajeTotal'] = $ultima_evaluacion['puntajeTotal'];
        // Cargar la vista con la información de la última evaluación
		// var_dump($ultima_evaluacion);
        $this->load->view('realizar_evaluacion', $data);
    } else {
        // Manejar el caso en que no haya evaluaciones
        echo 'No hay evaluaciones disponibles.';
    	}
	}
	

		public function obtener_puntaje_total($idEvaluacion, $idEstudiante) {
   	 // Lógica para obtener el puntaje total
   	 // ...

   	 return $puntajeTotal;
		}


	public function subir_archivos ()
	{
        
		$this->load->view('inc/cabecera');
		// $this->load->view('inc/menu');
		// $this->load->view('inc/menulateral');
		   $this->load->view('subir_archivos');
		// $this->load->view('inc/pie');
		
	}
	public function listadoc ()
	{
        
		$this->load->view('inc/cabecera');
		// $this->load->view('inc/menu');
		// $this->load->view('inc/menulateral');
		   $this->load->view('lista_documentos');
		// $this->load->view('inc/pie');
		
	}
	public function eliminardoc ()
	{
        
		$this->load->view('inc/cabecera');
		// $this->load->view('inc/menu');
		// $this->load->view('inc/menulateral');
		   $this->load->view('eliminar_documento');
		// $this->load->view('inc/pie');
		
	}
	public function agregar_seccion_bd()
{
    // Imprimir contenido de $this->input->post() para depuración
    echo "Datos del formulario (POST):";
    echo '<pre>';
    print_r($this->input->post());
    echo '</pre>';

    // Crear arreglo de datos para la sección
    $data['nombre'] = $this->input->post('titulo_seccion_1');
    $data['descripcion'] = $this->input->post('descripcion_seccion_1');

    // Imprimir contenido de $data para depuración
    echo "Datos para la sección (data):";
    echo '<pre>';
    print_r($data);
    echo '</pre>';

    // Agregar la sección a la base de datos
    $this->cursos_model->agregar_seccion($data);

    // Redirigir o mostrar un mensaje de éxito
    // redirect('cursos/cursos', 'refresh');
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
