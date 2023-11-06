<head>
    <!-- ... Otras etiquetas del encabezado ... -->
    <style>
    @keyframes parpadeo {
        20%, 100% { opacity: 1; }
        50% { opacity: 0.7; }
    }

    .parpadeo {
        animation: parpadeo 2s infinite;
    }
</style>

</head>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>*</h1>
                    <!-- Agregar un botón para mostrar/ocultar el formulario -->
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active">foro</li>
                        <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>index.php/base/index">Home</a></li>
                        
                    </ol>
                </div>
            </div>
            
        </div><!-- /.container-fluid -->
        
    </section>
    
<!-- Muestra la lista de foros -->
<!-- <div >
<button  id="toggleFormButton" class="btn btn-primary">agregar foro de conocimiento</button>
</div> -->
<div>
    <button id="toggleFormButton" class="btn btn-primary mb-2 mr-2 parpadeo">
        <img src="<?php echo base_url(); ?>img/imgvt.png" width="130" alt="Imagen">
        <span style="font-size: 18px; font-weight: bold;">PRESIONA AQUÍ PARA AGREGAR FORO DE CONOCIMIENTO</span>
    </button>
</div>








    
    <!-- Main content -->
    <div class="row featurette">
        <div class="col-md-7">
            <br>
            <?php
    echo form_open_multipart('foros/for', 'id="foroForm" style="display:none;"');
    ?>
            <h2 class="featurette-heading">AGREGAR FOROS<span class="text-muted"></span></h2>
            <div id="alerta" style="display: none;"></div>

            <input type="hidden" name="idUsuario" value="<?php echo $this->session->userdata('idusuario'); ?>">

            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <!-- left column -->
                        <div class="col-md-9">
                            <!-- general form elements -->
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">foros</h3>
                                </div>

                            

                                <!-- Formulario para crear un nuevo tema -->
                                <label>Título del Tema:</label>
                                <input type="text" name="titulo" required><br>

                                <label>Mensaje:</label>
                                <textarea name="descripcion"></textarea><br>

                                <p></p>

                                <button type="submit" class="btn btn-success" name="crear_tema" id="crearTemaButton">Crear Tema</button>
                                <button type="reset" class="btn btn-danger" onClick="history.go(-1);">Cancelar</button>
                            </div>

                        </div>
                    </div>
                </div>

            </section>
        </div>
           

    </div>
<ul>
    <?php foreach ($foros as $foro): ?>
        
      <?php echo $foro->idForo; ?>
    
    <section class="content">
      
      <div class="container-fluid">

        <!-- Timelime example  -->
        <div class="row">
          <div class="col-md-12">
            
            <!-- The time line -->
            <div class="timeline">
              <!-- timeline time label -->
              <div class="time-label">
                <span class="bg-red"><?php echo $foro->fechaHora; ?></span>
              </div>
              <!-- /.timeline-label -->
              <!-- timeline item -->
              
              <div>
                <i class="fas fa-envelope bg-blue"></i>
                
                <div class="timeline-item">
                  <span class="time"><i class="fas fa-clock"></i>Hora: <?php echo date("H:i", strtotime($foro->fechaHora)); ?></p></span>
                  
                  <h3 class="timeline-header"><a href="#"><?php echo $foro->titulo; ?></a> Te envié un correo electrónico</h3>

                  <div class="timeline-body">
                    <?php echo $foro->descripcion; ?>
                  </div>


                  <div class="timeline-footer">
                  
                      <!-- <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#comentarioModal">Comentar este foro</button> -->
                      <button class="btn btn-primary" data-toggle="modal" data-target="#comentarioModal<?php echo $foro->idForo; ?>">Realizar un comentario</button>
                     <a class="btn btn-danger btn-sm">ocultar</a>
                  </div>
                  

                </div>
              </div>
              <!-- END timeline item -->
              <!-- timeline item -->
              <div>
                <i class="fas fa-user bg-green"><?php echo $foro->idUsuario; ?></i>
                <div class="timeline-item" >
                  <span class="time"><i class="fas fa-clock"></i> 5 mins ago</span>
                  <h3 class="timeline-header no-border"><a href="#">NOMBRE DEL USUARIO</a> creo este foro publico</h3>
                </div>
              </div>
            <ul>

              
<?php foreach ($comentarios as $comentario): ?>
        
      
    
    <section  class="content">
      
      <div class="container-fluid">

        <!-- Timelime example  -->
        <div class="row">
          <div class="col-md-12">
            

          <?php if ($comentario->idForo == $foro->idForo): ?>
            <!-- The time line -->
            <div class="timeline">
           
    <!-- Incluye esta sección en tu loop de comentarios -->
    
        
            <div>
                <i class="fas fa-comments bg-yellow"></i>
                <div class="timeline-item">
                    <span class="time"><i class="fas fa-clock"></i><?php echo $comentario->fechaHora; ?></span>
                    <h3 class="timeline-header"><a href="#">Usuario: <?php echo $comentario->idUsuario; ?></a> comentó en el foro: <?php echo $comentario->idForo; ?></h3>
                    <div class="timeline-body">
                        <?php echo $comentario->contenido; ?>
                    </div>
                    <div class="timeline-footer">
                        <a class="btn btn-warning btn-sm">Ver Comentario</a>
                    </div>
                      
                </div>
                
                
            </div>
            
        <?php endif; ?>
        
    

