<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Evaluaciones_model extends CI_Model
{
    public function agregar_evaluacion($data, $questions, $idCurso, $idSeccion)
    {
        $data['idCurso'] = $idCurso;
        $data['idSeccion'] = $idSeccion;
        // Iniciar transacción
        
        $this->db->trans_start();

        // Agregar datos de la evaluación
        $this->db->insert('evaluaciones', $data);

        // Verificar si la inserción en evaluaciones fue exitosa
        if ($this->db->affected_rows() > 0) {
            $evaluation_id = $this->db->insert_id();
        } else {
            // Deshacer la transacción y mostrar un mensaje de error
            $this->db->trans_rollback();
            echo 'Error al insertar en la tabla Evaluaciones';
            return false;
        }

        // Agregar preguntas a la evaluación
        foreach ($questions as $question) {
            $question_data = array(
                'enunciadoPregunta' => $question['enunciadoPregunta'],
                'tipoPregunta' => $question['tipoPregunta'],
                'puntajePregunta' => $question['puntajePregunta'],
                'idEvaluacion' => $evaluation_id,
                'imagen' => $question['imageQuestion'], // Asegúrate de que la clave sea 'imagen'
            );

            $this->db->insert('preguntas', $question_data);

            // Verificar si la inserción en preguntas fue exitosa
            if ($this->db->affected_rows() == 0) {
                // Deshacer la transacción y mostrar un mensaje de error
                $this->db->trans_rollback();
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
                    // Deshacer la transacción y mostrar un mensaje de error
                    $this->db->trans_rollback();
                    echo 'Error al insertar en la tabla OpcionesRespuesta';
                    return false;
                }
            }
        }

        // Confirmar la transacción
        $this->db->trans_complete();

        // Verificar si la transacción fue exitosa
        if ($this->db->trans_status() === FALSE) {
            // Mostrar un mensaje de error si la transacción falla
            echo 'Error al completar la transacción';
            return false;
        }
        $evaluation_data = array(
            'puntajeTotal' => $this->obtener_puntaje_total($evaluation_id)
        );

        $this->db->where('idEvaluacion', $evaluation_id);
        $this->db->update('evaluaciones', $evaluation_data);

        return $evaluation_id;
    }
    public function obtener_puntaje_total($evaluation_id)
    {
        $this->db->select_sum('puntajePregunta');
        $this->db->from('preguntas');
        $this->db->where('idEvaluacion', $evaluation_id);

        $query = $this->db->get();
        $result = $query->row();

        return $result->puntajePregunta;
    }
    public function verificar_curso_existente($idCurso)
    {
        $this->db->where('id', $idCurso);
        $query = $this->db->get('cursos');

        return $query->num_rows() > 0;
    }
    public function verificar_evaluacion_activa($idCurso, $idSeccion) {
        $this->db->select('idEvaluacion');
        $this->db->from('evaluaciones');
        $this->db->where('idCurso', $idCurso);
        $this->db->where('idSeccion', $idSeccion);
        $this->db->where('estado', 'activo');
        $result = $this->db->get()->row();
    
        return ($result !== null);
    }
    public function listaevaluaciones()
    {
        $this->db->select('*');
        $this->db->from('evaluaciones');
        $this->db->where('estado','activo');
        return $this->db->get();
    }
    public function recuperarevaluaciones($idevaluaciones)
    {
        $this->db->select('*');
        $this->db->from('evaluaciones');
        $this->db->where('idEvaluacion', $idevaluaciones);

        return $this->db->get();
    }
    public function recuperarPreguntas($idEvaluacion)
    {
        $this->db->where('idEvaluacion', $idEvaluacion);
        $query = $this->db->get('preguntas');

        return $query->result();
    }

    public function recuperarOpcionesRespuesta($idPregunta)
    {
        $this->db->where('idPregunta', $idPregunta);
        $query = $this->db->get('opcionesrespuesta');

        return $query->result();
    }
    public function modificarEvaluacion($idEvaluacion, $data)
    {
        $this->db->where('idEvaluacion', $idEvaluacion);
        $this->db->update('evaluaciones', $data);
    }

    // Función para modificar datos de una pregunta
    public function modificarPregunta($idPregunta, $data)
    {
        $this->db->where('idPregunta', $idPregunta);
        $this->db->update('preguntas', $data);
        
        // Obtener el ID de la pregunta después de la actualización
        $updatedIdPregunta = $this->db->affected_rows() > 0 ? $idPregunta : NULL;
    
        return $updatedIdPregunta;
    }

    // Función para modificar datos de una opción de respuesta
    public function modificarRespuesta($idOpcion, $idPregunta, $dataRespuesta) {
        if ($idOpcion) {
            // Actualizar respuesta existente
            $this->db->where('idOpcion', $idOpcion);
            $this->db->update('opcionesrespuesta', $dataRespuesta);
            return $idOpcion;
        } else {
            // Insertar nueva respuesta
            $dataRespuesta['idPregunta'] = $idPregunta; // Asegúrate de asignar idPregunta
            $this->db->insert('opcionesrespuesta', $dataRespuesta);
            return $this->db->insert_id();
        }
    }
    public function deshabilitarEvaluacion($idEvaluacion) {
        // Supongamos que 'evaluaciones' es el nombre de tu tabla en la base de datos
        $this->db->where('idEvaluacion', $idEvaluacion);

        // Actualizar el estado a "inactivo" (o el valor que estés usando para deshabilitado)
        $data = array('estado' => 'inactivo');
        $this->db->update('evaluaciones', $data);

        // Verificar si la actualización fue exitosa
        return $this->db->affected_rows() > 0;
    }
    public function listaevaluacionesdes()
    {
        $this->db->select('*');
        $this->db->from('evaluaciones');
        $this->db->where('estado','inactivo');
        return $this->db->get();
    }
    public function modificarevaluaciones($idevaluaciones, $data)
    {
        $this->db->where('idEvaluacion', $idevaluaciones);
        $this->db->update('evaluaciones', $data);
    }
}

