<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Evaluaciones extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        // Cargar el modelo necesario para interactuar con la base de datos
        $this->load->model('evaluaciones_model');
    }

    public function crear_evaluacion()
    
    {
        $this->load->model('evaluaciones_model');
        $this->load->model('cursos_model');
        // $this->load->model('secciones_model');
    // Asegúrate de cargar el modelo de secciones

    // Obtener todos los cursos y secciones disponibles
    $data['cursos'] = $this->cursos_model->listacursos()->result();
    $data['secciones'] = $this->cursos_model->listasecciones()->result();
//     echo '<pre>';
// print_r($data['cursos']);
// print_r($data['secciones']);
// echo '</pre>';
    
        $this->load->view('inc/cabecera');
        $this->load->view('inc/menu');
        $this->load->view('inc/menulateral');
        $this->load->view('crear_evaluacion', $data);
        $this->load->view('inc/pie');
    }

    public function agregarbd()
    {
        // $curso_seccion = $this->input->post('curso_seccion');
        // $idCurso = $this->input->post('curso');
    $idSeccion = $this->input->post('seccion');
    $idCurso = $this->input->post('hiddenCursoId');
    if ($this->evaluaciones_model->verificar_evaluacion_activa($idCurso, $idSeccion)) {
        echo 'Ya hay una evaluación activa en esta sección del curso.';
        return;
    }
    echo "ID del Curso: $idCurso";
echo "ID de la Sección: $idSeccion";
    // Verificar que el ID del curso existe en la tabla cursos
    // if (!$this->evaluaciones_model->verificar_curso_existente($idCurso)) {
    //     echo "Error: El ID del curso no existe.";
    //     return;
    // }
        // Obtener datos del formulario
        $data['tituloEvaluacion'] = $this->input->post('title');
        $data['descripcionEvaluacion'] = $this->input->post('description');
        $data['fechaFin'] = $this->input->post('deadline');
        $data['fechaInicio'] = $this->input->post('startDate');
        $data['numeroIntentos'] = $this->input->post('numeroIntentos');
        $data['duracion'] = $this->input->post('duracion');
        $idUsuario = $this->session->userdata('idusuario'); // Necesitarás implementar esta función

    // Obtener el idEmpleado usando el idUsuario
    $idEmpleado = $this->obtener_id_empleado($idUsuario);

    if ($idEmpleado !== null) {
        // Agregar el idEmpleado al array de datos
        $data['idEmpleado'] = $idEmpleado;

        // Resto de la lógica para agregar la evaluación...
    } else {
        // Manejar el caso en el que el usuario no es un empleado
        echo "El usuario actual no es un empleado.";
    }
        // Obtener preguntas del formulario
        $questions = array();
        $questionCount = count($this->input->post('questions'));
        $puntajeTotal = 0; // Inicializar puntaje total
        $config['upload_path'] = './uploads/evaluaciones/';
        $config['allowed_types'] = 'gif|jpg|jpeg|png';
        $this->load->library('upload', $config);
        $imageFiles = $_FILES['imageQuestion'];
        for ($i = 0; $i < $questionCount; $i++) {
            $question = array(
                'enunciadoPregunta' => $this->input->post("questions[$i]"),
                'tipoPregunta' => 'multiple_choice', // Ajusta el tipo según tus necesidades
                'puntajePregunta' => $this->input->post("scores[$i]"),
                'imageQuestion' => null,
            );

            // Obtener opciones de respuesta y respuestas correctas
            $options = explode(',', $this->input->post("options[$i]"));
            $correctOptions = explode(',', $this->input->post("correctOptions[$i]"));

            // Agregar opciones y respuestas correctas a la pregunta
            $question['options'] = $options;
            $question['correctOptions'] = $correctOptions;

             // Subir imagen de la pregunta
        // $imageFieldName = "imageQuestion";

        // Configuración para subir la imagen
        
        // $config['max_size'] = 1024; // Tamaño máximo en kilobytes

        // $this->load->library('upload', $config);
        
        echo "DEBUG: ";
        print_r($imageFiles);
        print_r("questions[$i] pregunta $i");
        
       
        
        $_FILES['imageQuestion']['name'] = $imageFiles['name'][$i] ?? null;
    $_FILES['imageQuestion']['type'] = $imageFiles['type'][$i] ?? null;
    $_FILES['imageQuestion']['tmp_name'] = $imageFiles['tmp_name'][$i] ?? null;
    $_FILES['imageQuestion']['error'] = $imageFiles['error'][$i] ?? null;
    $_FILES['imageQuestion']['size'] = $imageFiles['size'][$i] ?? null;

    
            if ($this->upload->do_upload('imageQuestion')) {
                $uploadData = $this->upload->data();
                $imagePath = './uploads/evaluaciones/' . $uploadData['file_name'];

            // Agregar la ruta de la imagen a la pregunta
            $question['imageQuestion'] = $imagePath;
        } else {
            echo "No se seleccionó una imagen para la pregunta $i.";
            // Manejar errores si la subida falla
            $error = array('error' => $this->upload->display_errors());
            print_r($error);
        }
        
            // Agregar la pregunta al array de preguntas
            $questions[] = $question;

            // Calcular puntaje total
            $puntajeTotal += $question['puntajePregunta'];
        }
        $data['estado'] = 'activo';
        // Llamar al modelo para agregar la evaluación y preguntas
        $evaluation_id = $this->evaluaciones_model->agregar_evaluacion($data, $questions, $idCurso, $idSeccion, $puntajeTotal);

        // Puedes redirigir a una página de éxito o mostrar un mensaje aquí
        redirect('evaluaciones/crear_evaluacion', 'refresh');
    }

    private function obtener_id_empleado($idUsuario)
{
    $this->load->model('empleado_model');
    $idEmpleado = $this->empleado_model->obtener_id_empleado_por_usuario($idUsuario);
    return $idEmpleado;
}
public function evaluaciones_enlista()
{
    if ($this->session->userdata('login')) {
        $tipo = $this->session->userdata('tipo');

        $lista = $this->evaluaciones_model->listaevaluaciones();
        $data['cursos'] = $lista;

      

        if ($tipo == 'admin') {
            // Cargar la vista para el administrador
			$this->load->view('inc/cabecera');
					$this->load->view('incadmin/menu');
					$this->load->view('incadmin/menulateral');
					$this->load->view('evaluaciones_lista_profe',$data);
					$this->load->view('incadmin/pie');
        } if ($tipo == 'empleado') {
            // Cargar la vista para el empleado
            $this->load->view('inc/cabecera');
			$this->load->view('inc/menu');
			$this->load->view('inc/menulateral');
			$this->load->view('evaluaciones_lista_profe',$data);
			$this->load->view('inc/pie');

        } 
		if ($tipo == 'invitado') {
			// Cargar la vista para el empleado
			$this->load->view('incestudiante/cabecera');
			$this->load->view('incestudiante/menu');
			$this->load->view('incestudiante/menulateral');
			$this->load->view('evaluaciones_lista_profe',$data);
			$this->load->view('incestudiante/pie');
			
			
		}
		// else {
        //     // Rol no reconocido, puedes manejar esto según tus necesidades
        //     echo "Rol no reconocido";
        // }

        
    } else {
        redirect('usuarios/index/2', 'refresh');
    }
}
public function modificar()
{
    $idevaluaciones = $_POST['idevaluaciones'];
    
    // Recuperar información de la evaluación
    $data['infocursos'] = $this->evaluaciones_model->recuperarevaluaciones($idevaluaciones);

    // Recuperar preguntas y opciones de respuesta asociadas a la evaluación
    $data['preguntas'] = $this->evaluaciones_model->recuperarPreguntas($idevaluaciones);

    // Recuperar opciones de respuesta asociadas a cada pregunta
    foreach ($data['preguntas'] as &$pregunta) {
        $pregunta->opciones = $this->evaluaciones_model->recuperarOpcionesRespuesta($pregunta->idPregunta);
    }

    // Cargar vistas
    $this->load->view('inc/cabecera');
    $this->load->view('inc/menu');
    $this->load->view('inc/menulateral');
    $this->load->view('evaluaciones_modificar', $data);
    $this->load->view('inc/pie');
}
public function modificarbd()
{
    $idEvaluacion = $this->input->post('idEvaluacion');

    // Datos generales de la evaluación
    $data['tituloEvaluacion'] = $this->input->post('titulo');
    $data['descripcionEvaluacion'] = $this->input->post('descripcion');
    $data['fechaInicio'] = $this->input->post('startDate');
    $data['fechaFin'] = $this->input->post('deadline');
    $data['duracion'] = $this->input->post('duracion');

    // Modificar datos generales de la evaluación
    $this->evaluaciones_model->modificarEvaluacion($idEvaluacion, $data);

    // Modificar preguntas y opciones de respuesta asociadas
    $preguntas = $this->input->post('preguntas');
    $respuestas = $this->input->post('respuestas');
    

    foreach ($preguntas as $idPregunta => $datosPregunta) {
        $dataPregunta = array(
            'enunciadoPregunta' => $datosPregunta['enunciado'],
            'puntajePregunta' => $datosPregunta['puntaje'],
        );
    
        $idPregunta = $this->evaluaciones_model->modificarPregunta($idPregunta, $dataPregunta);
    
        // Verificar si el índice "respuestas" existe y es un array
        if (isset($datosPregunta['respuestas']) && is_array($datosPregunta['respuestas'])) {
            foreach ($datosPregunta['respuestas'] as $respuesta) {
                $dataRespuesta = array(
                    'textoOpcion' => $respuesta['textoOpcion'],
                    'esCorrecta' => isset($respuesta['esCorrecta']) ? (int) $respuesta['esCorrecta'] : 0,
                );
    
                // Asegúrate de pasar el idOpcion y idPregunta
                $idOpcion = isset($respuesta['idOpcion']) ? $respuesta['idOpcion'] : null;
    
                $this->evaluaciones_model->modificarRespuesta($idOpcion, $idPregunta, $dataRespuesta);
            }
        }
    }
    redirect('evaluaciones/evaluaciones_enlista', 'refresh');
            // echo '<pre>';
            // print_r($_POST);
            // echo '</pre>';
        }
