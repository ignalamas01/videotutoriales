<!-- <!DOCTYPE html>
<html>
<head>
    <title>Reporte de Estudiantes y Cursos</title>
</head>
<body>
    <h1>Reporte de Estudiantes y Cursos</h1>
    <table>
        <tr>
            <th>Nombre del Estudiante</th>
            <th>Cantidad de Cursos</th>
        </tr>
        <?php foreach ($estudiantes_cursos as $estudiante): ?>
        <tr>
            <td><?= $estudiante->nombre_estudiante ?></td>
            <td><?= $estudiante->cantidad_cursos ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html> -->
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>lista de estudiantes inscritos en cursos</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <!-- <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>index.php/base/index">Home</a></li> -->
                        <li class="breadcrumb-item active">Lista de Suscritos</li>
                        <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>index.php/usuarios/logout">Cerrar sesión</a></li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <!-- Agrega aquí la lista desplegable con los títulos de los cursos -->
                

                <!-- Agrega aquí la tabla con los datos -->
                <table class="table table-bordered" id="example1">
    <thead>
        <tr>
            <th>N°</th>
            <th>Nombre del Estudiante</th>
            <th>Cantidad de cursos inscritos</th>
            <th>Cursos</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $indice = 1;
        foreach ($estudiantes_cursos as $row) {
        ?>
            <tr>
                <td><?php echo $indice; ?></td>
                <td><?php echo $row->nombre_estudiante; ?></td>
                <td><?php echo $row->cantidad_cursos; ?></td>
                <td>
                    <div class="form-group">
                        <label for="cursoSelect<?php echo $indice; ?>">Selecciona un curso:</label>
                        <select class="form-control cursoSelect" id="cursoSelect<?php echo $indice; ?>">
                            <option value="">Seleccione un curso</option>
                            <?php foreach ($cursos as $curso) { ?>
                                <option value="<?php echo $curso->id; ?>"><?php echo $curso->titulo; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </td>
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

