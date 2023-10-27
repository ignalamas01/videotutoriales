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

    // public function listainscritos()
    // {
    //     $this->db->select('*');
    //     $this->db->from('suscripciones');
    //     //$this->db->where('estado','1');
    //     return $this->db->get();
    // }

    // public function obtenerInscritos() {
    //     $this->db->select('*');
    //     $this->db->from('suscripciones');
    //     $query = $this->db->get();
    //     return $query->result();
    // }
    public function listainscritos($curso_id = null)
    {
        $this->db->select('suscripciones.*, estudiante.nombre AS nombre_estudiante, cursos.titulo AS titulo_curso');
        $this->db->from('suscripciones');
        $this->db->join('estudiante', 'estudiante.id = suscripciones.idEstudiante');
        $this->db->join('cursos', 'cursos.id = suscripciones.idCurso');
        
        // Agregar una condición para filtrar por curso si se proporciona un ID de curso.
        if ($curso_id !== null) {
            $this->db->where('cursos.id', $curso_id);
        }
    
        // Puedes agregar condiciones adicionales si es necesario, por ejemplo, para filtrar por estado.
    
        return $this->db->get();
    }
    
    
    
}


