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
   
}

