<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Usuarios extends CI_Controller
{
	public function index()
	{
		
        if($this->session->userdata('login'))
        {
            redirect('usuarios/panel','refresh');
        }
        else
        {
			$data['msg']=$this->uri->segment(3);
            $this->load->view('login',$data);          
        }

	}
    public function validarusuario()
    {
        $login=$_POST['login'];
        $password=md5($_POST['password']);
        $consulta=$this->usuario_model->validar($login,$password);
        if($consulta->num_rows()>0)
        {
            foreach($consulta->result() as $row )
            {
                $this->session->set_userdata('idusuario',$row->idUsuario);
                $this->session->set_userdata('login',$row->login);
                $this->session->set_userdata('tipo',$row->tipo);
                redirect('usuarios/panel','refresh');

            }

        }
        else
        {
        	redirect('usuarios/index/1','refresh');
        }
    }

    public function panel()
    {

        if($this->session->userdata('login'))
        {
			$tipo=$this->session->userdata('tipo');
			if($tipo=='empleado')
			{
			 redirect('base/index2','refresh');
			}
			if($tipo=='admin')
			{
			 redirect('admin/index','refresh');
			}
			else
			{
				redirect('estudiante/invitado','refresh');	
			}
           
        }
        else
        {
            redirect('usuarios/index/2','refresh');
        }
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('usuarios/index/3','refresh');
    }
	public function recuperarcontrasena()
	{
		//$this->load->view('inc/cabecera');
		//$this->load->view('inc/menu');
		//$this->load->view('inc/menulateral');
		$this->load->view('reset_password');
		//$this->load->view('inc/pie');
	}


	public function process_reset() 
	{
        $email = $this->input->post('email'); // Obtener el correo del formulario

        // Cargar el modelo de usuarios (donde verificas los datos)
        // $this->load->model('usuario_model');
		
        // Verificar si el correo existe en la base de datos
        $user=$this->usuario_model->get_user_by_email($email);

        if ($user) {
            // Si existe, envía el correo con instrucciones
            $this->send_reset_email($email);
            $this->session->set_flashdata('success', 'Correo enviado con las instrucciones para restablecer la contraseña.');
        } else {
            // Si no existe, muestra un error
            $this->session->set_flashdata('error', 'El correo electrónico no está registrado.');
        }

        // Redirige de vuelta a la página de restablecimiento
        redirect('usuarios/index/2','refresh');
    }

    // Método para enviar el correo
    public function send_reset_email($email) {
        // Cargar la librería PHPMailer
        $this->load->library('phpmailer_lib');
        $mail = $this->phpmailer_lib->load();

        try {
            // Configuración del correo
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com'; // Cambia esto por el servidor SMTP
            $mail->SMTPAuth = true;
            $mail->Username = 'bikeracealvaro@gmail.com'; // Cambia esto por tu email
            $mail->Password = 'gzncuwbkwelnxwys'; // Cambia esto por tu contraseña
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            // Remitente
            $mail->setFrom('tuemail@dominio.com', 'Soporte CEPRA');
            // Destinatario
            $mail->addAddress($email);

            // Asunto
            $mail->Subject = 'Instrucciones para restablecer la contraseña';

            // Contenido del correo
            $mailContent = "<h1>Restablecer Contraseña</h1>
                            <p>Haga clic en el siguiente enlace para restablecer su contraseña:</p>
                            <p><a href='".base_url()."auth/reset_password_confirm/".$this->generate_token($email)."'>Restablecer Contraseña</a></p>";
            $mail->Body = $mailContent;

            // Enviar correo
            $mail->send();
        } catch (Exception $e) {
            log_message('error', "Error al enviar correo: " . $mail->ErrorInfo);
        }
    }

    // Método para generar un token (puedes almacenarlo en la base de datos)
    private function generate_token($email) {
        return hash('sha256', $email . time());
    }

	
	
}
