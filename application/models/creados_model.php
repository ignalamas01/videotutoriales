<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Creados_model extends CI_Model {

    public function obtener_cursos_empleados() {
        $query = $this->db->get('v_cursos_creados_empleados');
        return $query->result();
    }

}


    
    
    



