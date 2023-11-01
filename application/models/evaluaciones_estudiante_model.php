<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Evaluaciones_estudiante_model extends CI_Model
{
    public function obtener_evaluacion_por_curso_seccion($idCurso, $idSeccion = null, $idEvaluacion = null)
    {
        // Agrega la condición para idCurso y idSeccion
        $this->db->select('idEvaluacion, idCurso, tituloEvaluacion, descripcionEvaluacion, puntajeTotal');
        $this->db->from('evaluaciones');
        $this->db->where('idCurso', $idCurso);
    
        if ($idSeccion !== null) {
            $this->db->where('idSeccion', $idSeccion);
        } else {
            $this->db->where('idSeccion', null);
        }
    
        // Agrega la condición para idEvaluacion si se proporciona
        if ($idEvaluacion !== null) {
            $this->db->where('idEvaluacion', $idEvaluacion);
        }
    
        $query = $this->db->get();
    
        if ($query->num_rows() > 0) {
            return $query->row_array();
        }
    
        return null;
    }
    public function obtener_ultima_evaluacion()
    {
        // Ajusta la consulta según tu esquema de base de datos
        $this->db->select('idEvaluacion, tituloEvaluacion, descripcionEvaluacion, puntajeTotal');
        $this->db->from('evaluaciones');
        $this->db->order_by('fechaRegistro', 'DESC');
        $this->db->limit(1);

        $query = $this->db->get();
        // $sql = $this->db->last_query();  // Obtiene la última consulta SQL ejecutada
        // echo $sql;  // Imprime la consulta SQL (elimina esto en producción)
        // $result = $query->row_array();
    
        // var_dump($result);  // Imprime el resultado (elimina esto en producción)
    

        return $query->row_array();
    }

    public function obtener_preguntas_evaluacion($idEvaluacion)
{
    $this->db->select('p.idPregunta, p.enunciadoPregunta, p.idEvaluacion, p.puntajePregunta, o.idOpcion as idOpcionCorrecta');
    $this->db->from('preguntas p');
    $this->db->join('opcionesrespuesta o', 'p.idPregunta = o.idPregunta AND o.esCorrecta = 1', 'left');
    $this->db->where('p.idEvaluacion', $idEvaluacion);

    $query = $this->db->get();

    $preguntas = $query->result_array();

    // Obtener opciones de respuesta para cada pregunta
    foreach ($preguntas as &$pregunta) {
        $pregunta['opciones'] = $this->obtener_opciones_respuesta($pregunta['idPregunta']);
    }

    return $preguntas;
}

public function obtener_opciones_respuesta($idPregunta)
    {
        $this->db->select('textoOpcion, idOpcion');//quitar el id opcion  o ocultarlo
        $this->db->from('opcionesrespuesta');
        $this->db->where('idPregunta', $idPregunta);

        $query = $this->db->get();

        return $query->result_array();
    }
    public function insertar_respuestas($data) {
        // Verificar que los datos necesarios estén presentes
        if (!isset($data['idEvaluacion']) || !isset($data['idEstudiante']) || !isset($data['idPregunta']) || !isset($data['respuesta']) || !isset($data['puntajeObtenido'])|| !isset($data['idOpcion'])) {
            throw new RuntimeException('Faltan datos necesarios para procesar la evaluación.');
        }
    
        // Verificar que la evaluación existe
        if (!$this->evaluacion_existe($data['idEvaluacion'])) {
            throw new RuntimeException('La evaluación especificada no existe.');
        }
    
        // Verificar que el estudiante existe
        if (!$this->estudiante_existe($data['idEstudiante'])) {
            throw new RuntimeException('El estudiante especificado no existe.');
        }
    
        // Agregar la fecha actual y el estado
        $data['fechaRespuesta'] = date('Y-m-d H:i:s');
        $data['estado'] = 'pendiente'; // O el valor que desees asignar
    
        // Insertar en la base de datos
        $this->db->insert('respuestasestudiante', $data);
    
        // Devolver el ID de la nueva respuesta (si es necesario)
        return $this->db->insert_id();
    }
    
    // Verificar si la evaluación existe
    private function evaluacion_existe($idEvaluacion) {
        $this->db->from('evaluaciones');
        $this->db->where('idEvaluacion', $idEvaluacion);
        $query = $this->db->get();
        return $query->num_rows() > 0;
    }
    
    // Verificar si el estudiante existe
    private function estudiante_existe($idEstudiante) {
        $this->db->from('estudiantes');
        $this->db->where('idEstudiante', $idEstudiante);
        $query = $this->db->get();
        return $query->num_rows() > 0;
    }
    public function obtener_evaluacion_activa($idCurso, $idSeccion) {
        $this->db->select('*');
        $this->db->from('evaluaciones');
        $this->db->where('idCurso', $idCurso);
        $this->db->where('idSeccion', $idSeccion);
        $this->db->where('estado', 'activo');
        $this->db->order_by('fechaInicio', 'desc'); // Ordenar por fechaInicio descendente para obtener la última evaluación activa
        $this->db->limit(1);
    
        return $this->db->get()->row_array();
    }
    
    
//     public function obtener_puntaje_total($idEvaluacion, $idEstudiante) {
//         // Obtener respuestas del estudiante para la evaluación
//     $$this->db->select('re.idRespuesta, re.idPregunta, re.respuesta, op.esCorrecta');
//     $this->db->from('respuestasestudiante re');
//     $this->db->join('opcionesrespuesta op', 're.idOpcion = op.idOpcion', 'left'); // Join con opcionesrespuesta
//     $this->db->where('re.idEvaluacion', $idEvaluacion);
//     $this->db->where('re.idEstudiante', $idEstudiante);
//     $query = $this->db->get();
//     $respuestas = $query->result_array();

//     // Calcular el puntaje total
//     $puntajeTotal = 0;
//     foreach ($respuestas as $respuesta) {
//         // Verificar si la respuesta es correcta y sumar puntaje
//         if ($respuesta['respuesta'] == $respuesta['esCorrecta']) {
//             $puntajeTotal++;
//         }
//     }

//     return $puntajeTotal;

// }
public function es_opcion_correcta($idOpcion)
{
    // Tu lógica para determinar si $idOpcion es la opción correcta

    // Devuelve true si es correcta, false si no es correcta
    return $esCorrecta;
}
public function obtener_id_estudiante($idUsuario) {
    // Realiza la consulta para obtener el idEstudiante asociado al idUsuario
    $this->db->select('id');
    $this->db->where('idUsuario', $idUsuario);
    $query = $this->db->get('estudiante');

    // Verifica si se encontraron resultados
    if ($query->num_rows() > 0) {
        // Retorna el idEstudiante encontrado
        $row = $query->row();
        return $row->id;
    } else {
        // Retorna un valor indicando que no se encontró el idEstudiante
        return null;
    }
}

public function insertar_puntaje($idEvaluacion, $idEstudiante, $puntajeTotal, $idCurso) {
    
    $data = array(
        'idEvaluacion' => $idEvaluacion,
        'idEstudiante' => $idEstudiante,
        'puntajeTotal' => $puntajeTotal,
        'fechaRegistro' => date('Y-m-d H:i:s'),
        'idCurso' => $idCurso
    );
    // var_dump($idEstudiante);
    $this->db->insert('puntajesevaluacion', $data);
    return $this->db->insert_id(); // Devuelve el ID del puntaje recién insertado
}

}
