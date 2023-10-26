
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

    public function obtener_evaluacion_por_curso_seccion($idCurso, $idSeccion = null, $idEvaluacion = null)
    {
        // Agrega la condición para idCurso y idSeccion
        $this->db->select('idEvaluacion, tituloEvaluacion, descripcionEvaluacion, puntajeTotal');
        $this->db->from('evaluaciones');
        $this->db->where('idCurso', $idCurso);
    
        if ($idSeccion !== null) {
            $this->db->where('idSeccion', $idSeccion);
        } else {
            $this->db->where('idSeccion', null);
        }
    
        // Agrega la condición para idEvaluacion si se proporciona
        if ($idEvaluacion !== null) {
            $this->db->where('idEvaluacion', $idEvaluacion);
        }
    
        $query = $this->db->get();
    
        if ($query->num_rows() > 0) {
            return $query->row_array();
        }
    
        return null;
    }

}    














