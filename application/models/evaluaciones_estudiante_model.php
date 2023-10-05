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
    $this->db->select('enunciadoPregunta');
    $this->db->from('preguntas');
    $this->db->where('idEvaluacion', $idEvaluacion);

    $query = $this->db->get();

    return $query->result_array();
    // Obtener opciones de respuesta para cada pregunta
    foreach ($preguntas as &$pregunta) {
        $this->db->select('textoOpcion');
        $this->db->from('opcionesrespuesta');
        $this->db->where('idPregunta', $pregunta['idPregunta']);

        $query = $this->db->get();
        $opciones = $query->result_array();

        $pregunta['opciones'] = array_column($opciones, 'textoOpcion');
    }
    return $preguntas;
  }
}
