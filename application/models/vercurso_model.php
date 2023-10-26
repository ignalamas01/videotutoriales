<?php
defined('BASEPATH') or exit('No direct script access allowed');

class vercurso_model extends CI_Model
{
    
        public function obtener_curso_por_id($idCurso) {
            $this->db->where('id', $idCurso);
            $query = $this->db->get('cursos');
    
            if ($query->num_rows() > 0) {
                return $query->row(); // Devuelve la primera fila (el curso)
            } else {
                return null;
            }
        }
        public function obtener_secciones_por_curso($idCurso) {
        $this->db->where('idCurso', $idCurso);
        $query = $this->db->get('secciones');

        if ($query->num_rows() > 0) {
            return $query->result(); // Devuelve todas las filas de secciones para el curso
        } else {
            return null;
        }
    }

    }

?>