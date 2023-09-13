
<?php
class empleado_model extends CI_Model
{
    public function listaempleados()
    {
        $this->db->select('*');
        $this->db->from('empleado');
        $this->db->where('estado','1');
        return $this->db->get();
    }
    public function listaempleadosdes()
    {
        $this->db->select('*');
        $this->db->from('empleado');
        $this->db->where('estado','0');
        return $this->db->get();
    }
    public function agregarempleado($data)
    {
        $this->db->insert('empleado', $data);
    }

    public function recuperarempleado($idempleado)
    {
        $this->db->select('*');
        $this->db->from('empleado');
        $this->db->where('id', $idempleado);

        return $this->db->get();
    }
    public function modificarempleado($idempleado, $data)
    {
        $this->db->where('id', $idempleado);
        $this->db->update('empleado', $data);
    }
    public function eliminarempleado($idempleado)
    {
        $this->db->where('id', $idempleado);
        $this->db->delete('empleado');
    }

   
}
