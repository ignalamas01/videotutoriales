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
    $ultima_evaluacion = $this->evaluaciones_estudiante_model->obtener_ultima_evaluacion();
    // $ultima_evaluacion['idEvaluacion'] = 48;
    $data['preguntas'] = array();

    // Obtener otros datos necesarios para la vista
    $data['idEstudiante'] = obtener_id_estudiante(); // Reemplaza esto con la lógica real
    $data['puntajeObtenido'] = obtener_puntaje_obtenido(); // Reemplaza esto con la lógica real

    // Verificar si hay alguna evaluación
    if ($ultima_evaluacion) {
        
        // Cargar la vista con la información de la última evaluación
        $this->load->view('realizar_evaluacion', $data);
    } else {
        // Manejar el caso en que no haya evaluaciones
        echo 'No hay evaluaciones disponibles.';
    }
}

public function procesar_evaluacion()
{
    try {
        // Iniciar la transacción
        $this->db->trans_start();

        // Obtener datos adicionales del formulario (fuera del bucle)
        $idEvaluacion = $this->input->post('idEvaluacion');
        $idEstudiante = $this->input->post('idEstudiante');
        $puntajeObtenido = $this->input->post('puntajeObtenido');
        $puntajeTotal = $this->input->post('totalScore');
        // Cargar las preguntas nuevamente
        $preguntas = $this->evaluaciones_estudiante_model->obtener_preguntas_evaluacion($idEvaluacion);

        // Verificar que las respuestas no estén vacías
        $respuestas = $this->input->post('respuestas');
        if (!empty($respuestas)) {
            // Recorrer las respuestas y procesar cada una
            foreach ($respuestas as $index => $respuesta) {
                // Obtener el id de la pregunta correspondiente
                $idPregunta = $preguntas[$index]['idPregunta'];

                // Crear un array con los datos
                $data = array(
                    'idEvaluacion' => $idEvaluacion,
                    'idEstudiante' => $idEstudiante,
                    'idPregunta' => $idPregunta,
                    'respuesta' => $respuesta,
                    'puntajeObtenido' => $puntajeObtenido,
                    'fechaRespuesta' => date('Y-m-d H:i:s'),
                    'estado' => 'pendiente'
                );

                // Insertar respuestas en la base de datos
                $this->RespuestasEstudiante_model->insertar_respuestas($data);
            }

            // Finalizar la transacción
            $this->db->trans_complete();

            // Verificar si la transacción fue exitosa
            if ($this->db->trans_status() === FALSE) {
                // Manejar el caso en que la transacción falló
                echo 'Error al procesar la evaluación.';
            } else {
                // Éxito
                echo 'Evaluación procesada correctamente.';
            }
        } else {
            // Manejar el caso en que no haya respuestas
            echo 'No se enviaron respuestas.';
        }
    } catch (Exception $e) {
        // Manejar cualquier excepción que ocurra durante la transacción
        echo 'Error: ' . $e->getMessage();
    }
}




}
