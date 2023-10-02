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

    // Obtener preguntas del formulario
    $questions = array();
    $questionCount = count($this->input->post('questions'));

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

        // Agregar la pregunta al array de preguntas
        $questions[] = $question;
    }

    // Llamar al modelo para agregar la evaluación y preguntas
    $evaluation_id = $this->evaluaciones_model->agregar_evaluacion($data, $questions);

    // Puedes redirigir a una página de éxito o mostrar un mensaje aquí
    redirect('evaluaciones/crear_evaluacion', 'refresh');
}

}
