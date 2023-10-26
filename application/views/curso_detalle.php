<!DOCTYPE html>
<html lang="en">

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

        .seccion-container {
            margin-top: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 15px;
        }

        .seccion-titulo {
            font-weight: bold;
            cursor: pointer;
        }

        .seccion-contenido {
            display: none;
            margin-top: 10px;
        }

        .btn-agregar-seccion {
            margin-top: 10px;
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
            <h2 class="text-center">Secciones del Curso</h2>
            <?php if ($secciones) : ?>
            <?php foreach ($secciones as $seccion) : ?>
            <div class="seccion-container">
                <span class="seccion-titulo" data-target="#seccion-<?php echo $seccion->idSeccion; ?>">
                    Sección <?php echo $seccion->idSeccion; ?>: <?php echo $seccion->nombre; ?>
                </span>
                <div id="seccion-<?php echo $seccion->idSeccion; ?>" class="seccion-contenido">
                    <?php echo $seccion->descripcion; ?>
                    <!-- Puedes agregar más detalles de sección aquí -->
                </div>
            </div>
            <?php endforeach; ?>
            <?php else : ?>
            <p class="text-center">No hay secciones disponibles.</p>
            <?php endif; ?>

            <!-- Puedes agregar más secciones, archivos, videos, etc. aquí -->

        </div>
        <?php else : ?>
        <p class="text-center">Curso no encontrado.</p>
        <?php endif; ?>

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

            function agregarNuevaSeccion() {
                // Lógica para agregar una nueva sección (similar a tu implementación)
                // Puedes adaptar el código según tus necesidades
            }
        });
    </script>
</body>

</html>
