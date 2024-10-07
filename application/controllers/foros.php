<?php
class Foros extends CI_Controller {
    public function __construct() {
        
        parent::__construct();
        
        $this->load->model('Foros_model');
        $this->load->model('Comentarios_model');
        $this->load->library('MenuLateral');
        
        $this->load->helper('form');
        
    }

    public function for() {
        $this->load->library('form_validation');
        
        
        // Reglas de validación para el formulario
        $this->form_validation->set_rules('titulo', 'Título', 'required');
        $this->form_validation->set_rules('descripcion', 'Descripción', 'required');
        
        if ($this->form_validation->run() === FALSE) {
            // Mostrar el formulario si no se ha enviado o hay errores de validación
            // $this->load->view('inc/cabecera');
            // $this->load->view('inc/menu');
            // $this->load->view('inc/menulateral');
            // $this->load->view('foros');
            
            
            // $this->load->view('inc/pie');
            $tipo = $this->session->userdata('tipo');
			if ($tipo == 'admin') {
				// Cargar la vista para el administrador
				        // $this->load->view('incadmin/cabecera');
						// $this->load->view('incadmin/menu');
						// $this->load->view('incadmin/menulateral');
						// $this->load->view('foros');
                        // $this->load->view('inc/pie');
						
			} if ($tipo == 'empleado') {
				// Cargar la vista para el empleado
				// $this->load->view('inc/cabecera');
				// $this->load->view('inc/menu');
				// $this->load->view('inc/menulateral');
				// $this->load->view('foros');
                // $this->load->view('inc/pie');
				
			}
			if ($tipo == 'invitado') {
				// Cargar la vista para el empleado
				// $this->load->view('incestudiante/cabecera');
				// $this->load->view('incestudiante/menu');
				// $this->load->view('incestudiante/menulateral');
				// $this->load->view('foros');
                // $this->load->view('incestudiante/pie');
				
				
			}
        } else {
            // Obtener datos del formulario
            $titulo = $this->input->post('titulo');
            $descripcion = $this->input->post('descripcion');
        
            // Autenticación y obtención del ID de usuario
            $idUsuario = $this->session->userdata('idusuario');
        
            // Llamar al método del modelo para obtener el ID de empleado y estudiante
            $idEmpleado = $this->empleado_model->obtener_id($idUsuario);
            $idEstudiante = $this->estudiante_model->obtener_id($idUsuario);
        
            // Llamar al método del modelo para crear el foro
            $idForoCreado = $this->Foros_model->crearForo($idUsuario, $titulo, $descripcion, $idEmpleado, $idEstudiante);
           
           
            $data['idEmpleado'] = $idEmpleado;
            $data['idEstudiante'] = $idEstudiante;
        
            if ($idForoCreado) {
                // Establecer un mensaje de éxito en flashdata
                $this->session->set_flashdata('alerta', 'El foro se creó correctamente.');
        
                // Redirigir a la página actual
                redirect('foros/index', 'refresh');
            } else {
                // Mostrar un mensaje de error detallado o registrar el error
                log_message('error', 'Error al crear el foro para el usuario ' . $idUsuario);
                echo "Error al crear el foro.";
            }
        }
        
        
    }
    public function index() {
         
        
        if($this->session->userdata('login'))
        {
        
        $this->load->model('Foros_model');
        
    
        // Obtener la lista de foros desde el modelo
        $data['foros'] = $this->Foros_model->obtenerForos();
        $data['comentarios'] = $this->Comentarios_model->obtenerComentarios();
        $data['estudiante'] = $this->estudiante_model->listaestudiante();
        

       
    
        //Cargar la vista y pasar los datos
        $this->load->view('incestudiante/cabecera');
        $this->load->view('incestudiante/menu');
        $this->menulateral->cargar_menu_lateral();
        $this->load->view('listaforo', $data);
        $this->load->view('inc/pie');

    }
    else
    {
        redirect('usuarios/index/2','refresh');
    }
       
    }

    
        



    
    

    
    
}


    
