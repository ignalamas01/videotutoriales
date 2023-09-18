<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PAGINA INICIO</title>
</head>
<body>

        <h2>este es la interfaz de la pagina de incio</h2>
        <div class="card">
              <div class="card-header">
                <h3 class="card-title">BIENVENIDOS A LA PAGINA CEPRA</h3>
              </div>
              
              <div>   
                
                <a href="<?php echo base_url(); ?>index.php/usuarios/logout"> <button type="button" class="btn btn-danger">INICIAR SESION</button> </a>
              </div>
              
              <!-- <h3> 
                login:<?php  echo $this ->session->userdata('login');?><br>
                id:   <?php  echo $this ->session->userdata('idusuario');?><br>
                tipo: <?php  echo $this ->session->userdata('tipo');?><br>
              </h3> -->
              <!-- /.card-header -->
              <div class="card-body">
                
              </div>
              <!-- /.card-body -->
            </div>
</body>
</html>