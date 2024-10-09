<?php
defined('BASEPATH') OR exit('No direct script access allowed');
// use Endroid\QrCode\QrCode;
// use Endroid\QrCode\Writer\PngWriter;
// use SimpleSoftwareIO\QrCode\Facades\QrCode;
require 'vendor/autoload.php'; // Asegúrate de que esta ruta sea correcta

use BaconQrCode\Renderer\ImageRenderer; // Esta línea está correcta
use BaconQrCode\Renderer\Image\ImagickImageBackEnd; // Esta línea está correcta
use BaconQrCode\Renderer\RendererStyle\RendererStyle; // Esta línea está correcta
use BaconQrCode\Writer; // Esta línea está correcta
class certificados_model extends CI_Model {

//     public function verificar_aprobacion_curso($idCurso, $idEstudiante) {
//         $this->db->select('COUNT(*) as total_evaluaciones');
//         $this->db->from('evaluaciones');
//         echo 'ID de Curso: ' . $idCurso . '<br>';
//         $this->db->where('idCurso', $idCurso);
//         $this->db->where('estado', 'activo'); // Ajusta según el valor que representa "activo" en tu base de datos
//         $this->db->where('idEvaluacion IN (SELECT idEvaluacion FROM puntajesevaluacion WHERE idEstudiante = '.$idEstudiante.' AND puntajeTotal > 60)');
    
//         $result = $this->db->get()->row();
//         echo 'Consulta SQL: ' . $this->db->last_query() . '<br>';
// echo 'Total de evaluaciones aprobadas: ' . $result->total_evaluaciones . '<br>';
//         return ($result && $result->total_evaluaciones > 0);
//     }
public function verificar_aprobacion_curso($idCurso, $idEstudiante) {
    $this->db->select('COUNT(DISTINCT idEvaluacion) as total_evaluaciones');
    $this->db->from('puntajesevaluacion');
    $this->db->where('idCurso', $idCurso);
    $this->db->where('idEstudiante', $idEstudiante);
    $this->db->where('puntajeTotal > 60');

    $result = $this->db->get()->row();

    // Obtener el número total de evaluaciones en el curso
    $total_evaluaciones_curso = $this->certificados_model->obtener_cantidad_evaluaciones_curso($idCurso);

    // Verificar si el estudiante ha aprobado todas las evaluaciones
    return ($result && $result->total_evaluaciones === $total_evaluaciones_curso);
}
    

