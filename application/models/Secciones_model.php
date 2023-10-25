<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Secciones_model extends CI_Model
{
    public function listasecciones()
    {
        // Obtener todas las secciones
        $this->db->select('*');
        $this->db->from('secciones');
        return $this->db->get();
    }

    public function obtener_seccion_por_id($idSeccion)
    {
        // Obtener una sección por su ID
        $this->db->select('*');
        $this->db->from('secciones');
        $this->db->where('idSeccion', $idSeccion);
        return $this->db->get()->row();
    }

    public function agregar_seccion($data)
{
    try {
        $this->db->insert('secciones', $data);

        if ($this->db->affected_rows() > 0) {
            // Inserción exitosa
            return $this->db->insert_id();  // Devuelve el ID de la última inserción
        } else {
            // Error en la inserción
            throw new Exception('Error en la inserción');
        }
    } catch (Exception $e) {
        // Captura de excepciones
        log_message('error', $e->getMessage());
        return false;  // o maneja de alguna manera según tus necesidades
    }
}
    public function modificar_seccion($idSeccion, $data)
    {
        // Modificar una sección por su ID
        $this->db->where('idSeccion', $idSeccion);
        $this->db->update('secciones', $data);

        // Verificar si la actualización fue exitosa
        return $this->db->affected_rows() > 0;
    }

    public function eliminar_seccion($idSeccion)
    {
        // Eliminar una sección por su ID
        $this->db->where('idSeccion', $idSeccion);
        $this->db->delete('secciones');

        // Verificar si la eliminación fue exitosa
        return $this->db->affected_rows() > 0;
    }
    public function obtener_secciones_por_curso($idCurso = null)
    {
        $this->db->select('secciones.*, cursos.titulo as tituloCurso');
        $this->db->from('secciones');
        $this->db->join('cursos', 'secciones.idCurso = cursos.id', 'left');
    
        // Si se proporciona un $idCurso, filtramos por ese curso
        if ($idCurso !== null) {
            $this->db->where('secciones.idCurso', $idCurso);
        }
    
        return $this->db->get()->result();
    }
}