<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Estudiantes inscritos en cursos</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
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
                            <?php $indice = 1; ?>
                            <?php foreach ($estudiantes_cursos as $row) { ?>
                                <tr>
                                    <td><?php echo $indice; ?></td>
                                    <td><?php echo $row->nombre_estudiante; ?></td>
                                    <td><?php echo $row->cantidad_cursos; ?></td>
                                    <td>
                                        <div class="form-group">
                                            <label for="cursoSelect<?php echo $indice; ?>"></label>
                                            <select class="form-control cursoSelect" id="cursoSelect<?php echo $indice; ?>">
                                                <option value="">Ver cursos</option>
                                                <?php
                                                // Convertir la cadena de cursos en un array y luego mostrar cada curso como una opción
                                                $cursos_inscritos = explode(',', $row->titulos_cursos);
                                                foreach ($cursos_inscritos as $curso) {
                                                    echo '<option value="' . $curso . '">' . $curso . '</option>';
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </td>
                                </tr>
                                <?php $indice++; ?>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>

    <!-- Sección para el gráfico de torta -->
    <section class="content">
        <div class="container-fluid">
            <h2>Distribución de Inscripción en Cursos</h2>
            <canvas id="chartCursos" width="400" height="400"></canvas>
        </div>
    </section>
</div>

<!-- Incluir la biblioteca Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    // Obtener los datos de PHP (asegúrate de pasar los datos desde el controlador)
    const titulosCursos = <?= json_encode($titulos_cursos); ?>;
    const cantidadInscritos = <?= json_encode($cantidad_inscritos); ?>;

    // Verificar si hay datos para mostrar
    if (titulosCursos.length > 0 && cantidadInscritos.length > 0) {
        // Configuración del gráfico
        const ctx = document.getElementById('chartCursos').getContext('2d');
        const chartCursos = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: titulosCursos,
                datasets: [{
                    label: 'Cantidad de Inscritos',
                    data: cantidadInscritos,
                    backgroundColor: [
                        '#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF', '#FF9F40'
                    ],
                    hoverOffset: 4
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    }
                }
            }
        });
    } else {
        console.log('No hay datos disponibles para mostrar en el gráfico.');
    }
</script>
