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
        $this->load->view('inc/cabecera');
        $this->load->view('inc/menu');
        $this->load->view('inc/menulateral');
        $this->load->view('crear_evaluacion');
        $this->load->view('inc/pie');
    }

    public function agregarbd()
    {
        // Obtener datos del formulario
        $data['tituloEvaluacion'] = $this->input->post('title');
        $data['descripcionEvaluacion'] = $this->input->post('description');
        $data['fechaFin'] = $this->input->post('deadline');
        $data['fechaInicio'] = $this->input->post('startDate');

        // Obtener preguntas del formulario
        $questions = array();
        $questionCount = count($this->input->post('questions'));
        $puntajeTotal = 0; // Inicializar puntaje total

        for ($i = 0; $i < $questionCount; $i++) {
            $question = array(
                'enunciadoPregunta' => $this->input->post("questions[$i]"),
                'tipoPregunta' => 'multiple_choice', // Ajusta el tipo según tus necesidades
                'puntajePregunta' => $this->input->post("scores[$i]"),
            );

            // Obtener opciones de respuesta y respuestas correctas
            $options = explode(',', $this->input->post("options[$i]"));
            $correctOptions = explode(',', $this->input->post("correctOptions[$i]"));

            // Agregar opciones y respuestas correctas a la pregunta
            $question['options'] = $options;
            $question['correctOptions'] = $correctOptions;

             // Subir imagen de la pregunta
        $imageFieldName = "questionImages[$i]";

        // Configuración para subir la imagen
        $config['upload_path'] = './uploads/cursos/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = 1024; // Tamaño máximo en kilobytes

        $this->load->library('upload', $config);

        if ($this->upload->do_upload($imageFieldName)) {
            $uploadData = $this->upload->data();
            $imagePath = './uploads/cursos/' . $uploadData['file_name'];

            // Agregar la ruta de la imagen a la pregunta
            $question['imagen'] = $imagePath;
        } else {
            // Manejar errores si la subida falla
            $error = array('error' => $this->upload->display_errors());
            print_r($error);
        }

            // Agregar la pregunta al array de preguntas
            $questions[] = $question;

            // Calcular puntaje total
            $puntajeTotal += $question['puntajePregunta'];
        }

        // Llamar al modelo para agregar la evaluación y preguntas
        $evaluation_id = $this->evaluaciones_model->agregar_evaluacion($data, $questions, $puntajeTotal);

        // Puedes redirigir a una página de éxito o mostrar un mensaje aquí
        // redirect('evaluaciones/crear_evaluacion', 'refresh');
    }
}

