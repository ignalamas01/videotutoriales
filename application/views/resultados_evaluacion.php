<!-- resultados_evaluacion.php -->

<!DOCTYPE html>
<html>
<head>
    <title>Resultados de la Evaluación</title>
    <!-- Agrega tus estilos, enlaces a CSS, etc. según sea necesario -->
</head>
<body>
    <h1>Resultados de la Evaluación</h1>

    <p>Puntaje Total: <?php echo $puntajeTotal; ?></p>

    <h2>Puntajes por Pregunta:</h2>
    <ul>
        <?php foreach ($puntajesPorPregunta as $idPregunta => $puntaje) : ?>
            <li>Pregunta <?php echo $idPregunta; ?>: <?php echo $puntaje; ?></li>
        <?php endforeach; ?>
    </ul>

    <!-- Puedes agregar más información según tus necesidades -->

</body>
</html>
