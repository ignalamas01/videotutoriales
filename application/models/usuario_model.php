
<?php
class usuario_model extends CI_Model
{
    public function validar($login,$password)
    {
        $this->db->select('*');
        $this->db->from('usuario');
        $this->db->where('login',$login);
        $this->db->where('password',$password);
        return $this->db->get();
    }
    
   public function agregarusuario($data)
    {
        $this->db->insert('usuario', $data);
    }

   
}
