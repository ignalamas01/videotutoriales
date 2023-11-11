
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
        <h2 class="featurette-heading">INSCRIBIR ESTUDIANTE A UN CURSO<span class="text-muted"></span></h2>


    </div>
    <!-- <div class="col-md-5">
        <center><img src="<?php echo base_url(); ?>img/imgvt.png" width="120"></center>

    </div> -->

    <!--<div col-md-12> -->



    <?php
    /*  lo mismo que multipart  y form
                <form action="<?php echo base_url(); ?>index.php/estudiante/agregarbd" method="POST">
                */ ?>
    <?php
    echo form_open_multipart('suscripciones/inscribirbd')
    ?>


<span id="error-correo" style="color: red;">
    <?php
    // Muestra mensajes de error específicos desde la sesión aquí
    echo $this->session->flashdata('error_correo');
    ?>
</span>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-9">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Datos</h3>
                        </div>


                        <div id="alert-container">
                            <?php if ($this->session->flashdata('mensaje')) { ?>
                                <div class="alert alert-success" role="alert">
                                    <?php echo $this->session->flashdata('mensaje'); ?>
                                </div>
                            <?php } elseif (empty($this->session->flashdata('mensaje')) && empty($this->session->flashdata('error'))) { ?>
                                <div class="alert alert-danger" role="alert">
                                    inscribir estudiante a un curso.
                                </div>
                            <?php } ?>
                        </div> 


<!-- /.card-header -->
                        <!-- form start -->
                        <form>
                            <div class="card-body">
                               
                                <div class="form-group">
                                  <!-- <label for="newEmail">Correo Electrónico</label>
                                     <input type="email" id="destinatario" name="destinatario" placeholder="Escriba su correo electrónico" class="form-control"  onkeyup="verificarCorreoExistente()"> -->

                                        <span id="error-correo" style="color: red;"></span>
    


                                

                                
                                <section>
      <div class="row">
        <div class="col-4">
            <div class="form-group">
                 <label>lista de estudiantes</label>
                                            
                        <select name="id_estudiante" class="form-control form-select form-select-lg required" style="width: 100%">
                        <option value="" disabled selected>Seleccione al estudiante </option>
                        <?php
                          foreach ($estudiante->result() as $row) {
                          echo '<option value="' . $row->id . '">' . $row->nombre . '</option>';
                      }
                          ?>
                      </select>
            </div>
            
        </div>
        <div class="col-4">
                                        <div class="form-group">
                                            <label>FECHA DE INICIO:</label>
                                            <div class="input-group date" id="reservationdate" data-target-input="nearest" >
                                                <input type="date" name="fechaInicio" class="form-control datetimepicker-input" data-target="#reservationdate" required />
                                                <!-- para calendario de admin -->
                                                <!-- <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                </div> -->
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label>FECHA DE FIN:</label>
                                            <div class="input-group date" id="reservationdate" data-target-input="nearest" >
                                                <input type="date" name="fechaFin" class="form-control datetimepicker-input" data-target="#reservationdate" required />
                                                <!-- para calendario de admin -->
                                                <!-- <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                </div> -->
                                            </div>
                                        </div>
                                    </div>

                                        
      </div>
      
                                    
    </section>

        <section>
      <div class="row">
        <div class="col-4">
            <div class="form-group">
                 <label>cursos</label>
                                            
                        <select name="id_curso" class="form-control form-select form-select-lg required" style="width: 100%" required>
                        <option value="" disabled selected>Seleccione un curso</option>
                        <?php
                          foreach ($cursos->result() as $row) {
                          echo '<option value="' . $row->id . '">' . $row->titulo . '</option>';
                      }
                          ?>
                      </select>
            </div>
            
        </div>
                                        
      </div>
      
                                    
    </section>
                               





                            </div>
                            <!-- /.card-body -->


                        </form>
                    </div>
                    <!-- /.card -->
                    <div class="card-footer">
                        <button type="submit" class="btn btn-success " data-toggle="modal" data-target="#mensajeModal">Agregar</button>
                        

                        <button type="reset" class="btn btn-success " onClick="history.go(-1);">Cancelar</button>
                    </div>

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

