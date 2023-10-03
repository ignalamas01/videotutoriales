<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Evaluaciones_estudiante_model extends CI_Model
{
    public function obtener_ultima_evaluacion()
    {
        // Ajusta la consulta según tu esquema de base de datos
        $this->db->select('idEvaluacion,tituloEvaluacion');
        $this->db->from('evaluaciones');
        $this->db->order_by('fechaRegistro', 'DESC');
        $this->db->limit(1);

        $query = $this->db->get();

        return $query->row_array();
    }

    public function obtener_preguntas_evaluacion($idEvaluacion)
    {
        // Ajusta la consulta según tu esquema de base de datos
        $this->db->select('idPregunta, enunciadoPregunta');
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
}
