
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
        $this->db->insert('secciones', $data);
        if ($this->db->affected_rows() > 0) {
            // Inserción exitosa
            echo 'Inserción exitosa';
        } else {
            // Error en la inserción
            echo $this->db->error();
        }
    }
    public function agregarArchivo($data)
    {
        $this->db->insert('archivos', $data);
    }
    public function agregarVideo($data)
{
    $this->db->insert('videos', $data);
}
}
