<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Estudiantes no graduados</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <!-- <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>index.php/base/index">Home</a></li> -->
                        <li class="breadcrumb-item active">No graduados</li>
                        <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>index.php/usuarios/logout">Cerrar sesión</a></li>
                    </ol>
                </div>
            </div>
            
            <div class="card shadow-sm p-4">
                <h3 class="text-center text-success mb-4">
                    <i class="fas fa-chart-line"></i> Filtro de Estudiantes no graduados
                </h3>
                <form action="<?= base_url('index.php/nograduados/lista') ?>" method="post" class="form-inline justify-content-center mb-4">
                <div class="form-group mb-2">
        <label for="fecha_inicio" class="mr-2">Fecha Inicio:</label>
        <input type="date" class="form-control" name="fecha_inicio" value="<?= isset($fecha_inicio) ? $fecha_inicio : '' ?>" required>
    </div>
    <div class="form-group mx-sm-3 mb-2">
        <label for="fecha_fin" class="mr-2">Fecha Fin:</label>
        <input type="date" class="form-control" name="fecha_fin" value="<?= isset($fecha_fin) ? $fecha_fin : '' ?>" required>
    </div>
    <button type="submit" class="btn btn-primary mb-2 ml-2" title="Buscar suscripciones por fechas">
        <i class="fas fa-search"></i> Filtrar
    </button>
    </form>
                <div class="text-center">
                <a href="<?= base_url('/index.php/nograduados/generar_pdf?fecha_inicio=' . urlencode($fecha_inicio) . '&fecha_fin=' . urlencode($fecha_fin)); ?>" class="btn btn-success"><i class="fas fa-file-pdf"></i> Generar reportes</a>
                <i class="fas fa-file-pdf"></i>
                </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <!-- Agrega aquí la tabla con los datos -->
                <table class="table table-bordered" id="example1">
                    <thead>
                        <tr>
                            <th>N°</th>
                            <th>Nombres y apellidos</th>
                            <th>Curso no concluido</th>
                            <th>Porcentaje de avance</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $indice = 1;
                        foreach ($estudiantes_no_graduados as $row) {
                        ?>
                            <tr>
                                <td><?php echo $indice; ?></td>
                                <td><?php echo $row->nombreCompleto; ?></td>
                                <td><?php echo $row->tituloCurso; ?></td>
                                <td><?php echo $row->porcentajeCompletado; ?>%</td>
                            </tr>
                            <?php
                            $indice++;
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>


</div>





