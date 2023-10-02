<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Evaluaciones_model extends CI_Model
{
    public function agregar_evaluacion($data, $questions)
    {
        // Agregar datos de la evaluación
        $this->db->insert('evaluaciones', $data);

        // Verificar si la inserción en evaluaciones fue exitosa
        if ($this->db->affected_rows() > 0) {
            $evaluation_id = $this->db->insert_id();
            echo 'Evaluation ID: ' . $evaluation_id;
        } else {
            echo 'Error al insertar en la tabla Evaluaciones';
            return false;
        }

        // Agregar preguntas a la evaluación
        foreach ($questions as $question) {
            $question_data = array(
                'enunciadoPregunta' => $question['enunciadoPregunta'],
                'tipoPregunta' => $question['tipoPregunta'],
                'puntajePregunta' => $question['puntajePregunta'],
                'idEvaluacion' => $evaluation_id
            );

            $this->db->insert('preguntas', $question_data);

            // Verificar si la inserción en preguntas fue exitosa
            if ($this->db->affected_rows() == 0) {
                echo 'Error al insertar en la tabla Preguntas';
                return false;
            }

            // Obtener el ID de la pregunta recién insertada
            $question_id = $this->db->insert_id();

            // Agregar opciones de respuesta
            foreach ($question['options'] as $key => $option) {
                $isCorrect = in_array($key + 1, $question['correctOptions']) ? 1 : 0;

                $option_data = array(
                    'idPregunta' => $question_id,
                    'textoOpcion' => $option,
                    'esCorrecta' => $isCorrect
                );

                $this->db->insert('opcionesrespuesta', $option_data);

                // Verificar si la inserción en opcionesrespuesta fue exitosa
                if ($this->db->affected_rows() == 0) {
                    echo 'Error al insertar en la tabla OpcionesRespuesta';
                    return false;
                }
            }
        }

        return $evaluation_id;
    }
}