    public function emitir_certificado($idCurso, $idEstudiante) {
        // Lógica para emitir el certificado (puedes almacenar en la base de datos, generar un archivo PDF, etc.)
        // Aquí puedes agregar acciones específicas según tus necesidades
        $codificacion = 'Cepra' . $idEstudiante . $idCurso;
        $data = array(
            'idEstudiante' => $idEstudiante,
            'idCurso' => $idCurso,
            
            'fechaEmision' => date('Y-m-d H:i:s'),
            'emitido' => 1, // Marcar como emitido
            
            'rutaImagen' => 'C:\xampp\htdocs\videotutoriales\uploads\certificados\imagen'.$codificacion.'.jpg', // Ajusta según tus necesidades
            'rutaPDF' => 'C:\xampp\htdocs\videotutoriales\uploads\certificados\certificado'.$codificacion.'.pdf', // Ajusta según tus necesidades
            'codificacion' => $codificacion
            // Puedes agregar más campos según tus requisitos
        );

        // Insertar datos en una tabla de certificados (ajusta según tu modelo de datos)
        $this->db->insert('certificados', $data);
    }
    public function obtener_evaluaciones_curso($idCurso) {
        $this->db->select('*');
        $this->db->from('evaluaciones');
        $this->db->where('idCurso', $idCurso);
    
        return $this->db->get()->result();
    }
    public function obtener_puntaje_total($idCurso, $idEvaluacion, $idEstudiante) {
        echo 'idCurso: ' . $idCurso . ', idEvaluacion: ' . $idEvaluacion . ', idEstudiante: ' . $idEstudiante . '<br>';
        $this->db->select('puntajeTotal');
        $this->db->from('puntajesevaluacion');
        $this->db->where('idCurso', $idCurso);
        $this->db->where('idEvaluacion', $idEvaluacion);
        $this->db->where('idEstudiante', $idEstudiante);
     
        // echo $this->db->last_query();
        $result = $this->db->get()->row();
    
        // Verificar si se obtuvo un resultado
        if ($result !== null) {
            echo 'PuntajeTotal obtenido: ' . $result->puntajeTotal . '<br>';
            return $result->puntajeTotal;
        } else {
            // echo 'No se encontró puntajeTotal en la evaluación.<br>';
            echo 'No se encontró alguna evaluacion realizada.<br>';
        }
    
        return 0; // Otra opción es devolver un valor predeterminado si no se encuentra el puntaje
    }
    public function generar_certificado_pdf($idCurso, $idEstudiante) {
    
        ob_start();
        
        // Definir un tamaño personalizado para la página
        $pdf = new FPDF('L', 'mm', array(297, 210)); // Ancho = 297mm, Altura = 210mm (A4 horizontal)
        $pdf->AddPage(); 
    
        // Agregar la imagen de fondo
        $pdf->Image('C:\xampp\htdocs\videotutoriales\adminlte\dist\img\fondo_certificado.jpeg', 0, 0, $pdf->GetPageWidth(), $pdf->GetPageHeight());
    
        // Agregar logo
        $pdf->Image('C:\xampp\htdocs\videotutoriales\adminlte\dist\img\logo_cepra.jpeg', 20, 10, 40);
    
        // Título del certificado
        $pdf->SetFont('Arial', 'B', 28);
        $pdf->Ln(30); 
        $pdf->Cell(0, 10, 'CERTIFICADO DE LOGRO', 0, 1, 'C');
    
        // Texto de otorgamiento
        $pdf->SetFont('Arial', 'I', 16);
        $pdf->Cell(0, 10, 'Este certificado se otorga a', 0, 1, 'C');
    
        // Nombre del estudiante
        $nombreEstudiante = $this->obtenerNombreEstudiante($idEstudiante);
        $apellidosEstudiante = $this->obtenerApellidosEstudiante($idEstudiante); 
        $pdf->SetFont('Arial', 'B', 24);
        $pdf->Cell(0, 10, utf8_decode($nombreEstudiante) . ' ' . utf8_decode($apellidosEstudiante), 0, 1, 'C');
    
        // Detalles del curso
        $nombreCurso = $this->obtenerNombreCurso($idCurso);
        $pdf->SetFont('Arial', 'I', 16);
        $pdf->Cell(0, 10, 'Por completar satisfactoriamente el curso de:', 0, 1, 'C');
        $pdf->SetFont('Arial', 'B', 22);
        $pdf->Cell(0, 10, utf8_decode($nombreCurso), 0, 1, 'C');
    
        // Fecha de emisión
        $pdf->SetFont('Arial', 'I', 14);
        $pdf->Cell(0, 10, utf8_decode('Fecha de emisión: ') . date('Y-m-d'), 0, 1, 'C');
    
        // Espacio para las firmas
        $pdf->Ln(20);
    
        // Firma 1 - Franz Callisaya Ortega
        $pdf->SetFont('Arial', '', 14);
        $pdf->Image('C:\xampp\htdocs\videotutoriales\uploads\empleados\firma_franz.png', 90, 110, 50, 20); // Firma como PNG
        $pdf->SetXY(50, 125); // Posicionar texto debajo de la firma
        $pdf->Cell(130, 10, '_____________________________', 0, 1, 'C');
        $pdf->Cell(215, 10, 'Alberto Chambi', 0, 1, 'C');
        $pdf->Cell(215, 10, 'Instructor del Curso', 0, 1, 'C');
    
        // Firma 2 - Alberto Chambi
        $pdf->Image('C:\xampp\htdocs\videotutoriales\uploads\empleados\firma_alberto.png', 200, 110, 50, 20); // Firma como PNG
        $pdf->SetXY(160, 125); // Posicionar texto debajo de la firma
        $pdf->Cell(130, 10, '_____________________________', 0, 1, 'C');
        $pdf->Cell(440, 10, 'Franz Callisaya Ortega', 0, 1, 'C');
        $pdf->Cell(440, 10, utf8_decode('Director Académico'), 0, 1, 'C');
    
        // Generar la codificación del certificado
        $codificacion = 'Cepra' . $idEstudiante . $idCurso . rand(100, 999);
    
        // Generar la URL de verificación
        $urlVerificacion = "https://tusitio.com/verificar-certificado?codigo=" . $codificacion;
    
        // Generar el código QR usando BaconQrCode
        // Crear el renderer
        $renderer = new BaconQrCode\Renderer\ImageRenderer(
            new BaconQrCode\Renderer\RendererStyle\RendererStyle(300), // Ajusta el tamaño del QR
            new BaconQrCode\Renderer\Image\ImagickImageBackEnd()
        );
        $writer = new BaconQrCode\Writer($renderer);
        
        // Generar y guardar el código QR
        $tempQrPath = 'C:/xampp/htdocs/videotutoriales/uploads/certificados/qr_temp.png';
        $writer->writeFile($urlVerificacion, $tempQrPath); // Guardar el QR generado en un archivo temporal
        
        // Usar Imagick para convertir la imagen a 8 bits
        $imagick = new \Imagick($tempQrPath);
        $imagick->setImageDepth(8); // Convertir a 8 bits
        $qrPath = 'C:/xampp/htdocs/videotutoriales/uploads/certificados/qr' . $codificacion . '.png';
        $imagick->writeImage($qrPath); // Guardar en la ubicación final
        
        // Limpiar archivo temporal
        unlink($tempQrPath); // Eliminar el archivo temporal
    
        // Agregar el código QR al PDF en la parte inferior izquierda
$pdf->Image($qrPath, 20, 135, 40, 40); // Ajusta las coordenadas y tamaño según lo necesites

// Mostrar la codificación debajo del QR
$pdf->SetXY(20, 175); // Ajustar las coordenadas
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(25, 10, utf8_decode('Codificación: '), 0, 0, 'C'); // Muestra la etiqueta
$pdf->Cell(15, 10, utf8_decode($codificacion), 0, 1, 'L'); // Muestra el código en la misma línea

    
        // Guardar el PDF en un archivo
        $pdfPath = 'C:\xampp\htdocs\videotutoriales\uploads\certificados\certificado' . $codificacion . '.pdf';
        $pdf->Output($pdfPath, 'F');
    
        // Convertir el PDF a imagen y guardarla
        $imagick->clear(); // Limpiar Imagick
        $imagick->readImage($pdfPath);
        $imagick->setImageFormat('jpeg');
        $imagePath = 'C:\xampp\htdocs\videotutoriales\uploads\certificados\imagen' . $codificacion . '.jpg';
        $imagick->writeImage($imagePath);
    
        // Descargar el PDF
        $pdf->Output('certificado.pdf', 'D'); 
        ob_end_flush();
    }
    

    
    // Obtener el nombre del estudiante desde la base de datos
    public function obtenerNombreEstudiante($idEstudiante) {
        $this->db->select('nombre');
        $this->db->from('estudiante');
        $this->db->where('id', $idEstudiante);
        $result = $this->db->get()->row();
    
        if ($result) {
            return $result->nombre;
        } else {
            return 'Nombre de Estudiante Desconocido';
        }
    }
    
