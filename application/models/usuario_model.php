
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
    public function get_user_by_email($email) {
        $this->db->where('email', $email);
        $query = $this->db->get('usuario');

        if ($query->num_rows() > 0) {
            return $query->row(); // Retorna los datos del usuario si existe
        } else {
            return false; // Retorna falso si no existe
        }
    }
   

   
}
