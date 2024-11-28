<?php

class Graduados_model extends CI_Model {
    public function __construct() {
        parent::__construct();
    }

    public function obtener_estudiantes_completos($fecha_inicio = null, $fecha_fin = null) {
        $this->db->select('CONCAT(e.nombre, " ", e.primerApellido, " ", e.segundoApellido) AS nombreCompleto');
        $this->db->select('c.titulo AS tituloCurso');
        $this->db->select('p.porcentajeCompletado');
        $this->db->from('estudiante e');
        $this->db->join('progreso_usuario p', 'e.id = p.idEstudiante', 'left');
        $this->db->join('cursos c', 'p.idCurso = c.id', 'left');
        $this->db->where('p.porcentajeCompletado', 100); // Solo estudiantes que completaron el curso
    
        // Filtrar por fechas de actualización del progreso
        if ($fecha_inicio) {
            $this->db->where('p.fechaActualizacion >=', $fecha_inicio);
        }
        if ($fecha_fin) {
            $this->db->where('p.fechaActualizacion <=', $fecha_fin);
        }
    
        $query = $this->db->get();
        return $query->result();
    }
}

    
    
    
    



