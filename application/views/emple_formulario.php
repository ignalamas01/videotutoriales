
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1></h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>index.php/base/index">Home</a></li>
              <li class="breadcrumb-item active">DataTables</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <div class="row featurette">
    <div class="col-md-7">
        <br>
        <h2 class="featurette-heading">AGREGAR EMPLEADO<span class="text-muted"></span></h2>


    </div>
    <div class="col-md-5">
        <!-- <center><img src="<?php echo base_url(); ?>img/imgvt.png" width="120"></center> -->

    </div>

    <!--<div col-md-12> -->



    <?php
    /*  lo mismo que multipart  y form
                <form action="<?php echo base_url(); ?>index.php/estudiante/agregarbd" method="POST">
                */ ?>
    <?php
    echo form_open_multipart('base/agregarbd')
    ?>


<span id="error-correo" style="color: red;">
    <?php
    // Muestra mensajes de error específicos desde la sesión aquí
    echo $this->session->flashdata('error_correo');
    ?>
</span>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-9">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Datos Generales</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">NOMBRES<span style="color: red;">*</span></label>
                                    <input type="text" name="nombre" placeholder="Escriba su nombre" class="form-control" required><br>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">PRIMER APELLIDO<span style="color: red;">*</span></label>
                                    <input type="text" name="primerApellido" placeholder="Escriba su primer apellido" class="form-control" required><br>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">SEGUNDO APELLIDO</label>
                                    <input type="text" name="segundoApellido" placeholder="Escriba su segundo apellido" class="form-control"><br>
                                </div>
                                <div class="form-group">
     <label for="seudonimo">TÍTULO</label>
     <select name="seudonimo" class="form-control select2" style="width: 20%;" required>
        <option value="" disabled selected>Seleccione...</option>
        <option value="Mr.">Mr.</option>
        <option value="Ing.">Ing.</option>
        <option value="Lic.">Lic.</option>
        <option value="Lic.">Mgr.</option>
        <option value="Dr.">Dr.</option>
        <option value="Ms.">Ms.</option>
        <option value="Sr.">Sr.</option>
        <option value="Sra.">Sra.</option>
        <option value="Srta.">Srta.</option> <!-- Opción añadida para Señorita -->
        <option value="Prof.">Prof.</option>
    </select>
</div>
                                <div class="form-group">
    <label for="newEmail">CORREO ELECTRÓNICO<span style="color: red;">*</span></label>
    <input type="email" id="destinatario" name="destinatario" placeholder="Escriba su email" class="form-control" required onkeyup="verificarCorreoExistente()">

    <span id="error-correo" style="color: red;"></span>
</div>


                                <div class="row">
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label>DEPARTAMENTO<span style="color: red;">*</span></label>
                                            <select name="departamento" class="form-control select2" style="width: 100%;">
                                            <option value="" disabled selected>Seleccione... </option>
                                                <option value="Beni">Beni</option>
                                                <option value="Cochabamba">Cochabamba</option>
                                                <option value="Chuquisaca">Chuquisaca</option>
                                                <option value="La Paz">La Paz</option>
                                                <option value="Oruro">Oruro</option>
                                                <option value="Potosi">Potosi</option>
                                                <option value="Pando">Pando</option>
                                                <option value="Santa Cruz">Santa Cruz</option>
                                                <option value="Tarija">Tarija</option>
                                            </select>
                                        </div>
                                    </div>

                                    <!--FALTA CARGAR CALENDARIO-->
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label>FECHA DE NACIMIENTO:</label>
                                            <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                                <input type="date" name="fechaNac" class="form-control datetimepicker-input" data-target="#reservationdate"  />
                                                <!-- para calendario de admin -->
                                                <!-- <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                </div> -->
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">CONTACTO</label>
                                            <input type="text" class="form-control" name="telefono" placeholder="Número de celular">
                                        </div>

                                    </div>


                                </div>

                                <div class="row">
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="municipio">DIRECCION</label>
                                            <input type="text" class="form-control" name="direccion" placeholder="Dirección">
                                        </div>
                                    </div>

                                </div>

                                <div class="form-group">
    <label for="firma">Firma del Instructor (Para la emisión de certificados de los cursos realizados)<span style="color: red;">*</span></label>
    <input type="file" name="firma" class="form-control" required>
    <small class="form-text text-muted">Sube la imagen de la firma (formatos permitidos:.jpeg .jpg, .png).</small>
</div>



                            </div>
                            <!-- /.card-body -->


                        </form>
                    </div>
                    <!-- /.card -->
                    <div class="card-footer">
                        <button type="submit" class="btn btn-success ">Agregar</button>

                        <button type="reset" class="btn btn-success " onClick="history.go(-1);">Cancelar</button>
                    </div>
                    <p style="color: red; font-size: 0.9em; margin-top: 10px;">* Campos obligatorios</p>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!--/.col (right) -->
        </div>
        <!-- /.row -->

    </section>
</div><!-- /.container-fluid -->
<!-- ... (código anterior) ... -->



<!-- ... (código posterior) ... -->

<script>
var csrf_token = '<?php echo $this->security->get_csrf_hash(); ?>';


//         url: '<?php echo base_url('base/verificar_correo_existente'); ?>',
$(document).ready(function() {
    $('#destinatario').on('input', function() {
        var email = $(this).val();
        
        if (email) {
            var ajaxUrl = "<?php echo base_url('index.php/usuarios/verificar_correo'); ?>";

            $.ajax({
                url: ajaxUrl,
                type: "POST",
                data: { destinatario: email },
                success: function(response) {
                    var data = JSON.parse(response);
                    console.log("Respuesta del servidor:", data);

                    if (data.status === 'exists') {
                        $('#error-correo').text(data.message).fadeIn();
                    } else if (data.status === 'not_exists') {
                        $('#error-correo').text(data.message).fadeIn();
                    } else {
                        $('#error-correo').text('Respuesta inesperada del servidor.').fadeIn();
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error("Error en AJAX:", textStatus, errorThrown);
                    $('#error-correo').text("Ocurrió un error, por favor intente de nuevo.").fadeIn();
                }
            });
        } else {
            $('#error-correo').text('Por favor, ingrese un correo electrónico.').fadeOut();
        }
    });
});

</script>

<?php
echo form_close();
?>



<!--        </form>*/ -->


</div>


</div>
  <!-- /.content -->
</div>

<!-- /.content-wrapper -->