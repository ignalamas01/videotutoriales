
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

   
}
