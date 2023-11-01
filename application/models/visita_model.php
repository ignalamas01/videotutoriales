<?php
class estudiante_model extends CI_Model
{
    public function actualizar_ultima_visita_curso($idEstudiante, $idCurso) {
        $data = array('ultimaVisitaCurso' => date('Y-m-d H:i:s'));
        $this->db->where('idEstudiante', $idEstudiante);
        $this->db->where('idCurso', $idCurso);
        $this->db->update('curso_estudiante', $data);
    }
    
    public function obtener_ultima_visita_curso($idEstudiante, $idCurso) {
        $this->db->select('ultimaVisitaCurso');
        $this->db->where('idEstudiante', $idEstudiante);
        $this->db->where('idCurso', $idCurso);
        $query = $this->db->get('curso_estudiante');
    
        if ($query->num_rows() > 0) {
            $row = $query->row();
            return $row->ultimaVisitaCurso;
        } else {
            return null;
        }
    }
}
