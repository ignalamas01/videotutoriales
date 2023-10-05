<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Evaluaciones_estudiante_model extends CI_Model
{
    public function obtener_ultima_evaluacion()
    {
        // Ajusta la consulta según tu esquema de base de datos
        $this->db->select('idEvaluacion, tituloEvaluacion, descripcionEvaluacion');
        $this->db->from('evaluaciones');
        $this->db->order_by('fechaRegistro', 'DESC');
        $this->db->limit(1);

        $query = $this->db->get();
        // $sql = $this->db->last_query();  // Obtiene la última consulta SQL ejecutada
        // echo $sql;  // Imprime la consulta SQL (elimina esto en producción)
        // $result = $query->row_array();
    
        // var_dump($result);  // Imprime el resultado (elimina esto en producción)
    

        return $query->row_array();
    }

    public function obtener_preguntas_evaluacion($idEvaluacion)
    {
        // Ajusta la consulta según tu esquema de base de datos
        $this->db->select('idPregunta, enunciadoPregunta,idEvaluacion,puntajePregunta');
        $this->db->from('preguntas');
        $this->db->where('idEvaluacion', $idEvaluacion);
    
        $query = $this->db->get();
    
        $preguntas = $query->result_array();
    
        // Obtener opciones de respuesta para cada pregunta
        foreach ($preguntas as &$pregunta) {
            $pregunta['opciones'] = $this->obtener_opciones_respuesta($pregunta['idPregunta']);
        }
    
        return $preguntas;
    }
public function obtener_opciones_respuesta($idPregunta)
    {
        $this->db->select('textoOpcion');
        $this->db->from('opcionesrespuesta');
        $this->db->where('idPregunta', $idPregunta);

        $query = $this->db->get();

        return $query->result_array();
    }
    public function insertar_respuestas($data) {
        // Verificar que los datos necesarios estén presentes
        if (!isset($data['idEvaluacion']) || !isset($data['idEstudiante']) || !isset($data['idPregunta']) || !isset($data['respuesta']) || !isset($data['puntajeObtenido'])) {
            throw new RuntimeException('Faltan datos necesarios para procesar la evaluación.');
        }
    
        // Verificar que la evaluación existe
        if (!$this->evaluacion_existe($data['idEvaluacion'])) {
            throw new RuntimeException('La evaluación especificada no existe.');
        }
    
        // Verificar que el estudiante existe
        if (!$this->estudiante_existe($data['idEstudiante'])) {
            throw new RuntimeException('El estudiante especificado no existe.');
        }
    
        // Agregar la fecha actual y el estado
        $data['fechaRespuesta'] = date('Y-m-d H:i:s');
        $data['estado'] = 'pendiente'; // O el valor que desees asignar
    
        // Insertar en la base de datos
        $this->db->insert('respuestasestudiante', $data);
    
        // Devolver el ID de la nueva respuesta (si es necesario)
        return $this->db->insert_id();
    }
    
    // Verificar si la evaluación existe
    private function evaluacion_existe($idEvaluacion) {
        $this->db->from('evaluaciones');
        $this->db->where('idEvaluacion', $idEvaluacion);
        $query = $this->db->get();
        return $query->num_rows() > 0;
    }
    
    // Verificar si el estudiante existe
    private function estudiante_existe($idEstudiante) {
        $this->db->from('estudiantes');
        $this->db->where('idEstudiante', $idEstudiante);
        $query = $this->db->get();
        return $query->num_rows() > 0;
    }
    
    
}
