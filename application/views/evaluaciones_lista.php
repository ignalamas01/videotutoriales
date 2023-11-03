<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Lista de Evaluaciones</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <!-- <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>index.php/base/index">Home</a></li> -->
                        <!-- <li class="breadcrumb-item active">Lista de Evaluaciones</li> -->
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
                    <table class="table table-bordered" id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>N°</th>
                            <th>Curso</th>
                            <th>Seccion</th>
                            <th>Puntuacion</th>
                            <th>Estado</th>
                            <th>Examen iniciado</th>
                            <th>Vista</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                        <?php
                        $indice = 1;
                        foreach ($evaluaciones as $row)
                        {
                        ?>
                            <tr>
                                <td> <?php echo $indice; ?> </td>
                                <td><?php echo $row->idCurso; ?></td>
                                <td><?php echo $row->idEstudiante; ?></td>
                                <td><?php echo $row->puntajeTotal; ?></td>
                                <td><?php
    // Agrega una condición para determinar si es Aprobado o Reprobado
                                    if ($row->puntajeTotal > 60) {
                                            echo 'Aprobado';
                                                    } else {
                                                 echo 'Reprobado';
                                                             }
                                                    ?></td>
                                <td><?php echo $row->fechaRegistro; ?></td>
                                <td><?php echo 'Ver Evaluacion'; ?></td>
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





