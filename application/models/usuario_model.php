
<?php
class usuario_model extends CI_Model
{
    // public function validar($login,$password)
    // {
    //     $this->db->select('*');
    //     $this->db->from('usuario');
    //     $this->db->where('login',$login);
    //     $this->db->where('password',$password);
    //     return $this->db->get();
    // }
    public function validar($login, $password)
{
    $this->db->select('*');
    $this->db->from('usuario');
    
    // Cambia la condición para que busque en ambos campos (login o email)
    $this->db->where('login', $login);
    $this->db->or_where('email', $login); // Añade esta línea para buscar también por correo
    
    // También verifica que la contraseña coincida
    $this->db->where('password', $password);
    
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
   
    public function set_reset_token($idUsuario, $token, $expiration) {
        $data = [
            'reset_token' => $token,
            'reset_token_expiration' => $expiration
        ];
        $this->db->where('idUsuario', $idUsuario);
        $this->db->update('usuario', $data);
    }
    
    public function get_user_by_token($token) {
        return $this->db->get_where('usuario', ['reset_token' => $token])->row();
    }
    
    public function update_password($idUsuario, $new_password) {
        log_message('debug', "Actualizando contraseña para el usuario ID: $idUsuario con la nueva contraseña.");
    
        $data = array(
            'password' => $new_password,
            'fechaActualizacion' => date('Y-m-d H:i:s')
        );
    
        $this->db->where('idUsuario', $idUsuario);
        if ($this->db->update('usuario', $data)) {
            log_message('debug', "Contraseña actualizada correctamente para el usuario ID: $idUsuario.");
            return true;
        } else {
            log_message('error', "Error al actualizar la contraseña para el usuario ID: $idUsuario.");
            return false;
        }
    }
    
    
    
    public function clear_reset_token($idUsuario) {
        $data = array(
            'reset_token' => null,
            'reset_token_expiration' => null
        );
    
        $this->db->where('idUsuario', $idUsuario);
        return $this->db->update('usuario', $data);
    }
    
    
   
    
   
}
