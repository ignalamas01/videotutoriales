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

<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
        integrity="sha512-CBm3S5s0S1Bue2AZDsWOQ1MU1LwrV8lt7UZ0P2dpoYfJT1lCtCJCyooj6p9XzPka88nIsuGVrKOZ7+5uoX24gQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
        integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8sh+Wyb9B8c1kOgj3UqqquDd8hP6gIHSFfZ3Gp"
        crossorigin="anonymous">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles del Curso</title>
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Open Sans', sans-serif;
        }

        .content {
            margin-top: 20px;
        }

        .curso-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }
        h1, h2, h4, p {
            color: #333; /* Color del texto */
            text-align: center;
        }
        .seccion-container {
            margin-top: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 15px;
        }

        .seccion-titulo {
            font-weight: bold;
            cursor: pointer;
            color: #333;
        }

        .seccion-contenido {
            display: none;
            margin-top: 10px;
        }

        .btn-agregar-seccion {
            margin-top: 10px;
            
            
        }
        .btn-dar-evaluacion-curso {
        font-size: 18px;  /* Ajusta el tamaño del texto */
        padding: 12px 20px;  /* Ajusta el padding para controlar el tamaño del botón */
        border-radius: 10px;  /* Añade esquinas redondeadas */
        background-color: #4CAF50;  /* Cambia el color de fondo a verde */
        color: white;  /* Cambia el color del texto a blanco */
    }
    .btn-dar-evaluacion-seccion {
        font-size: 18px;  /* Ajusta el tamaño del texto */
        padding: 12px 20px;  /* Ajusta el padding para controlar el tamaño del botón */
        border-radius: 10px;  /* Añade esquinas redondeadas */
        background-color: #4CAF50;  /* Cambia el color de fondo a verde */
        color: white;  /* Cambia el color del texto a blanco */
    }
    .btn-warning123 {
    font-size: 18px;         /* Ajusta el tamaño del texto */
    padding: 12px 20px;      /* Ajusta el padding para controlar el tamaño del botón */
    border-radius: 10px;     /* Añade esquinas redondeadas */
    background-color: #5BC0EB;  /* Cambia el color de fondo a celeste */
    color: white;            /* Cambia el color del texto a blanco */
   
}
    </style>
</head>

