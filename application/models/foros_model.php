<?php
class Foros_model extends CI_Model {
    public function crearForo($idUsuario, $titulo, $descripcion, $idEmpleado = null, $idEstudiante = null) {
        $data = array(
            'titulo' => $titulo,
            'descripcion' => $descripcion,
            'fechaHora' => date('Y-m-d H:i:s'), // Obtener la fecha y hora actual
            'idUsuario' => $idUsuario,
        );
    
        // Verificar el tipo de usuario
        $tipoUsuario = $this->session->userdata('tipo');
        if ($tipoUsuario == 'empleado') {
            $data['empleado_id'] = $idEmpleado;
            $data['estudiante_id'] = null; // Puedes establecerlo como null o algún otro valor según tus necesidades
        } elseif ($tipoUsuario == 'estudiante') {
            $data['empleado_id'] = null; // Puedes establecerlo como null o algún otro valor según tus necesidades
            $data['estudiante_id'] = $idEstudiante;
        }
    
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
