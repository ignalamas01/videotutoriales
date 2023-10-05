
<?php
class RespuestasEstudiante_model extends CI_Model
{
    public function insertar_respuestas($data)
    {
        $this->db->insert('respuestasestudiante', $data);
    }
}
