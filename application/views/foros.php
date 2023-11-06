<!-- Content Wrapper. Contains page content -->
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
                        <!-- <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>index.php/base/index">Home</a></li> -->
                        <li class="breadcrumb-item active">foro</li>
                        <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>index.php/usuarios/logout">Cerrar sesión</a></li>
                    </ol>
                </div>
                
            </div>
            
        </div><!-- /.container-fluid -->
        
    </section>

    
    <!-- Botón para mostrar el modal -->
    

    <!-- Modal -->
    <div class="modal fade" id="alertModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel" >Alerta</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Mostrar la alerta aquí -->
                <div id="modalAlertContent">
                    <?php
                    $alerta = $this->session->flashdata('alerta');
                    if ($alerta) {
                        echo '<div class="alert alert-success">' . $alerta . '</div>';
                    } else {
                        echo '<div class="alert alert-danger">No se agregó ningún foro.</div>';
                    }
                    ?>
                </div>
            </div>
            
        </div>
    </div>
    
</div>

<button id="toggleFormButton" class="btn btn-primary">agregar foro de conocimiento</button>
<button><li class="breadcrumb-item"><a href="<?php echo base_url(); ?>index.php/foros/index">Home</a></li></button>




    
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
                                    <h3 class="card-title">FOROSSS</h3>
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
    <!-- Resto del contenido de la vista -->

<!-- Agrega esto en tu vista después del formulario de creación de foros -->
<!-- Muestra la lista de foros -->
<!-- Muestra la lista de foros -->



   
    

</div>
 <!-- Agrega esto en tu vista después del formulario de creación de foros -->


<div>   
    
</div>

</div>

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