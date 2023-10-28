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
        // $this->db->where('id', $idempleado);
        // $this->db->delete('empleado');
        $this->db->trans_start(); // Iniciar transacción

        // Obtener el ID de usuario asociado al empleado
        $this->db->select('idUsuario');
        $this->db->where('id', $idestudiante);
        $query = $this->db->get('estudiante');
        $result = $query->row();

        if ($result) {
            // Eliminar de la tabla 'empleado'
            $this->db->where('id', $idestudiante);
            $this->db->delete('estudiante');

            // Eliminar de la tabla 'usuario'
            $this->db->where('idUsuario', $result->idUsuario);
            $this->db->delete('usuario');
        }

        $this->db->trans_complete(); // Finalizar transacción

        return $this->db->trans_status(); // Devolver el estado de la transacción
    }
    public function agregarUsuario($data)
    {
        $this->db->insert('usuario', $data);
    }
    public function correoExiste($correo)
    {
        $this->db->where('email', $correo);
        $query = $this->db->get('usuario');

        return $query->num_rows() > 0;
    }
}
