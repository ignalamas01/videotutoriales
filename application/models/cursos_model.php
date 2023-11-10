
<?php
class cursos_model extends CI_Model
{
    public function listacursos()
    {
        $this->db->select('*');
        $this->db->from('cursos');
        $this->db->where('estado','1');
        return $this->db->get();
    }
   
    public function listacursosdes()
    {
        $this->db->select('*');
        $this->db->from('cursos');
        $this->db->where('estado','0');
        return $this->db->get();
    }
    public function agregarcursos($data)
    {
        $this->db->insert('cursos', $data);
    }

    public function recuperarcursos($idcursos)
    {
        $this->db->select('*');
        $this->db->from('cursos');
        $this->db->where('id', $idcursos);

        return $this->db->get();
    }
    // public function modificarcursos($idcursos, $data)
    // {
    //     $this->db->where('id', $idcursos);
    //     $this->db->update('cursos', $data);
    // }
    public function eliminarcursos($idcursos)
    {
        $this->db->where('id', $idcursos);
        $this->db->delete('cursos');
    }
    public function agregar_seccion($data)
    {
    try {
        $this->db->insert('secciones', $data);
        if ($this->db->affected_rows() > 0) {
            // Inserción exitosa
            return $this->db->insert_id();  // Devuelve el ID de la última inserción
        } else {
            // Error en la inserción
            throw new Exception('Error en la inserción');
        }
    } catch (Exception $e) {
        // Captura de excepciones
        log_message('error', $e->getMessage());
        return false;  // o maneja de alguna manera según tus necesidades
    }
    }
    public function agregarArchivo($data_archivo)
    {
        $this->db->insert('archivos', $data_archivo);
    }
    public function agregarVideo($data_video)
    {
    $this->db->insert('videos', $data_video);
    }

    public function obtener_secciones_por_curso($idCurso= null)
    {
        $this->db->select('*');
    $this->db->from('secciones');

    // Si se proporciona un $idCurso, filtramos por ese curso
    if ($idCurso !== null) {
        $this->db->where('idCurso', $idCurso);
    }
    //  else {
    //     // Si no se proporciona $idCurso, obtenemos todas las secciones
    //     $this->db->where('idCurso IS NULL OR idCurso = 0');
    // }

    return $this->db->get()->result();
    }

    public function listasecciones() {
        // Lógica para obtener las secciones
        $query = $this->db->get('secciones');
        return $query;
    }

    public function obtener_cursos_suscritos($idEstudiante)
    {
        $this->db->select('cursos.*');
        $this->db->from('suscripciones');
        $this->db->join('cursos', 'cursos.id = suscripciones.idCurso');
        $this->db->where('suscripciones.idEstudiante', $idEstudiante);
        $this->db->where('suscripciones.estado', 'activo');
        $this->db->where('suscripciones.estado_manual', 'activo');
        $this->db->where('suscripciones.fechaInicio <=', date('Y-m-d'));
        $this->db->where('suscripciones.fechaFin >=', date('Y-m-d'));
    
        return $this->db->get();  // Quita el método result() aquí
    }
    public function getSecciones($idCurso)
    {
        // Asumiendo 'idCurso' como la clave foránea en la tabla 'secciones'
        $this->db->where('idCurso', $idCurso);
        $query = $this->db->get('secciones');

        return $query->result();
    }

    public function getVideos($idSeccion)
    {
        // Asumiendo 'idSeccion' como la clave foránea en la tabla 'videos'
        $this->db->where('idSeccion', $idSeccion);
        $query = $this->db->get('videos');

        return $query->result();
    }

