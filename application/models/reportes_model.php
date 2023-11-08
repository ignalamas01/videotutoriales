<?php
class Reportes_model extends CI_Model {
    public function __construct() {
        parent::__construct();
    }

    // Método para insertar una inscripción en la base de datos
    // public function insertar_inscripcion($data) {
    //     $this->db->insert('suscripciones', $data);
        
    //     if ($this->db->affected_rows() > 0) {
    //         return $this->db->insert_id();
    //     } else {
    //         return false;
    //     }
    // }
    public function insertar_inscripcion($data) {
        // Verificar si ya existe una suscripción activa para el estudiante y el curso
        $existing_subscription = $this->verificar_suscripcion_existente($data['idEstudiante'], $data['idCurso']);

        if ($existing_subscription) {
            // Si ya existe una suscripción activa, retornar un mensaje o valor indicando la duplicación
            return 'Ya existe una suscripción activa para este estudiante y curso.';
        }

        // No existe una suscripción activa, proceder con la inserción
        $this->db->insert('suscripciones', $data);

        if ($this->db->affected_rows() > 0) {
            // Commit the transaction if the insert was successful
            $this->db->trans_complete();
    
            // Check if the transaction was successful
            if ($this->db->trans_status() === FALSE) {
                // If the transaction failed, return false
                return false;
            } else {
                // If the transaction was successful, return the insert ID
                return $this->db->insert_id();
            }
        } else {
            // Rollback the transaction if the insert failed
            $this->db->trans_rollback();
            return false;
        }
    }
    public function verificar_suscripcion_existente($idEstudiante, $idCurso) {
        $this->db->select('*');
        $this->db->from('suscripciones');
        $this->db->where('idEstudiante', $idEstudiante);
        $this->db->where('idCurso', $idCurso);
        $this->db->where('estado', 'activo');
        $this->db->where('estado_manual', 'activo');
        $query = $this->db->get();

        return ($query->num_rows() > 0) ? true : false;
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
    
    // public function obtener_estudiantes_cursos() {
    //     $this->db->select('nombre_estudiante, COUNT(idCurso) AS cantidad_cursos');
    //     $this->db->from('v_estudiantes_cursos');
    //     $this->db->group_by('nombre_estudiante');
        
    //     $query = $this->db->get();
        
    //     return $query->result();
    // }
    public function obtener_estudiantes_cursos() {
        $this->db->select('estudiante.nombre AS nombre_estudiante, GROUP_CONCAT(DISTINCT cursos.titulo ORDER BY cursos.titulo ASC SEPARATOR \', \') AS titulos_cursos, COUNT(*) AS cantidad_cursos');
        $this->db->from('suscripciones');
        $this->db->join('estudiante', 'estudiante.id = suscripciones.idEstudiante');
        $this->db->join('cursos', 'cursos.id = suscripciones.idCurso');
        $this->db->group_by('suscripciones.idEstudiante');
    
        $query = $this->db->get();
    
        return $query->result();
    }
    
    public function obtener_cursos_inscritos_por_estudiante() {
        // Realiza una consulta para obtener los títulos de los cursos inscritos por cada estudiante
        $this->db->select('estudiante.nombre AS nombre_estudiante, GROUP_CONCAT(cursos.titulo) AS titulos_cursos');
        $this->db->from('suscripciones');
        $this->db->join('estudiante', 'estudiante.id = suscripciones.idEstudiante');
        $this->db->join('cursos', 'cursos.id = suscripciones.idCurso');
        $this->db->group_by('estudiante.id');
    
        $query = $this->db->get();
    
        return $query->result();
    }
    public function obtener_titulos_cursos_por_estudiante() {
        $this->db->select('estudiante.nombre AS nombre_estudiante, GROUP_CONCAT(DISTINCT cursos.titulo ORDER BY cursos.titulo ASC SEPARATOR \', \') AS titulos_cursos');
        $this->db->from('suscripciones');
        $this->db->join('estudiante', 'estudiante.id = suscripciones.idEstudiante');
        $this->db->join('cursos', 'cursos.id = suscripciones.idCurso');
        $this->db->group_by('suscripciones.idEstudiante');
    
        $query = $this->db->get();
    
        return $query->result();
    }
    
    
    
    
    
    
    
}


