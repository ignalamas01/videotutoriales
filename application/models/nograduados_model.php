<?php
class Nograduados_model extends CI_Model {
    public function __construct() {
        parent::__construct();
        
    }

    public function obtener_estudiantes_no_graduados($fecha_inicio = null, $fecha_fin = null) {
        $this->db->select('CONCAT(e.nombre, " ", e.primerApellido, " ", e.segundoApellido) AS nombreCompleto');
        $this->db->select('c.titulo AS tituloCurso');
        $this->db->select('p.porcentajeCompletado');
        $this->db->from('estudiante e');
        $this->db->join('progreso_usuario p', 'e.id = p.idEstudiante', 'left');
        $this->db->join('cursos c', 'p.idCurso = c.id', 'left');
        $this->db->where('p.porcentajeCompletado <', 100);
        $this->db->or_where('p.porcentajeCompletado IS NULL'); // Para incluir estudiantes sin registros en progreso_usuario
        
        // Filtrar por fechas si se pasan como parámetros
        if ($fecha_inicio) {
            $this->db->where('e.fechaRegistro >=', $fecha_inicio);
        }
        if ($fecha_fin) {
            $this->db->where('e.fechaRegistro <=', $fecha_fin);
        }
    
        $query = $this->db->get();
        return $query->result();
    }
    
}
?>

    
    



