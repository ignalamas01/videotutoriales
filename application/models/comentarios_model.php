<?php

class Comentarios_model extends CI_Model {


    // public function crearComentario($idForo, $idUsuario, $contenido) {
    //     // Iniciar una transacción
    //     $this->db->trans_start();
    
    //     // Obtén la fecha y hora actual
    //     $fechaHora = date('Y-m-d H:i:s');
    
    //     // Crea un arreglo con los datos del comentario
    //     $comentarioData = array(
    //         'idForo' => $idForo,
    //         'idUsuario' => $idUsuario,
    //         'contenido' => $contenido,
    //         'fechaHora' => $fechaHora
    //     );
    
    //     // Inserta el comentario en la base de datos
    //     $this->db->insert('comentario', $comentarioData);
    
    //     // Finaliza la transacción
    //     $this->db->trans_complete();
    
    //     // Verifica el estado de la transacción
    //     if ($this->db->trans_status() === false) {
    //         // Algo salió mal, por lo que deshacemos la transacción
    //         $this->db->trans_rollback();
    //         return false;
    //     } else {
    //         // La inserción fue exitosa, por lo que confirmamos la transacción
    //         $this->db->trans_commit();
    //         return $this->db->insert_id(); // Devuelve el ID del comentario insertado
    //     }
    // }
    
    
        public function crearComentario($idForo, $idUsuario, $contenido) {
            // Obtén la fecha y hora actual
            $fechaHora = date('Y-m-d H:i:s');
    
            // Crea un arreglo con los datos del comentario
            $comentarioData = array(
                'idForo' => $idForo,
                'idUsuario' => $idUsuario,
                'contenido' => $contenido,
                'fechaHora' => $fechaHora
            );
    
            // Inserta el comentario en la base de datos
            $this->db->insert('comentario', $comentarioData);
    
            // Verifica si la inserción fue exitosa
            if ($this->db->affected_rows() > 0) {
                return $this->db->insert_id(); // Devuelve el ID del comentario insertado
            } else {
                return false; // La inserción falló
            }
        }

        

    public function obtenerComentarios() {
        // Realiza una consulta a la base de datos para obtener los comentarios
        $query = $this->db->get('comentario'); // Asume que 'comentario' es el nombre de tu tabla

        // Verifica si se encontraron resultados
        if ($query->num_rows() > 0) {
            return $query->result(); // Devuelve un arreglo de objetos
        } else {
            return array(); // Devuelve un arreglo vacío si no hay resultados
        }
    }

    
    
}



