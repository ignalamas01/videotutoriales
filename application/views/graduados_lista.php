<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Estudiantes graduados</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <!-- <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>index.php/base/index">Home</a></li> -->
                        <li class="breadcrumb-item active">Graduados</li>
                        <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>index.php/usuarios/logout">Cerrar sesión</a></li>
                    </ol>
                </div>
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
                            <th>Nombre y apellidos</th>
                            <th>Curso finalizado</th>
                            <th>Porcentaje de avance</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $indice = 1;
                        foreach ($estudiantes_completos as $row) {
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