<body>

    <div class="container">
        <?php if ($curso) : ?>
            <div class="curso-container">
                <h1 class="text-center"><?php echo $curso->titulo; ?></h1>
                <p><?php echo $curso->descripcion; ?></p>

                <!-- Secciones del Curso -->
                <!-- <h2 class="text-center">Secciones del Curso</h2> -->
                <?php
                $contadorSecciones = 0; // Inicializar el contador de secciones para este curso
                if ($secciones) :
                    foreach ($secciones as $seccion) : 
                        $contadorSecciones++; // Incrementar el contador para cada sección
                ?>
                        <div class="seccion-container">
                            <span class="seccion-titulo" data-target="#seccion-<?php echo $seccion->idSeccion; ?>">
                                Sección <?php echo $contadorSecciones; ?>: <?php echo $seccion->nombre; ?>
                            </span>
                            <div id="seccion-<?php echo $seccion->idSeccion; ?>" class="seccion-contenido">
                                <?php echo $seccion->descripcion; ?>
                    
                                <!-- Mostrar videos de la sección -->
                                <?php $videos = $this->vercurso_model->obtener_videos_por_seccion($seccion->idSeccion); ?>
                                <?php if ($videos) : ?>
                                    <h4>Videos de la Sección</h4>
                                    <ul>
                                        <?php foreach ($videos as $video) : ?>
                                            <li>
                                            <strong><?php echo $video->tituloVideo; ?></strong>
                                            <p><?php echo $video->descripcionVideo; ?></p>
                                            <iframe width="560" height="315" src="<?php echo $video->enlaceVideo; ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
    
                                            </li>
                                            <!-- Agrega el botón de evaluación para cada video -->
                            
                                        <?php endforeach; ?>
                                    </ul>
                                <?php else : ?>
                                    <p>No hay videos disponibles para esta sección.</p>
                                <?php endif; ?>
                    
                                <!-- Mostrar archivos de la sección -->
                                <?php $archivos = $this->vercurso_model->obtener_archivos_por_seccion($seccion->idSeccion); ?>
                                <?php if ($archivos) : ?>
                                    <h4>Archivos de la Sección</h4>
                                    <ul>
                                        <?php foreach ($archivos as $archivo) : ?>
                                            <li><?php echo $archivo->nombreArchivo; ?>: <a href="https://drive.google.com/uc?export=download&id=<?php echo $archivo->rutaArchivo; ?>" target="_blank">Descargar Archivo</a></li>

                                        <?php endforeach; ?>
                                    </ul>
                                    <form action="<?php echo base_url(); ?>index.php/cursos/realizar_evaluacion" method="post">
        <!-- Agregar el campo oculto idSeccion -->
        <input type="hidden" name="idSeccion" value="<?php echo $seccion->idSeccion; ?>">
        <input type="hidden" name="idCurso" value="<?php echo $curso->id; ?>">

        <!-- Botón de evaluación para la sección -->
        <button type="submit" class="btn-dar-evaluacion-seccion" data-seccion-id="<?php echo $seccion->idSeccion; ?>" data-video-id="<?php echo $video->idVideo; ?>">Dar Evaluación</button>
        </form>
                                <?php else : ?>
                                    <p>No hay archivos disponibles para esta sección.</p>
                                <?php endif; ?>
                            </div>
                        </div>
                        
                    <?php endforeach; ?>
                    
                    <?php else : ?>
        <p class="text-center">No hay secciones disponibles.</p>
                <?php endif; ?>

                <!-- Puedes agregar más secciones, archivos, videos, etc. aquí -->

            </div>
            
            <form action="<?php echo base_url(); ?>index.php/cursos/realizar_evaluacion" method="post">
        <!-- Agregar el campo oculto idCurso -->
        <input type="hidden" name="idCurso" value="<?php echo $curso->id; ?>">

        <!-- Botón de evaluación final -->
        <button type="submit" class="btn-dar-evaluacion-curso" data-curso-id="<?php echo $curso->id; ?>">Dar Evaluación Final</button>
        </form>


        <?php else : ?>
            <p class="text-center">Curso no encontrado.</p>
        <?php endif; ?>

    </div>
   <!-- Descripción para obtener el certificado -->
<p class="text-center mx-auto mt-4">Una vez terminado el curso y haber aprobado todas las pruebas, puedes reclamar tu certificado.</p>
<div class="text-center">
<!-- Botón para obtener el certificado -->
<form action="<?php echo base_url(); ?>index.php/certificados/emitir_certificado" method="post">
    <!-- Agregar el campo oculto idCurso -->
    <input type="hidden" name="idCurso" value="<?php echo $curso->id; ?>">

    <!-- Botón de evaluación final -->
    <button type="submit" class="btn-warning123"data-curso-id="<?php echo $curso->id; ?>">Obten tu Certificado del Curso</button> 
</form>

</div>
    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        $(document).ready(function () {
            $('.seccion-titulo').click(function () {
                var target = $($(this).data('target'));
                target.slideToggle();
            });

            $('.btn-agregar-seccion').click(function () {
                agregarNuevaSeccion();
            });
            $('.btn-dar-evaluacion-seccion').click(function () {
            var seccionId = $(this).data('seccion-id');
            // Lógica para dar evaluación a la sección con ID seccionId
            // Puedes redirigir a una página de evaluación o mostrar un formulario, etc.
            window.location.href = '<?php echo base_url(); ?>index.php/cursos/realizar_evaluacion';
        });

        $('.btn-dar-evaluacion-curso').click(function () {
            var cursoId = $(this).data('curso-id');
            // Lógica para dar evaluación al curso con ID cursoId
            // Puedes redirigir a una página de evaluación general, mostrar un formulario, etc.
            window.location.href = '<?php echo base_url(); ?>index.php/cursos/realizar_evaluacion';
        });
        
            function agregarNuevaSeccion() {
                // Lógica para agregar una nueva sección (similar a tu implementación)
                // Puedes adaptar el código según tus necesidades
            }
        });
        
        // ...
        // Agrega el siguiente código donde sea apropiado en tu lógica de visualización del curso
       

        // Llama a la función para actualizar la última visita
        
        // ...
    
    </script>
</body>

   