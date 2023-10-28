<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class certificados_model extends CI_Model {

    public function verificar_aprobacion_curso($idEvaluacion, $idEstudiante) {
        // Consulta para verificar si el estudiante ha obtenido al menos una nota mayor a 60
        $this->db->select('COUNT(*) as total_evaluaciones');
        $this->db->from('puntajesevaluacion');
        $this->db->where('idEvaluacion', $idEvaluacion);
        $this->db->where('idEstudiante', $idEstudiante);
        $this->db->where('puntajeTotal >', 60); // Agregar condición para puntaje mayor a 60
    
        // Ejecutar la consulta
        $result = $this->db->get()->row();
    
        // Verificar si se obtuvo al menos un resultado
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
        // echo 'idCurso: ' . $idCurso . ', idEvaluacion: ' . $idEvaluacion . ', idEstudiante: ' . $idEstudiante . '<br>';
        $this->db->select('puntajeTotal');
        $this->db->from('puntajesevaluacion');
        $this->db->where('idCurso', $idCurso);
        $this->db->where('idEvaluacion', $idEvaluacion);
        $this->db->where('idEstudiante', $idEstudiante);
     
        // echo $this->db->last_query();
        $result = $this->db->get()->row();
    
        // Verificar si se obtuvo un resultado
        if ($result !== null) {
            // echo 'PuntajeTotal obtenido: ' . $result->puntajeTotal . '<br>';
            return $result->puntajeTotal;
        } else {
            // echo 'No se encontró puntajeTotal en la evaluación.<br>';
            echo 'No se encontró alguna evaluacion realizada.<br>';
        }
    
        return 0; // Otra opción es devolver un valor predeterminado si no se encuentra el puntaje
    }
    public function generar_certificado_pdf($idCurso, $idEstudiante) {
       
        
        // Configura el encabezado y pie de página si es necesario
        $pdf = new FPDF();
        $pdf->AddPage();
        $pdf->SetFont('Arial', 'B', 16);
        $pdf->Cell(40, 10, '¡Certificado Emitido!');

        // Puedes personalizar el contenido del certificado según tus necesidades

        // Guardar el PDF en un archivo o mostrarlo en el navegador
        $pdf->Output('certificado.pdf', 'D'); // Descargar el PDF
    }
}