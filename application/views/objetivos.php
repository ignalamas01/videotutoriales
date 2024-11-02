<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contenido Principal - CEPRA</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
    <style>
        /* Estilos específicos para el contenido */
        .contenido-principal {
            font-family: 'Poppins', sans-serif;
            background-color: #f4f6f9;
            padding: 20px;
        }

        .contenido-principal h3 {
            font-size: 28px;
            font-weight: bold;
            color: #343a40;
            text-align: center;
            border-bottom: 2px solid #ddd;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }

        .contenido-principal p {
            color: #555;
            font-size: 16px;
            line-height: 1.6;
            text-align: justify;
            margin-bottom: 20px;
        }

        .contenido-principal article {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .contenido-principal .breadcrumb {
            background: none;
            padding: 0;
            margin: 0;
            float: right;
        }

        .contenido-principal .breadcrumb-item a {
            color: #007bff;
            text-decoration: none;
        }

        .contenido-principal .breadcrumb-item a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<!-- Contenido Principal -->
<div class="content-wrapper contenido-principal">
    <!-- Encabezado de contenido -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>CEPRA - Sistema de Videotutoriales</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>index.php/usuarios/logout">Cerrar sesión</a></li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <!-- Contenido principal -->
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3 class="pb-4 mb-4 fst-italic border-bottom">
                    CEPRA
                </h3>

                <article class="blog-post">
                    <p>Actualmente los videos tutoriales son de
                    gran difusión gracias a la masificación del
                    Internet, grabados estos se pueden colgar en
                    la web y llegan muy fácilmente a la
                    audiencia objetivo. El video es una
                    tecnología que permite la captura, la
                    grabación, edición, transmisión y
                    reproducción de secuencias de imágenes, lo
                    que hace que grabar videos tutoriales sea en
                    cierta forma una tarea relativamente sencilla,
                    gracias a los adelantos tecnológicos
                    actuales; la elaboración del contenido de los
                    mismos es lo que requiere un esfuerzo
                    mayor pues de él depende que se cumplan
                    los objetivos trazados que son en definitiva
                    la esencia de estos (Cárdenas Martinéz,
                    2013).</p>
                    <p>De tal suerte que hablar de las NTIC
                    (Nuevas Tecnologías de la Información y la
                    Comunicación) como herramientas de
                    apoyo en la educación es indispensable; el
                    rol que juegan es de suma importancia
                    permitiendo entre otras cosas la influencia
                    positiva en el proceso de enseñanza
                    aprendizaje, combinándolas con las formas
                    clásicas de enseñanza y no como sustitución
                    de ellas, igualmente estás son un gran apoyo
                    para el docente siempre y cuando éste
                    aprenda a utilizarlas correctamente y son, en
                    el caso de los videos, un apoyo en el proceso
                    de aprendizaje de los estudiantes
                    permitiendo como expresa Pompeya López
                    (2008) “una mayor individualización y
                    flexibilización del proceso instructivo
                    adecuándolo a las necesidades particulares
                    de cada alumno” y continua “permiten
                    presentar la información a través de
                    múltiples formas expresivas pudiendo
                    provocar la motivación del alumno y atender
                    a sus diferentes naturalezas cognitivas”.</p>
                    <p>Los videos tutoriales, objetivo de este proyecto, además de permitir ser una herramienta de apoyo al proceso de enseñanza...</p>
                    <p>Un aspecto importante a tener en cuenta con los videos tutoriales es saber si estos son realmente vistos por los estudiantes...</p>
                </article>
            </div>
        </div> 
    </div> 
</div> 

</body>
</html>
