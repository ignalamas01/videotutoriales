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
                            <!-- <th>Vista</th> -->
                        </tr>
                    </thead>
                    <tbody>
                        
                        <?php
                        $indice = 1;
                        foreach ($evaluaciones as $row)
                        {
                            $idCurso = $row->idCurso;
                            $idEvaluacion = $row->idEvaluacion; 
                            if ($idCurso !== null) {
                                $cursoInfo = $this->certificados_model->obtener_curso_y_seccion_por_id($idEvaluacion);

    // Verificar si se obtuvo la información
    if ($cursoInfo) {
        $cursoTitulo = $cursoInfo['curso_titulo'];
        $seccionNombre = $cursoInfo['seccion_nombre'] ?? 'Sin sección asignada';
    } else {
        $cursoTitulo = 'Sin título';
        $seccionNombre = 'Sin sección asignada';
    }
    }
                        ?>
                            <tr>
                                <td> <?php echo $indice; ?> </td>
                                <td><?php echo $cursoInfo['curso_titulo']; ?></td>
<td><?php echo ($cursoInfo['seccion_nombre'] !== null) ? $cursoInfo['seccion_nombre'] : 'PRUEBA GENERAL'; ?></td>                                
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
                                <!-- <td style="text-decoration: underline;"><?php echo 'Ver Evaluacion'; ?></td> -->
                                <!-- <td>
    <button class="btn btn-ver-evaluacion" data-id-evaluacion="<?php echo $row->id; ?>">Ver Evaluación</button>
</td>
                            </tr> -->
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
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
    $(document).ready(function () {
        // Maneja el clic en los botones con la clase 'btn-ver-evaluacion'
        $('.btn-ver-evaluacion').on('click', function () {
            // Obtiene el ID de la evaluación asociado al botón clicado
            var idEvaluacion = $(this).data('id-evaluacion');

            // Llama a la función que quieras ejecutar, pasando el ID de la evaluación
            verEvaluacion(idEvaluacion);
        });

        // Agrega tu función específica para ver la evaluación
        function verEvaluacion(idEvaluacion) {
            // Aquí puedes agregar la lógica para ver la evaluación con el ID proporcionado
            alert('Ver evaluación con ID: ' + idEvaluacion);
        }
    });
</script>




