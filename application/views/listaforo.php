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

            <!-- Formulario para agregar comentario -->
            <?php echo form_open('foros/agregar_comentario/' . $foro->idForo); ?>
            <label for="comentario">Agregar Comentario:</label>
            <textarea name="comentario" ></textarea>
            <input type="submit" value="Agregar Comentario">
            <?php echo form_close(); ?>
        </li>
    <?php endforeach; ?>
</ul>



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
