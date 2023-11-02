<?php
class Foros_model extends CI_Model {
    public function crearForo($idUsuario, $titulo, $descripcion) {
        $data = array(
            'titulo' => $titulo,
            'descripcion' => $descripcion,
            'fechaHora' => date('Y-m-d H:i:s'), // Obtener la fecha y hora actual
            'idUsuario' => $idUsuario
        );

        $this->db->insert('foro', $data);

        return $this->db->insert_id(); // Devuelve el ID del foro recién creado
    }

    // Puedes agregar otros métodos aquí para obtener, actualizar o eliminar foros según tus necesidades.

    // Ejemplo: Obtener todos los foros
    public function obtenerForos() {
        // Realiza una consulta a la base de datos para obtener los foros
        $query = $this->db->get('foro'); // Asume que 'foro' es el nombre de tu tabla

        // Verifica si se encontraron resultados
        if ($query->num_rows() > 0) {
            return $query->result(); // Devuelve un arreglo de objetos
        } else {
            return array(); // Devuelve un arreglo vacío si no hay resultados
        }
        


    }
    
    
}