    public function obtenerNombreCurso($idCurso) {
        $this->db->select('titulo'); // Ajusta el nombre de la columna según tu esquema de base de datos
        $this->db->from('cursos'); // Ajusta el nombre de la tabla según tu esquema de base de datos
        $this->db->where('id', $idCurso);
        $result = $this->db->get()->row();
    
        if ($result) {
            return $result->titulo;
        } else {
            return 'Nombre de Curso Desconocido';
        }
    }
    public function obtener_evaluaciones_activas_seccion($idCurso, $idSeccion = null) {
        $this->db->select('*');
        $this->db->from('evaluaciones');
        $this->db->where('idCurso', $idCurso);
        $this->db->where('estado', 'activo');
        
        if ($idSeccion !== null) {
            $this->db->where('idSeccion', $idSeccion);
        } else {
            $this->db->where('idSeccion IS NULL');
        }

        return $this->db->get()->result();
    }
    public function obtener_ultimo_certificado($idCurso, $idEstudiante) {
        $this->db->select('*');
        $this->db->from('certificados');
        $this->db->where('idCurso', $idCurso);
        $this->db->where('idEstudiante', $idEstudiante);
        $this->db->order_by('fechaEmision', 'DESC'); // Ordenar por fecha de emisión de forma descendente
        $this->db->limit(1); // Obtener solo el último certificado

        return $this->db->get()->row();
    }
    public function obtenerApellidosEstudiante($idEstudiante) {
        $this->db->select('primerApellido, segundoApellido');
        $this->db->from('estudiante');
        $this->db->where('id', $idEstudiante);
        $result = $this->db->get()->row();
    
        if ($result) {
            $primerApellido = $result->primerApellido;
            $segundoApellido = $result->segundoApellido;
            
            // Verificar si existe el segundoApellido y devolver la concatenación de ambos
            return $segundoApellido ? "$primerApellido $segundoApellido" : $primerApellido;
        } else {
            return 'Apellidos Desconocidos';
        }
    }
    public function obtener_certificados($idEstudiante) {
        // Asegúrate de ajustar el nombre de la columna idEstudiante según tu base de datos
        $this->db->where('idEstudiante', $idEstudiante);
        $this->db->where('emitido', 1);
    
        $query = $this->db->get('certificados');
    
        // Imprimir la consulta ejecutada
        // echo $this->db->last_query();
    
        // Imprimir los resultados de la consulta
        // var_dump($query->result());
    
        // Verificar si $query es un objeto de resultado de consulta
        if (!$query instanceof CI_DB_result) {
            // Si no es un objeto CI_DB_result, creemos uno vacío
            $emptyResult = new CI_DB_result();
            return $emptyResult;
        }
    
        return $query;
    }
    
