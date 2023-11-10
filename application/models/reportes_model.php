<?php
class Reportes_model extends CI_Model {
    public function __construct() {
        parent::__construct();
    }

    
    
    public function obtener_estudiantes_cursos() {
        $this->db->select('CONCAT(e.nombre, " ", e.primerApellido, " ", e.segundoApellido) AS nombre_estudiante, 
                          COUNT(DISTINCT s.idSuscripcion) AS cantidad_cursos, 
                          GROUP_CONCAT(DISTINCT c.titulo) AS titulos_cursos', FALSE);
        $this->db->from('estudiante e');
        $this->db->join('suscripciones s', 'e.id = s.idEstudiante');
        $this->db->join('cursos c', 's.idCurso = c.id');
        $this->db->where('s.estado', 'activo');
        $this->db->where('s.estado_manual', 'activo');
        $this->db->group_by('e.id, e.nombre, e.primerApellido, e.segundoApellido');
        $this->db->having('COUNT(DISTINCT s.idSuscripcion) > 0', NULL, FALSE);
    
        $query = $this->db->get();
    
        return $query->result();
    }
   public function obtener_cursos_activos()   {
    $data['cursos'] = $this->cursos_model->listacursos(); // Asumiendo que tienes un método en tu modelo para obtener los datos
        $this->db->select('id, titulo');
        $this->db->from('cursos');
        $this->db->where('estado', 'activo');
        $query = $this->db->get();

        return $query->result();
    }
}

    
    
    




