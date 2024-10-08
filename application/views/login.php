<!DOCTYPE html>
<html lang="en">
<head >
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>VIDEOWE| Login</title>
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>adminlte/plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>adminlte/dist/css/adminlte.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>adminlte/dist/css/estilos.css">
</head>

<body class="hold-transition login-page" style="background-color: #080911;">
  <div class="video-container">
    <video autoplay loop muted>
      <source src="<?php echo base_url(); ?>uploads/video/v7.mp4" type="video/mp4">
      Tu navegador no admite la reproducción de video.
    </video>

    <div class="contenido">
      <div class="login-box">
        <div class="card" style="border-radius: 15px">
          <div class="card p-4 text-light bg-dark mb-6" style="background-color: #d5d4d6;border-radius: 15px;">
            <div class="login-logo">
              <a href="#" style="color: white; font-weight: 700;"><b>CEPRA</b></a>
            </div>

            <?php
            switch($msg) {
              case '1':
                $mensaje="ERROR DE INGRESO";
                $clase="primary";
                break;
              case '2':
                $mensaje="ACCESO NO VALIDO";
                $clase="danger";
                break;
              case '3':
                $mensaje="INGRESE SUS DATOS";
                $clase="primary";
                break;
              default:
                $mensaje="Ingrese su usuario y clave para iniciar sesión";
                $clase="primary";
                break;
            }
            ?>    
            <p class="login-box-msg text-<?php echo $clase; ?>"><?php echo $mensaje; ?></p>

            <?php echo form_open_multipart('usuarios/validarusuario', array('id'=>'form1', 'class'=>'needs-validation', 'method'=>'post')); ?>    
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Usuario o Correo Electrónico" name="login" required>
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-user"></span> <!-- Cambiado a un ícono más genérico -->
                    </div>
                </div>
            </div>

            <div class="input-group mb-3">
                <input type="password" class="form-control" placeholder="Contraseña" name="password" id="passwordField" required>
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-lock"></span>
                    </div>
                </div>
            </div>

            <div class="input-group mb-3">
                <input type="checkbox" id="showPassword" onclick="togglePassword()">
                <label for="showPassword">Mostrar contraseña</label>
            </div>

            <div class="row">
                <div class="col-8"></div>
                <div class="col-12 d-flex justify-content-center">
                    <button type="submit" class="btn btn-primary">INICIAR SESIÓN</button>
                </div>
            </div>

            <script>
            function togglePassword() {
                var passwordField = document.getElementById("passwordField");
                passwordField.type = (passwordField.type === "password") ? "text" : "password";
            }
            </script>

            <?php echo form_close(); ?>

            <div class="social-auth-links text-center mb-3"></div>

            <p class="mb-1">
                <a href="<?php echo base_url(); ?>index.php/usuarios/recuperarcontrasena">¿Olvidaste tu Contraseña?</a>
            </p>
            <p class="mb-0"></p>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="<?php echo base_url(); ?>adminlte/plugins/jquery/jquery.min.js"></script>
  <script src="<?php echo base_url(); ?>adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="<?php echo base_url(); ?>/adminlte/dist/js/adminlte.min.js"></script>
</body>
</html>
