
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

    // public function recuperarempleado($idempleado)
    // {
    //     $this->db->select('*');
    //     $this->db->from('empleado');
    //     $this->db->where('id', $idempleado);

    //     return $this->db->get();
    // }
    public function recuperarempleado($idempleado)
    {
        $this->db->select('empleado.*, usuario.email');
        $this->db->from('empleado');
        $this->db->join('usuario', 'empleado.idUsuario = usuario.idUsuario');
        $this->db->where('empleado.id', $idempleado);
        
        return $this->db->get();  // Devuelve el objeto de consulta completo
    }
    
    

    public function modificarempleado($idempleado, $data)
    {
        $this->db->where('id', $idempleado);
        $this->db->update('empleado', $data);
    }
    public function eliminarempleado($idempleado)
    {
        // $this->db->where('id', $idempleado);
        // $this->db->delete('empleado');
        $this->db->trans_start(); // Iniciar transacción

        // Obtener el ID de usuario asociado al empleado
        $this->db->select('idUsuario');
        $this->db->where('id', $idempleado);
        $query = $this->db->get('empleado');
        $result = $query->row();

        if ($result) {
            // Eliminar de la tabla 'empleado'
            $this->db->where('id', $idempleado);
            $this->db->delete('empleado');

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
    public function obtener_id_empleado_por_usuario($idUsuario)
    {
        $this->db->select('id');
        $this->db->where('idUsuario', $idUsuario);
        $query = $this->db->get('empleado');

        if ($query->num_rows() > 0) {
            $row = $query->row();
            return $row->id;
        } else {
            return null; // Retorna null si no se encuentra ningún empleado con ese idUsuario
        }
    }
    public function obtener_id($idUsuario) { ///agregado para reportes
        $this->db->select('id');
        $this->db->where('idUsuario', $idUsuario);
        $query = $this->db->get('empleado');
        $row = $query->row();

        return ($row) ? $row->id : null;
    }
    public function obtener_empleado_por_usuario($idUsuario) {
        // Seleccionar los datos del estudiante
        $this->db->select('nombre, primerApellido, segundoApellido');
        $this->db->where('idUsuario', $idUsuario);
        $query = $this->db->get('empleado');
        
        // Si se encuentra un resultado, devolverlo
        return $query->row();
    }
    public function actualizarFirmaEmpleado($idEmpleado, $filePath)
    {
        $this->db->where('id', $idEmpleado);
        $this->db->update('empleado', array('firma' => $filePath)); // 'firma' es el nombre de la columna en la tabla 'empleado' donde se almacena la ruta de la firma
    }
    public function modificarUsuario($idUsuario, $data)
{
    $this->db->where('idUsuario', $idUsuario);
    return $this->db->update('usuario', $data); // Actualiza la tabla 'usuario'
}

}