    public function obtener_id_estudiante_por_id_usuario($idUsuario)
    {
        // Utiliza tu lógica para obtener el idEstudiante según el idUsuario
        $this->db->select('id');
        $this->db->where('idusuario', $idUsuario);
        $query = $this->db->get('estudiante');
        
        // Verifica si se encontró un estudiante
        if ($query->num_rows() > 0) {
            $estudiante = $query->row();
            return $estudiante->id;
        } else {
            return false;
        }
    }
    public function obtener_curso_por_id($idCurso) {
        $this->db->select('titulo');
        $this->db->from('cursos');
        $this->db->where('id', $idCurso);
        $query = $this->db->get();
    
        // Verificar si se obtuvo el curso
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return false;
        }
    }
    public function obtener_cantidad_evaluaciones_curso($idCurso) {
        $this->db->select('COUNT(*) as cantidad_evaluaciones');
        $this->db->from('evaluaciones');
        $this->db->where('idCurso', $idCurso);
        $this->db->where('estado', 'activo');
    
        // Puedes agregar condiciones adicionales si es necesario
        // Ejemplo: $this->db->where('estado', 'activo');
    
        $result = $this->db->get()->row();
    
        // Verificar si se obtuvo un resultado
        if ($result !== null) {
            return $result->cantidad_evaluaciones;
        } else {
            return 0; // o algún valor predeterminado si no hay evaluaciones para el curso
        }
    }
    public function obtener_evaluaciones_aprobadas($idCurso, $idEstudiante) {
        $this->db->select('COUNT(*) as total_evaluaciones');
        $this->db->from('evaluaciones');
        $this->db->where('idCurso', $idCurso);
        $this->db->where('estado', 'activo');
        $this->db->where('idEvaluacion IN (SELECT idEvaluacion FROM puntajesevaluacion WHERE idEstudiante = '.$idEstudiante.' AND puntajeTotal > 60)');
    
        $result = $this->db->get()->row();
    
        // Mostrar información para depuración
        // echo 'Consulta SQL: ' . $this->db->last_query() . '<br>';
        // echo 'Total de evaluaciones aprobadas: ' . $result->total_evaluaciones . '<br>';
    
        return $result->total_evaluaciones;
    }
    
    public function actualizar_progreso($idCurso) {
        // Aquí obtienes el idEstudiante y otros datos necesarios
        $idUsuario = $this->session->userdata('idusuario');
        $estudiante = $this->db->get_where('estudiante', array('idUsuario' => $idUsuario))->row();
    
        if ($estudiante) {
            $idEstudiante = $estudiante->id;
    
            // Obtener el número total de evaluaciones activas en el curso
            $evaluacionesActivas = $this->obtener_cantidad_evaluaciones_curso($idCurso);
    
            // Obtener el número de evaluaciones aprobadas por el estudiante
            $evaluacionesAprobadas = $this->obtener_evaluaciones_aprobadas($idCurso, $idEstudiante);
    
            // Verificar si hay evaluaciones activas antes de realizar la operación de división
            $porcentajeProgreso = ($evaluacionesActivas > 0) ? ($evaluacionesAprobadas / $evaluacionesActivas) * 100 : 0;
    
            // Verificar si ya existe una fila para este estudiante y curso
            $this->db->where('idEstudiante', $idEstudiante);
            $this->db->where('idCurso', $idCurso);
            $existingRow = $this->db->get('progreso_usuario')->row();
    
            if ($existingRow) {
                // Si ya existe, actualizar la fila existente
                $this->db->where('idEstudiante', $idEstudiante);
                $this->db->where('idCurso', $idCurso);
                $this->db->update('progreso_usuario', array('porcentajeCompletado' => $porcentajeProgreso));
            } else {
                // Si no existe, insertar una nueva fila
                $data = array(
                    'idEstudiante' => $idEstudiante,
                    'idCurso' => $idCurso,
                    'porcentajeCompletado' => $porcentajeProgreso
                );
                $this->db->insert('progreso_usuario', $data);
            }
    
            return $porcentajeProgreso;
        } else {
            return 0; // o algún valor predeterminado si no se encuentra el estudiante
        }
}
public function obtener_curso_y_seccion_por_id($idEvaluacion) {
    $this->db->select('evaluaciones.idCurso, evaluaciones.idSeccion, cursos.titulo as curso_titulo, secciones.nombre as seccion_nombre');
    $this->db->from('evaluaciones');
    $this->db->join('cursos', 'evaluaciones.idCurso = cursos.id', 'left');
    $this->db->join('secciones', 'evaluaciones.idSeccion = secciones.idSeccion', 'left');
    $this->db->where('evaluaciones.idEvaluacion', $idEvaluacion);
    $query = $this->db->get();

    // Verificar si se obtuvo el curso y la sección
    if ($query->num_rows() > 0) {
        return $query->row_array();  // Cambiamos row() a row_array()
    } else {
        // Devolver un array con valores predeterminados
        return array('idCurso' => null, 'idSeccion' => null, 'curso_titulo' => 'Sin título', 'seccion_nombre' => 'Sin sección');
    }
}






}