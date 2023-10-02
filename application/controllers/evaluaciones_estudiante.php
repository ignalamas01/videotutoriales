<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Evaluaciones_estudiante extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        // Cargar el modelo necesario para interactuar con la base de datos
        $this->load->model('evaluaciones_estudiante_model');
    }

    public function ejecutar_ultima_evaluacion()
    {
        // Obtener la última evaluación
        // $ultima_evaluacion = $this->evaluaciones_estudiante_model->obtener_ultima_evaluacion();
        $ultima_evaluacion['idEvaluacion'] = 48;
        $data['preguntas'] = array();
        // Verificar si hay alguna evaluación
        if ($ultima_evaluacion) {
            // Cargar la vista con la información de la última evaluación
            $data['preguntas'] = $this->evaluaciones_estudiante_model->obtener_preguntas_evaluacion($ultima_evaluacion['idEvaluacion']);

            $this->load->view('ejecutar_evaluacion', $data);
        } else {
            // Manejar el caso en que no haya evaluaciones
            echo 'No hay evaluaciones disponibles.';
        }
    }

    public function procesar_evaluacion()
    {
        // Lógica para procesar las respuestas de la evaluación
    }
}