</div>
            

      <!-- /.timeline -->

    </section>
            

  <?php endforeach; ?> 
                 

</ul>




              
  
            </div>
          </div>
          <!-- /.col -->
        </div>
      </div>
      <!-- /.timeline finaliza el recuadro todo -->
                        
  </section>
            
  
  <?php endforeach; ?>  
                    
</ul>


<!-- ... Otros elementos HTML ... -->

<!-- Agrega un div oculto para el formulario de comentarios -->
<div id="comentarioForm" style="display: none;">
    <?php if (!empty($foros)): ?>
        <?php echo form_open_multipart('comentarios/guardar_comentario'); ?>
        <label for="contenido">Comentario:</label>
        <textarea name="contenido" id="contenido" rows="4" cols="50"></textarea>
        <input type="hidden" name="idForo" value="<?php echo $foro->idForo; ?>">
        <br>
        <input type="submit" value="Enviar Comentario" data-dismiss="modal">
        <?php echo form_close(); ?>
    <?php else: ?>
        <p>No hay foros disponibles para leer.</p>
    <?php endif; ?>
</div>

<!-- este es el nuevo -->



<!-- este es el modelo correcto  -->


<ul>
    <?php foreach ($foros as $foro): ?>
        

        <!-- Agrega el modal de comentarios para este foro -->
        <div class="modal fade" id="comentarioModal<?php echo $foro->idForo; ?>" tabindex="-1" role="dialog" aria-labelledby="comentarioModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="comentarioModalLabel">Escribe tu comentario</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <?php echo form_open_multipart('comentarios/guardar_comentario'); ?>
                        <label for="contenido">Comentario:</label>
                        <textarea name="contenido" id="contenido" rows="4" cols="50"></textarea>
                        <br>
                        <!-- Asocia el comentario al foro actual -->
                        <input type="hidden" name="idForo" value="<?php echo $foro->idForo; ?>">
                        <!-- Asegúrate de obtener el ID del usuario de la sesión o de otra manera -->
                        <input type="hidden" name="idUsuario" value="<?php echo $this->session->userdata('idusuario'); ?>">
                        <input type="submit" value="Enviar Comentario">
                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</ul>

<!-- este es el modelo correcto  -->

<!-- este es para ordenar fuciniona biem  -->


<ul>
    <?php foreach ($foros as $foro): ?>
        <!-- Muestra el contenido del foro -->
        <!-- <div class="timeline">
            <div class="timeline-item">
                <span class="time"><i class="fas fa-clock"></i><?php echo $foro->fechaHora; ?></span>
                <h3 class="timeline-header">Foro: <?php echo $foro->titulo; ?></h3>
                <div class="timeline-body">
                    <?php echo $foro->descripcion; ?>
                </div>
                <div class="timeline-footer">
                    
                    <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#comentarioModal<?php echo $foro->idForo; ?>">Comentar este foro</button>
                </div>
            </div>
        </div> -->

        <!-- Agrega el modal de comentarios para este foro -->
        <div class="modal fade" id="comentarioModal<?php echo $foro->idForo; ?>" tabindex="-1" role="dialog" aria-labelledby="comentarioModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class "modal-title" id="comentarioModalLabel">Escribe tu comentario</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <?php echo form_open_multipart('comentarios/guardar_comentario'); ?>
                        <label for="contenido">Comentario:</label>
                        <textarea name="contenido" id="contenido" rows="4" cols="50"></textarea>
                        <br>
                        <!-- Asocia el comentario al foro actual -->
                        <input type="hidden" name="idForo" value="<?php echo $foro->idForo; ?>">
                        <!-- Asegúrate de obtener el ID del usuario de la sesión o de otra manera -->
                        <input type="hidden" name="idUsuario" value="<?php echo $this->session->userdata('idusuario'); ?>">
                        <input type="submit" value="Enviar Comentario">
                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>
        </div>

    <?php endforeach; ?>
</ul>



</div>

<!-- Agrega el modal -->
 <!-- Agrega el modal de comentarios para este foro -->
    

<script>
    // Agregar el botón "OK" al modal si se crea el foro con éxito
document.addEventListener("DOMContentLoaded", function() {
    const toggleFormButton = document.getElementById("toggleFormButton");
    const foroForm = document.getElementById("foroForm");
    const modalOKButton = document.getElementById("modalOKButton");
    const modalAlertContent = document.getElementById("modalAlertContent");

    toggleFormButton.addEventListener("click", function() {
        if (foroForm.style.display === "none") {
            foroForm.style.display = "block";
            toggleFormButton.textContent = "Ocultar Formulario";
        } else {
            foroForm.style.display = "none";
            toggleFormButton.textContent = "Mostrar Formulario";
        }
    });

    // Mostrar el modal cuando se cargue la página
    const alerta = modalAlertContent.innerHTML;
    if (alerta && alerta.indexOf('alert-success') !== -1) {
        $('#alertModal').modal('show');
    }

    // Configurar la acción del botón "OK" después de crear el foro
    modalOKButton.addEventListener("click", function() {
        $('#alertModal').modal('hide'); // Oculta el modal
        // Realiza cualquier otra acción necesaria aquí, como redirigir a la misma vista
    });
});

</script>