public function deshabilitarbd()
{
    $idEvaluacion = $this->input->post('idevaluaciones');

    // Lógica para deshabilitar la evaluación con el ID proporcionado
    // ...

    // Por ejemplo, puedes llamar a la función deshabilitarEvaluacion en tu modelo
    $this->load->model('evaluaciones_model');
    $exito = $this->evaluaciones_model->deshabilitarEvaluacion($idEvaluacion);

    if ($exito) {
        // Éxito, redirigir o hacer cualquier otra cosa
        redirect('evaluaciones/evaluaciones_enlista', 'refresh');
        // echo "La evaluación ha sido deshabilitada con éxito.";
    } else {
        // Algo salió mal
        // echo "Error al deshabilitar la evaluación.";
        redirect('evaluaciones/evaluaciones_enlista', 'refresh');
    }
}
public function deshabilitados()
{
    $lista = $this->evaluaciones_model->listaevaluacionesdes();
    $data['evaluaciones'] = $lista;
    $this->load->view('inc/cabecera');
    $this->load->view('inc/menu');
    $this->load->view('inc/menulateral');
    $this->load->view('evaluaciones_listades',$data);
    $this->load->view('inc/pie');
}
        
public function habilitarbd()
{
    $idevaluaciones = $_POST['idevaluaciones'];
    $data['estado']='activo';


    $this->evaluaciones_model->modificarevaluaciones($idevaluaciones,$data);
    redirect('evaluaciones/deshabilitados', 'refresh');

}   

    }
    

