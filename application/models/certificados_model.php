<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class certificados_model extends CI_Model {

    public function verificar_aprobacion_curso($idCurso, $idEstudiante) {
        $this->db->select('COUNT(*) as total_evaluaciones');
        $this->db->from('evaluaciones');
        echo 'ID de Curso: ' . $idCurso . '<br>';
        $this->db->where('idCurso', $idCurso);
        $this->db->where('estado', 'activo'); // Ajusta según el valor que representa "activo" en tu base de datos
        $this->db->where('idEvaluacion IN (SELECT idEvaluacion FROM puntajesevaluacion WHERE idEstudiante = '.$idEstudiante.' AND puntajeTotal > 60)');
    
        $result = $this->db->get()->row();
        echo 'Consulta SQL: ' . $this->db->last_query() . '<br>';
echo 'Total de evaluaciones aprobadas: ' . $result->total_evaluaciones . '<br>';
        return ($result && $result->total_evaluaciones > 0);
    }
    

    public function emitir_certificado($idCurso, $idEstudiante) {
        // Lógica para emitir el certificado (puedes almacenar en la base de datos, generar un archivo PDF, etc.)
        // Aquí puedes agregar acciones específicas según tus necesidades
        $data = array(
            'idEstudiante' => $idEstudiante,
            'idCurso' => $idCurso,
            
            'fechaEmision' => date('Y-m-d H:i:s')
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
        // Configura el encabezado y pie de página si es necesario
        $pdf = new FPDF();
        $pdf->AddPage();
        $pdf->SetFont('Arial', 'B', 16);
    
        // Agregar el título del certificado
        $pdf->Cell(0, 10, 'CERTIFICADO', 0, 1, 'C');
    
        // Agregar detalles del estudiante (debes adaptar esto según tu base de datos)
        $nombreEstudiante = $this->obtenerNombreEstudiante($idEstudiante);
        $pdf->SetFont('Arial', 'I', 12);
        $pdf->Cell(0, 10, 'Se otorga a', 0, 1, 'C');
        $pdf->SetFont('Arial', 'B', 14);
        $pdf->Cell(0, 10, $nombreEstudiante, 0, 1, 'C');
    
        // Agregar detalles del curso (debes adaptar esto según tu base de datos)
        $nombreCurso = $this->obtenerNombreCurso($idCurso);
        $pdf->SetFont('Arial', 'I', 12);
        $pdf->Cell(0, 10, 'Por completar el curso de', 0, 1, 'C');
        $pdf->SetFont('Arial', 'B', 14);
        $pdf->Cell(0, 10, $nombreCurso, 0, 1, 'C');
    
        // Agregar la fecha de emisión
        $pdf->SetFont('Arial', 'I', 12);
        $pdf->Cell(0, 10, 'Fecha de Emision: ' . date('Y-m-d'), 0, 1, 'C');
    
        // Guardar el PDF en un archivo o mostrarlo en el navegador
        $pdf->Output('certificado.pdf', 'D'); // Descargar el PDF
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
}