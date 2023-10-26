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
    }

?>