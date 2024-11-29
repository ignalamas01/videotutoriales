<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Reporte de Cursos creados por los profesores</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active">Cursos</li>
                        <li class="breadcrumb-item"><a href="<?= base_url(); ?>index.php/usuarios/logout">Cerrar sesión</a></li>
                    </ol>
                </div>
            </div>
            <div class="card shadow-sm p-4">
                <h3 class="text-center text-success mb-4">
                    <i class="fas fa-chart-line"></i> Filtro de Cursos Creados
                </h3>
                <form action="<?= base_url('index.php/reportecursos/listacreados') ?>" method="get" class="form-inline justify-content-center mb-4">
                    <div class="form-group mb-2">
                        <label for="fecha_inicio" class="mr-2">Fecha Inicio:</label>
                        <input type="date" id="fecha_inicio" class="form-control" name="fecha_inicio" 
                               value="<?= isset($fecha_inicio) ? $fecha_inicio : '' ?>" required>
                    </div>
                    <div class="form-group mx-sm-3 mb-2">
                        <label for="fecha_fin" class="mr-2">Fecha Fin:</label>
                        <input type="date" id="fecha_fin" class="form-control" name="fecha_fin" 
                               value="<?= isset($fecha_fin) ? $fecha_fin : '' ?>" required>
                    </div>
                    <button type="submit" class="btn btn-primary mb-2 ml-2" title="Buscar cursos por fechas">
                        <i class="fas fa-search"></i> Filtrar
                    </button>
                </form>
                <div class="text-center">
                    <a href="<?= base_url('index.php/reportecursos/generar_pdf?fecha_inicio=' . urlencode($fecha_inicio ?? '') . '&fecha_fin=' . urlencode($fecha_fin ?? '')); ?>" 
                       class="btn btn-success" 
                       title="Generar reporte en PDF">
                        <i class="fas fa-file-pdf"></i> Generar Reporte
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <!-- Tabla con los datos -->
                    <table class="table table-bordered" id="example1">
                        <thead>
                            <tr>
                                <th>N°</th>
                                <th>Nombre Completo</th>
                                <th>Cantidad Total de Cursos Creados</th>
                                <th>Nombres de los Cursos</th> <!-- Nueva columna -->
                            </tr>
                        </thead>
                        <tbody>
                            <?php $indice = 1; ?>
                            <?php if (!empty($v_cursos_creados_empleados)): ?>
                                <?php foreach ($v_cursos_creados_empleados as $curso): ?>
                                    <tr>
                                        <td><?= $indice; ?></td>
                                        <td><?= $curso->nombreCompleto; ?></td>
                                        <td><?= $curso->cantidadTotalCursosCreados; ?></td>
                                        <td><?= $curso->nombresCursos; ?></td> <!-- Mostrar los nombres de los cursos -->
                                    </tr>
                                    <?php $indice++; ?>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="4" class="text-center">No hay datos disponibles para las fechas seleccionadas</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>
