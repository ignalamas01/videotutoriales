<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Reporte de Cursos creados por los porfesores</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <!-- <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>index.php/base/index">Home</a></li> -->
                        <li class="breadcrumb-item active">Cursos</li>
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
                                <th>Nombre Completo</th>
                                <th>Cantidad Total de Cursos Creados</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $indice = 1; ?>
                            <?php foreach ($v_cursos_creados_empleados as $curso): ?>
                                <tr>
                                    <td><?= $indice; ?></td>
                                    <td><?= $curso->nombreCompleto ?></td>
                                    <td><?= $curso->cantidadTotalCursosCreados ?></td>
                                </tr>
                                <?php $indice++; ?>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>

