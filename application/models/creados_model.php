<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Creados_model extends CI_Model {

    // public function obtener_cursos_empleados() {
    //     $query = $this->db->get('v_cursos_creados_empleados');
    //     return $query->result();
    // }
    public function obtener_cursos_empleados($fecha_inicio = null, $fecha_fin = null) {
        $this->db->select('
            c.id, 
            GROUP_CONCAT(c.titulo SEPARATOR ", ") AS nombresCursos, 
            c.fechaRegistro, 
            c.fechaActualizacion, 
            CONCAT(e.nombre, " ", e.primerApellido, " ", e.segundoApellido) AS nombreCompleto, 
            e.seudonimo,
            COUNT(c.id) AS cantidadTotalCursosCreados
        ');
        $this->db->from('cursos c');
        $this->db->join('empleado e', 'c.idEmpleado = e.id', 'left'); // Relación con empleados
        $this->db->join('usuario u', 'e.idUsuario = u.idUsuario', 'left'); // Relación con usuarios
        $this->db->where('c.estado', 1); // Filtrar solo cursos activos
    
        // Filtrar por rango de fechas (si se pasan como parámetros)
        if ($fecha_inicio) {
            $this->db->where('c.fechaActualizacion >=', $fecha_inicio);
        }
        if ($fecha_fin) {
            $this->db->where('c.fechaActualizacion <=', $fecha_fin);
        }
    
        $this->db->group_by('e.id'); // Agrupar por empleado para contar los cursos
        $this->db->order_by('nombreCompleto', 'ASC'); // Ordenar por nombre del empleado
        $query = $this->db->get();
    
        return $query->result();
    }
    

}


    
    
    



