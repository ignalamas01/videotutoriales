<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>INSCRIBIR ESTUDIANTE A UN CURSO</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>index.php/base/index">Home</a></li>
                        <li class="breadcrumb-item active">Inscripción</li>
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

        <!-- Formulario de Inscripción -->
        <?php echo form_open_multipart('suscripciones/inscribirbd'); ?>
        
        <span id="error-correo" style="color: red;">
            <?php echo $this->session->flashdata('error_correo'); ?>
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
                                        Inscribir estudiante a un curso.
                                    </div>
                                <?php } ?>
                            </div> 

                            <div class="card-body">
                                <!-- Campo de búsqueda de estudiantes -->
                                <div class="form-group">
                                    <label>Lista de estudiantes</label>
                                    <select id="buscadorEstudiantes" name="id_estudiante" class="form-control form-select-lg required" style="width: 100%">
                                        <!-- Las opciones están cargadas dinámicamente -->
                                    </select>
                                </div>

                                <!-- Fecha de inicio y fin -->
                                <div class="row">
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label>FECHA DE INICIO:</label>
                                            <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                                <input type="date" name="fechaInicio" class="form-control datetimepicker-input" data-target="#reservationdate" required min="<?php echo date('Y-m-d'); ?>" />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-4">
                                        <div class="form-group">
                                            <label>FECHA DE FIN:</label>
                                            <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                                <input type="date" name="fechaFin" class="form-control datetimepicker-input" data-target="#reservationdate" required min="<?php echo date('Y-m-d'); ?>" />
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Campo de selección de curso -->
                                <div class="row">
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label>Cursos</label>
                                            <select name="id_curso" class="form-control form-select form-select-lg required" style="width: 100%" required>
                                                <option value="" disabled selected>Seleccione un curso</option>
                                                <?php foreach ($cursos->result() as $row) { ?>
                                                    <option value="<?php echo $row->id; ?>"><?php echo $row->titulo; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <!-- Botón de submit -->
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Inscribir</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <?php echo form_close(); ?>
    </div><!-- /.container-fluid -->
</div>

<!-- Scripts -->


<!-- JS de Select2 -->
<!-- Cargar jQuery -->
<!-- Cargar jQuery -->
<script src="boostrap/js/jquery-3.7.1.min.js"></script>

<!-- Cargar Select2 -->
<script src="adminlte/plugins/select2/js/select2.min.js"></script>

<script>
  $(document).ready(function() {
      // Verifica si select2 está disponible
      console.log($.fn.select2);

      // Inicializa select2
      $('#buscadorEstudiantes').select2({
          placeholder: "Seleccione al estudiante",
          allowClear: true,
          minimumInputLength: 2,  // Mínimo 2 caracteres para comenzar a buscar
          data: <?php echo $estudiantes_json; ?>, // Los datos JSON se pasan directamente desde el controlador
      });
  });
</script>

<script>
    console.log(<?php echo $estudiantes_json; ?>);  // Para ver cómo llega el JSON a la vista
</script>
