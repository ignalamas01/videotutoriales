
<?php
class cursos_model extends CI_Model
{
    public function listacursos()
    {
        $this->db->select('*');
        $this->db->from('cursos');
        $this->db->where('estado','1');
        return $this->db->get();
    }
   
    public function listacursosdes()
    {
        $this->db->select('*');
        $this->db->from('cursos');
        $this->db->where('estado','0');
        return $this->db->get();
    }
    public function agregarcursos($data)
    {
        $this->db->insert('cursos', $data);
    }

    public function recuperarcursos($idcursos)
    {
        $this->db->select('*');
        $this->db->from('cursos');
        $this->db->where('id', $idcursos);

        return $this->db->get();
    }
    public function modificarcursos($idcursos, $data)
    {
        $this->db->where('id', $idcursos);
        $this->db->update('cursos', $data);
    }
    public function eliminarcursos($idcursos)
    {
        $this->db->where('id', $idcursos);
        $this->db->delete('cursos');
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
    public function agregarArchivo($data_archivo)
    {
        $this->db->insert('archivos', $data_archivo);
    }
    public function agregarVideo($data_video)
    {
    $this->db->insert('videos', $data_video);
    }

    public function obtener_secciones_por_curso($idCurso= null)
    {
        $this->db->select('*');
    $this->db->from('secciones');

    // Si se proporciona un $idCurso, filtramos por ese curso
    if ($idCurso !== null) {
        $this->db->where('idCurso', $idCurso);
    }
    //  else {
    //     // Si no se proporciona $idCurso, obtenemos todas las secciones
    //     $this->db->where('idCurso IS NULL OR idCurso = 0');
    // }

    return $this->db->get()->result();
    }

    public function listasecciones() {
        // Lógica para obtener las secciones
        $query = $this->db->get('secciones');
        return $query;
    }

    public function obtener_cursos_suscritos($idEstudiante)
    {
        $this->db->select('cursos.*');
        $this->db->from('suscripciones');
        $this->db->join('cursos', 'cursos.id = suscripciones.idCurso');
        $this->db->where('suscripciones.idEstudiante', $idEstudiante);
        $this->db->where('suscripciones.estado', 'activo');
        $this->db->where('suscripciones.estado_manual', 'activo');
        $this->db->where('suscripciones.fechaInicio <=', date('Y-m-d'));
        $this->db->where('suscripciones.fechaFin >=', date('Y-m-d'));
    
        return $this->db->get();  // Quita el método result() aquí
    }







































































































































    
    public function obtener_id_empleado_por_usuario($idUsuario) { ///agregado para reportes
        $this->db->select('id');
        $this->db->where('idUsuario', $idUsuario);
        $query = $this->db->get('empleado');
        $row = $query->row();

        return ($row) ? $row->id : null;
    }
    
}    














