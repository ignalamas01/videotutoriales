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
                        <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>index.php/base/index">Home</a></li>
                        <li class="breadcrumb-item active">foro</li>
                    </ol>
                </div>
            </div>
            
        </div><!-- /.container-fluid -->
        
    </section>
    
<!-- Muestra la lista de foros -->

<button id="toggleFormButton" class="btn btn-primary">agregar foro de conocimiento</button>



    
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
        <li>
            <h4><?php echo $foro->titulo; ?></h4>
            <p><?php echo $foro->descripcion; ?></p>
            <p><?php echo $foro->fechaHora; ?></p>

            <!-- Formulario para agregar comentario -->
            <?php echo form_open('foros/agregar_comentario/' . $foro->idForo); ?>
            <label for="comentario">Agregar Comentario:</label>
            <textarea name="comentario" ></textarea>
            <input type="submit" value="Agregar Comentario">
            <?php echo form_close(); ?>
        </li>
    <?php endforeach; ?>
</ul>
<section class="content">
      <div class="container-fluid">

        <!-- Timelime example  -->
        <div class="row">
          <div class="col-md-12">
            <!-- The time line -->
            <div class="timeline">
              <!-- timeline time label -->
              <div class="time-label">
                <span class="bg-red">10 Feb. 2014</span>
              </div>
              <!-- /.timeline-label -->
              <!-- timeline item -->
              
              <div>
                <i class="fas fa-envelope bg-blue"></i>
                <div class="timeline-item">
                  <span class="time"><i class="fas fa-clock"></i> 12:05</span>
                  <h3 class="timeline-header"><a href="#"><?php echo $foro->titulo; ?></a> sent you an email</h3>

                  <div class="timeline-body">
                    <?php echo $foro->descripcion; ?>
                  </div>
                  <div class="timeline-footer">
                    <a class="btn btn-primary btn-sm">Read more</a>
                    <a class="btn btn-danger btn-sm">Delete</a>
                  </div>
                </div>
              </div>
              <!-- END timeline item -->
              <!-- timeline item -->
              <div>
                <i class="fas fa-user bg-green"></i>
                <div class="timeline-item">
                  <span class="time"><i class="fas fa-clock"></i> 5 mins ago</span>
                  <h3 class="timeline-header no-border"><a href="#">Sarah Young</a> accepted your friend request</h3>
                </div>
              </div>
              <!-- END timeline item -->
              <!-- timeline item -->
              <div>
                <i class="fas fa-comments bg-yellow"></i>
                <div class="timeline-item">
                  <span class="time"><i class="fas fa-clock"></i> 27 mins ago</span>
                  <h3 class="timeline-header"><a href="#">Jay White</a> commented on your post</h3>
                  <div class="timeline-body">
                    Take me to your leader!
                    Switzerland is small and neutral!
                    We are more like Germany, ambitious and misunderstood!
                  </div>
                  <div class="timeline-footer">
                    <a class="btn btn-warning btn-sm">View comment</a>
                  </div>
                </div>
              </div>
              <!-- END timeline item -->
              <!-- timeline time label -->
              <div class="time-label">
                <span class="bg-green">3 Jan. 2014</span>
              </div>
              <!-- /.timeline-label -->
              <!-- timeline item -->
              <div>
                <i class="fa fa-camera bg-purple"></i>
                <div class="timeline-item">
                  <span class="time"><i class="fas fa-clock"></i> 2 days ago</span>
                  <h3 class="timeline-header"><a href="#">Mina Lee</a> uploaded new photos</h3>
                  <div class="timeline-body">
                    <img src="https://placehold.it/150x100" alt="...">
                    <img src="https://placehold.it/150x100" alt="...">
                    <img src="https://placehold.it/150x100" alt="...">
                    <img src="https://placehold.it/150x100" alt="...">
                    <img src="https://placehold.it/150x100" alt="...">
                  </div>
                </div>
              </div>
              <!-- END timeline item -->
              <!-- timeline item -->
              <div>
                <i class="fas fa-video bg-maroon"></i>

                <div class="timeline-item">
                  <span class="time"><i class="fas fa-clock"></i> 5 days ago</span>

                  <h3 class="timeline-header"><a href="#">Mr. Doe</a> shared a video</h3>

                  <div class="timeline-body">
                    <div class="embed-responsive embed-responsive-16by9">
                      <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/tMWkeBIohBs" allowfullscreen></iframe>
                    </div>
                  </div>
                  <div class="timeline-footer">
                    <a href="#" class="btn btn-sm bg-maroon">See comments</a>
                  </div>
                </div>
              </div>
              <!-- END timeline item -->
              <div>
                <i class="fas fa-clock bg-gray"></i>
              </div>
            </div>
          </div>
          <!-- /.col -->
        </div>
      </div>
      <!-- /.timeline -->

    </section>



</div>
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
