<?php
class Inscripciones_model extends CI_Model {
    public function __construct() {
        parent::__construct();
    }

    // Método para insertar una inscripción en la base de datos
    public function insertar_inscripcion($data) {
        $this->db->insert('suscripciones', $data);
        
        if ($this->db->affected_rows() > 0) {
            return $this->db->insert_id();
        } else {
            return false;
        }
    }

    
    // Otros métodos relacionados con inscripciones, como obtener inscripciones, actualizar, eliminar, etc.
     public function obtener_curso_por_id($idCurso) {
        $this->db->select('*');
        $this->db->from('cursos');
        $this->db->where('id', $idCurso);
        $query = $this->db->get();
        
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return null;
        }
    }
}


