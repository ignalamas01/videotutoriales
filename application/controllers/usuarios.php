<?php
defined('BASEPATH') or exit('No direct script access allowed');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require FCPATH.'vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;


class Usuarios extends CI_Controller
{
    public function __construct() {
        parent::__construct();
        // Cargar el autoload de Composer
        require FCPATH.'vendor/autoload.php';
    }
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
    $login = $_POST['login'];
    $password = md5($_POST['password']);

    // Asegúrate de que el modelo tiene una función para manejar esto
    $consulta = $this->usuario_model->validar($login, $password);

    if ($consulta->num_rows() > 0) {
        foreach ($consulta->result() as $row) {
            $this->session->set_userdata('idusuario', $row->idUsuario);
            $this->session->set_userdata('login', $row->login);
            $this->session->set_userdata('tipo', $row->tipo);
            redirect('usuarios/panel', 'refresh');
        }
    } else {
        redirect('usuarios/index/1', 'refresh');
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


	public function process_reset() {
    require 'vendor/autoload.php';
    $email = $this->input->post('email');
    
    // Verificar si el email existe en la base de datos
    $user = $this->usuario_model->get_user_by_email($email);

    if ($user) {
        // Generar un token único y una fecha de expiración (ej: 1 hora después de la solicitud)
        $token = bin2hex(random_bytes(50)); // Genera un token único
        $expiration = date('Y-m-d H:i:s', strtotime('+1 hour')); // Expira en 1 hora

        // Guardar el token y la fecha de expiración en la base de datos
        $this->usuario_model->set_reset_token($user->idUsuario, $token, $expiration);

        // Configurar PHPMailer
        $mail = new PHPMailer(true);
        $mail->SMTPOptions = [
            'ssl' => [
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true,
            ],
        ];
        try {
            // Configuración del servidor SMTP
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->Port = 587;
            $mail->SMTPSecure = 'tls';
            $mail->SMTPAuth = true;
            $mail->Username = 'bikeracealvaro@gmail.com';  // Tu correo SMTP
            $mail->Password = 'gzncuwbkwelnxwys';  // Tu contraseña SMTP

            // Establecer la codificación a UTF-8
            $mail->CharSet = 'UTF-8';

            // Enviar el correo con el enlace de restablecimiento
            $mail->setFrom('tu-email@ejemplo.com', 'Nombre del Remitente');
            $mail->addAddress($email);

            // Enlace único para restablecer la contraseña
            $resetLink = base_url('index.php/usuarios/reset_password?token=' . $token);

            // Contenido del correo
            $mail->isHTML(true);
            $mail->Subject = 'Restablecimiento de Contraseña';
            $mail->Body    = 'Haga clic en el siguiente enlace para restablecer su contraseña: <a href="' . $resetLink . '">Restablecer contraseña</a>';

            // Enviar el correo
            $mail->send();
            echo 'El mensaje ha sido enviado, revise su correo para continuar con el restablecimiento.';
        } catch (Exception $e) {
            echo "Error al enviar el mensaje: {$mail->ErrorInfo}";
        }
    } else {
        echo 'El correo no existe en nuestra base de datos.';
    }
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
            $mail->Port = 587;
            $mail->SMTPSecure = 'tls';
            $mail->SMTPAuth = true;
            $mail->Username = 'bikeracealvaro@gmail.com'; // Cambia esto por tu email
            $mail->Password = 'gzncuwbkwelnxwys'; // Cambia esto por tu contraseña
          
          

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
    public function reset_password() {
        $token = $this->input->get('token');
    
        // Verificar si el token es válido y no ha expirado
        $user = $this->usuario_model->get_user_by_token($token);
    
        if ($user && strtotime($user->reset_token_expiration) > time()) {
            // Mostrar el formulario y pasar el token como un campo oculto
            $this->load->view('reset_password_form', ['token' => $token]);
        } else {
            echo 'El enlace es inválido o ha expirado.';
        }
    }
    
    
    
    
    public function update_password() {
        $token = $this->input->post('token');
        $password = $this->input->post('password');
        $confirm_password = $this->input->post('confirm_password');
        $email = $this->input->post('email');
    
        log_message('debug', "Token: $token, Email: $email");
    
        // Verificar si el correo electrónico está registrado
        $user = $this->usuario_model->get_user_by_email($email);
    
        if (!$user) {
            echo 'El correo electrónico no está registrado.';
            return;
        }
    
        if ($password === $confirm_password) {
            if ($user && strtotime($user->reset_token_expiration) > time()) {
                // Hashear la nueva contraseña usando md5
                $new_password = md5($password);
    
                // Actualizar la contraseña del usuario
                if ($this->usuario_model->update_password($user->idUsuario, $new_password)) {
                    echo 'La contraseña ha sido actualizada correctamente.';
                } else {
                    echo 'No se pudo actualizar la contraseña.';
                }
            } else {
                echo 'Token inválido o expirado.';
            }
        } else {
            echo 'Las contraseñas no coinciden.';
        }
    }
    
    
    
    
	
	
}
