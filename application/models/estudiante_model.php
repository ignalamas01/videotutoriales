
<?php
class estudiante_model extends CI_Model
{
    public function listaestudiante()
    {
        $this->db->select('*');
        $this->db->from('estudiante');
        $this->db->where('estado','1');
        return $this->db->get();
    }
    public function listaestudiantedes()
    {
        $this->db->select('*');
        $this->db->from('estudiante');
        $this->db->where('estado','0');
        return $this->db->get();
    }
    public function agregarestudiante($data)
    {
        $this->db->insert('estudiante', $data);
    }

    public function recuperarestudiante($idestudiante)
    {
        $this->db->select('*');
        $this->db->from('estudiante');
        $this->db->where('id', $idestudiante);

        return $this->db->get();
    }
    public function modificarestudiante($idestudiante, $data)
    {
        $this->db->where('id', $idestudiante);
        $this->db->update('estudiante', $data);
    }
    public function eliminarestudiante($idestudiante)
    {
        $this->db->where('id', $idestudiante);
        $this->db->delete('estudiante');
    }

   
}