// Función para verificar si el correo ya existe
// function verificarCorreoExistente() {
//     console.log('Función llamada'); 
//     var destinatario = document.getElementById('destinatario').value;

//     // Realiza una solicitud AJAX para verificar el correo en el servidor
//     // Debes crear una ruta en tu controlador para manejar esta solicitud
//     // Aquí se muestra un ejemplo básico
//     $.ajax({
//         url: '<?php echo base_url('base/verificar_correo_existente'); ?>',
//         type: 'POST',
//         data: { destinatario: destinatario },
//         success: function(response) {
//             if (response == 'existe') {
//                 // El correo ya existe, muestra un mensaje de error
//                 document.getElementById('error-correo').innerHTML = 'El correo ya existe';
//             } else {
//                 // El correo no existe, limpia el mensaje de error si lo hay
//                 document.getElementById('error-correo').innerHTML = '';
//             }
//         },
//         error: function(xhr, status, error) {
//             console.error('Error en la solicitud AJAX:', error);
//         }
//     });
// }

// Manejar el evento de envío del formulario
// $(document).ready(function() {
//     $('#miFormulario').submit(function(event) {
//         // Evitar el envío predeterminado del formulario
//         event.preventDefault();
        
//         // Realizar la verificación antes de enviar los datos al servidor
//         verificarCorreoExistente();

//         // Aquí puedes agregar lógica adicional antes de enviar el formulario al servidor
//         // Por ejemplo, podrías verificar otros campos o realizar otras validaciones.

//         // Finalmente, si todo está bien, puedes enviar el formulario al servidor
//         this.submit();
//     });
// });
</script>

<?php
echo form_close();
?>



<!--        </form>*/ -->






</div>


<!-- /.content-wrapper -->

<!-- <div class="row featurette">
    <div class="col-md-7">
        <br>
        <h2 class="featurette-heading">AGREGAR ESTUDIANTE<span class="text-muted"> ****</span></h2>
        <section>
      <div class="row">
        <div class="col-4">
            <div class="form-group">
                 <label>lista de estudiantes</label>
                                            
                        <select name="id" class="form-control form-select form-select-lg required" style="width: 100%">
                        <option value="" disabled selected>Seleccione al estudiante </option>
                        <?php
                          foreach ($estudiante->result() as $row) {
                          echo '<option value="' . $row->id . '">' . $row->nombre . '</option>';
                      }
                          ?>
                      </select>
            </div>
        </div>
                                        
      </div>
      
                                    
    </section>

        <section>
      <div class="row">
        <div class="col-4">
            <div class="form-group">
                 <label>CURSOS</label>
                                            
                        <select name="id" class="form-control form-select form-select-lg required" style="width: 100%">
                        <option value="" disabled selected>Seleccione un curso</option>
                        <?php
                          foreach ($cursos->result() as $row) {
                          echo '<option value="' . $row->id . '">' . $row->titulo . '</option>';
                      }
                          ?>
                      </select>
            </div>
        </div>
                                        
      </div>
      
                                    
    </section>
    
    
</div> -->
<!-- Agregar esto a tu página HTML, generalmente dentro de un <script> al final de la vista -->


    
</div>

<!-- Agregar esto a tu página HTML en la vista agregarEstudiante -->
<script type="text/javascript">
    $(document).ready(function () {
        // Este script se ejecutará cuando la página se cargue
        $('#mensajeModal').modal('show'); // Muestra el modal automáticamente
    });
</script>
<script type="text/javascript">
    // Cierra la alerta cuando se hace clic en el botón de cierre (×)
    $('.alert').on('click', '.close', function () {
        $(this).parent().hide();
    });
</script>