    public function getArchivos($idSeccion)
    {
        // Asumiendo 'idSeccion' como la clave foránea en la tabla 'archivos'
        $this->db->where('idSeccion', $idSeccion);
        $query = $this->db->get('archivos');

        return $query->result();
    }
    public function actualizarDatosVideos($idVideos, $titulos, $descripciones, $enlaces)
{
    // Asumiendo que 'videos' es el nombre de la tabla de videos
    for ($i = 0; $i < count($idVideos); $i++) {
        $data = [
            'tituloVideo' => $titulos[$i],
            'descripcionVideo' => $descripciones[$i],
            'enlaceVideo' => $enlaces[$i],
        ];

        $this->db->where('idVideo', $idVideos[$i]);
        $this->db->update('videos', $data);
    }
}


public function actualizarDatosArchivos($idArchivos, $nombres, $rutas)
{
    // Asumiendo que 'archivos' es el nombre de la tabla de archivos
    for ($i = 0; $i < count($idArchivos); $i++) {
        $data = [
            'nombreArchivo' => $nombres[$i],
            'rutaArchivo' => $rutas[$i],
        ];

        $this->db->where('idArchivo', $idArchivos[$i]);
        $this->db->update('archivos', $data);
    }
}
public function modificarcursos($idCurso, $data)
{
    echo "ID del Curso en el modelo: " . $idcursos . "<br>";
    // Actualizar datos generales de cursos
    $this->db->where('id', $idCurso);
    $this->db->update('cursos', $data);

    // Obtener las secciones actuales del curso
    $seccionesActuales = $this->getSecciones($idCurso);

    // Actualizar o insertar nuevas secciones
    foreach ($data['secciones'] as $seccion) {
        $idSeccion = $seccion['idSeccion'];

        // Verificar si la sección existe
        $seccionExistente = array_filter($seccionesActuales, function ($seccionActual) use ($idSeccion) {
            return $seccionActual->idSeccion == $idSeccion;
        });

        if (!empty($seccionExistente)) {
            // Si la sección ya existe, actualizarla
            $this->db->where('idSeccion', $idSeccion);
            $this->db->update('secciones', $seccion);
        } else {
            // Si la sección no existe, insertarla
            $seccion['idCurso'] = $idCurso;
            $this->db->insert('secciones', $seccion);
        }
    }
}
public function actualizarCursos($idcursos, $dataCursos)
{
    $this->db->where('id', $idcursos);
    $this->db->update('cursos', $dataCursos);
}

public function actualizarSecciones($idcursos, $secciones)
{
    foreach ($secciones as $seccion) {
        $idSeccion = isset($seccion['idSeccion']) ? $seccion['idSeccion'] : null;

        if (!empty($idSeccion)) {
            // Si el idSeccion no es nulo, intenta actualizar la sección existente
            $seccionExistente = $this->db->get_where('secciones', ['idSeccion' => $idSeccion])->row_array();

            if (!empty($seccionExistente)) {
                $this->db->where('idSeccion', $idSeccion);
                $this->db->update('secciones', $seccion);
            } else {
                // Si no se encuentra la sección, podría manejar esto de acuerdo a tus necesidades
                // Puedes lanzar una excepción, loggear un error, o manejarlo de otra manera
                log_message('error', 'Sección con idSeccion ' . $idSeccion . ' no encontrada para actualizar.');
            }
        } else {
            // Si el idSeccion es nulo, asume que es una nueva sección y la inserta
            $seccion['idCurso'] = $idcursos;
            $this->db->insert('secciones', $seccion);
        }
    }
}
public function actualizarCursosYSecciones($idCurso, $dataCursos, $secciones)
{
    // Comenzamos la transacción
    $this->db->trans_start();

    try {
        // Actualizar datos generales de cursos
        $this->actualizarCursos($idCurso, $dataCursos);

        // Actualizar o insertar nuevas secciones
        foreach ($secciones as $seccion) {
            $this->actualizarOInsertarSeccion($idCurso, $seccion);
        }

        // Completar la transacción
        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE) {
            // Si ocurrió un error durante la transacción, manejarlo según tus necesidades
            log_message('error', 'Error al actualizar cursos y secciones.');
        }
    } catch (Exception $e) {
        // Capturar cualquier excepción y manejarla según tus necesidades
        log_message('error', 'Excepción al actualizar cursos y secciones: ' . $e->getMessage());
    }
}

public function actualizarOInsertarSeccion($idCurso, $seccion)
{
    $idSeccion = isset($seccion['idSeccion']) ? $seccion['idSeccion'] : null;

    if (!empty($idSeccion)) {
        // Si el idSeccion no es nulo, intenta actualizar la sección existente
        $seccionExistente = $this->db->get_where('secciones', ['idSeccion' => $idSeccion])->row_array();

        if (!empty($seccionExistente)) {
            $this->db->where('idSeccion', $idSeccion);
            $this->db->update('secciones', $seccion);
        } else {
            // Si no se encuentra la sección, podría manejar esto de acuerdo a tus necesidades
            // Puedes lanzar una excepción, loggear un error, o manejarlo de otra manera
            log_message('error', 'Sección con idSeccion ' . $idSeccion . ' no encontrada para actualizar.');
        }
    } else {
        // Si el idSeccion es nulo, asume que es una nueva sección y la inserta
        $seccion['idCurso'] = $idCurso;
        $this->db->insert('secciones', $seccion);
    }
}
}














