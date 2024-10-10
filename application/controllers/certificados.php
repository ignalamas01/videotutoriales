<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Certificados extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        // Cargar modelos necesarios
        $this->load->model('certificados_model');
        $this->load->library('MenuLateral');
    }

    public function emitir_certificado() {
        $idCurso = $this->input->post('idCurso');
        
        $idUsuario = $this->session->userdata('idusuario');
        $estudiante = $this->db->get_where('estudiante', array('idUsuario' => $idUsuario))->row();

        if ($estudiante) {
            $idEstudiante = $estudiante->id;
            
            // Obtener evaluaciones activas del curso y sección
            $evaluaciones = $this->certificados_model->obtener_evaluaciones_activas_seccion($idCurso);
            
            // Variable de control para saber si se encontró una evaluación aprobada
            $evaluacionAprobadaEncontrada = false;

            foreach ($evaluaciones as $evaluacion) {
                $puntajeTotal = $this->certificados_model->obtener_puntaje_total($idCurso, $evaluacion->idEvaluacion, $idEstudiante);

                // Verificar si el estudiante ha aprobado esta evaluación
                $evaluacionAprobada = $this->certificados_model->verificar_aprobacion_curso($idCurso, $idEstudiante, $evaluacion->idEvaluacion);

                // Si alguna evaluación está aprobada, marcar como verdadero y salir del bucle
                if ($evaluacionAprobada) {
                    $evaluacionAprobadaEncontrada = true;
                    break;
                }
            }

            // Si se encontró una evaluación aprobada, emitir el certificado
            if ($evaluacionAprobadaEncontrada) {
                $ultimoCertificado = $this->certificados_model->obtener_ultimo_certificado($idCurso, $idEstudiante);
                if (!$ultimoCertificado || $ultimoCertificado->emitido == 0) { 
                $this->certificados_model->emitir_certificado($idCurso, $idEstudiante);
                $this->certificados_model->generar_certificado_pdf($idCurso, $idEstudiante);
                echo '¡Certificado emitido!';
            } else {
                // echo 'Ya se emitio un certificado anteriormente';
                redirect("certificados/certificados_lista","refresh");
            }
        } else {
            // echo 'No cumples con los requisitos para obtener el certificado.';
            redirect("vercurso/ver/$idCurso","refresh");
        }
    }
}
public function certificados_lista()
{
    if ($this->session->userdata('login')) {
        // Obtén el idUsuario desde la sesión
        $idUsuario = $this->session->userdata('idusuario');
        // echo "ID Estudiante: " . $idUsuario;
        // var_dump($idUsuario);
        // Carga el modelo de usuario para obtener más detalles
        $this->load->model('certificados_model');
        $estudiante = $this->certificados_model->obtener_id_estudiante_por_id_usuario($idUsuario);
        // echo "ID Estudiante: " . $estudiante;
        if ($estudiante) {
            // Obtiene el idEstudiante del modelo de usuario
            $idEstudiante = $estudiante;
            // echo "ID Estudiante: " . $idEstudiante;
            // Carga el modelo de certificados
            $this->load->model('certificados_model');
            $data['certificados'] = $this->certificados_model->obtener_certificados($idEstudiante);
            $this->load->model('certificados_model');
            // var_dump($data['certificados']);
            $this->load->view('incestudiante/cabecera');
            $this->load->view('incestudiante/menu');
            $this->menulateral->cargar_menu_lateral();
            $this->load->view('certificados_lista', $data);
            $this->load->view('incestudiante/pie');
        } 
    //     else {
    //         // Maneja el caso donde no se encuentra el usuario
    //         redirect('usuarios/index/2', 'refresh');
    //     }
    // } else {
    //     redirect('usuarios/index/2', 'refresh');
    // }
}

    // public function mostrar_certificados() {
    //     // Cargar el modelo necesario
    //     $this->load->model('certificados_model');
        
    //     // Obtener los certificados desde el modelo
    //     $data['certificados'] = $this->certificados_model->obtener_certificados();  // Ajusta el nombre del método según tu modelo
        
    //     // Cargar la vista y pasar los datos
    //     $this->load->view('certificados_lista', $data);
    // }
}
public function actualizar_progreso() {
    $idCurso = $this->input->post('idCurso');
    
    $idUsuario = $this->session->userdata('idusuario');
    $estudiante = $this->db->get_where('estudiante', array('idUsuario' => $idUsuario))->row();

    if ($estudiante) {
        $idEstudiante = $estudiante->id;

        // Obtener el número total de evaluaciones activas en el curso
        $evaluacionesActivas = $this->certificados_model->obtener_evaluaciones_activas_curso($idCurso);

        // Obtener el número de evaluaciones aprobadas por el estudiante
        $evaluacionesAprobadas = $this->certificados_model->obtener_evaluaciones_aprobadas($idCurso, $idEstudiante);

        // Calcular el porcentaje de progreso
        $porcentajeProgreso = ($evaluacionesAprobadas / $evaluacionesActivas) * 100;

        // Actualizar el porcentaje de progreso en la tabla correspondiente
        $progresoActualizado = $this->certificados_model->actualizar_progreso($idEstudiante, $idCurso, $porcentajeProgreso);
        // $progresoActualizado = $this->certificados_model->obtener_progreso_usuario($idEstudiante, $idCurso);

        // Pasar el progreso a la vista
        $data['progreso'] = $progresoActualizado;

        // Cargar la vista con los datos
        $this->load->view('cursos_lista2', $data);

        echo '¡Progreso actualizado!';
    } else {
        echo 'No se encontró el estudiante.';
    }
}
// En tu controlador de Certificados
public function verificar_certificado() {
    $this->load->view('verificar_certificado');
}
public function verificar_codigo() {
    // Obtener el código ingresado
    $codigo = $this->input->post('codigo');
    
    // Consulta para obtener los detalles del certificado, el estudiante y el curso
    $this->db->select('certificados.codificacion, estudiante.nombre, estudiante.primerApellido, estudiante.segundoApellido, cursos.titulo, certificados.fechaEmision');
    $this->db->from('certificados');
    $this->db->join('estudiante', 'certificados.idEstudiante = estudiante.id');
    $this->db->join('cursos', 'certificados.idCurso = cursos.id');
    $this->db->where('certificados.codificacion', $codigo);
    $certificado = $this->db->get()->row();

    // Verificar si se encontró el certificado
    if ($certificado) {
        // Pasar los detalles a la vista
        $this->load->view('certificado_verificado', array('certificado' => $certificado));
    } else {
        // Mostrar mensaje de error si no existe
        $this->load->view('certificado_no_encontrado');
    }
}


public function verificar_por_qr() {
    $codigo = $this->input->get('codigo');
    
    // Mismo procedimiento de consulta
    $this->db->select('certificados.codificacion, estudiante.nombre, estudiante.primerApellido, estudiante.segundoApellido, cursos.titulo, certificados.fechaEmision');
    $this->db->from('certificados');
    $this->db->join('estudiante', 'certificados.idEstudiante = estudiante.id');
    $this->db->join('cursos', 'certificados.idCurso = cursos.id');
    $this->db->where('certificados.codificacion', $codigo);
    $certificado = $this->db->get()->row();

    if ($certificado) {
        $this->load->view('certificado_verificado', array('certificado' => $certificado));
    } else {
        $this->load->view('certificado_no_encontrado');
    }
}


}
