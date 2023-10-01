<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Evaluaciones_model extends CI_Model
{
    public function agregar_evaluacion($data, $questions)
    {
        // Agregar datos de la evaluación
        $this->db->insert('evaluaciones', $data);
        $evaluation_id = $this->db->insert_id();

        // Agregar preguntas a la evaluación
        foreach ($questions as $question) {
            $question_data = array(
                'enunciadoPregunta' => $question['question'],  // Ajustar según el nombre del campo en el formulario
                'tipoPregunta' => $question['tipoPregunta'],
                'puntajePregunta' => $question['score'],
                'idEvaluacion' => $evaluation_id
            );

            $this->db->insert('preguntas', $question_data);
        }

        return $evaluation_id;
    }
}