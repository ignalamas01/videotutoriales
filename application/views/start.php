<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Video Tutoriales</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #332;
            color: #fff;
            padding: 20px;
            text-align: center;
        }

        h1 {
            margin: 0;
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        }

        .video {
            width: 100%;
        }

        .video-list {
            list-style: none;
            padding: 0;
        }

        .video-list-item {
            margin-bottom: 10px;
        }

        .video-title {
            font-size: 18px;
            margin: 5px 0;
        }

        .video-description {
            color: #555;
        }
    </style>
    
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
<body  style="background-image: url('<?php echo base_url(); ?>uploads/imgenes/fondo.jpg'); background-size: cover;" >
<?php
    $colorFondo = "#332"; // Definimos el color en una variable PHP
    ?>

   
    <header>
      
      <h1> CEPRA </h1>
        
  
   <div class="col-sm-12" >
     <ol class="breadcrumb float-sm-right" style=" background-color: <?php echo $colorFondo; ?>">
        <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>index.php/base/index">Home</a></li>
        <li class="breadcrumb-item active">DataTables</li>
        <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>index.php/usuarios/logout">Registrate</a></li>
        <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>index.php/usuarios/logout">Iniciar sesion</a></li>
           
            
   </div> 
  </header>
   
    
    <div class="contenido">
        <!-- Aquí puedes agregar contenido adicional sobre la imagen de fondo -->
        <h1>Bienvenido a Mi Sitio Web</h1>

    </div>
    <div class="col-md-5">
        <img src="<?php echo base_url(); ?>img/imgvt.png" width="300">

    </div>
    <br>
    
</body>    





<!-- jQuery -->
<script src="<?php echo base_url(); ?>adminlte/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?php echo base_url(); ?>adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url(); ?>/adminlte/dist/js/adminlte.min.js"></script>
    

</html>
