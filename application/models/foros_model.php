<?php
class Foros_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function crearForo($titulo, $descripcion, $estudiante_id, $empleado_id) {
        $data = array(
            'titulo' => $titulo,
            'descripcion' => $descripcion,
            'fechaHora' => date('Y-m-d H:i:s'), // Obtener la fecha y hora actual
            'estudiante_id' => $estudiante_id,
            'empleado_id' => $empleado_id,
            'estado' => 1 // Puedes establecer el estado predeterminado como "1" o "habilitado"
        );

        $this->db->insert('foro', $data);

        return $this->db->insert_id(); // Devuelve el ID del foro recién creado


        
    }

    // Puedes agregar otros métodos aquí para obtener, actualizar o eliminar foros según tus necesidades.

    // Ejemplo: Obtener todos los foros
    public function obtenerForos() {
        $this->db->select('*');
        $this->db->from('foro');
        $query = $this->db->get();
        return $query->result();
    }
}
