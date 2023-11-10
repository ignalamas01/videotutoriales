<!DOCTYPE html>
<html>
<head>
    <title>Evaluación</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
        }

        h1 {
            text-align: center;
        }

        form {
            max-width: 600px;
            margin: 0 auto;
            padding: 18px;
            background-color: #f5f5f5;
            border-radius: 5px;
        }
        .question p {
    font-size: 20px; /* Ajusta el tamaño del texto según sea necesario */
    font-weight: bold;
    margin-bottom: 10px; /* Agrega espacio entre los enunciados y otros elementos */
}

        label {
            /* font-weight: bold; */
            display: block; /* Agregamos esto para que cada opción esté en una nueva línea */
        }

        input[type="radio"] {
            margin-right: 5px;
        }

        button {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 3px;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
<p>Tiempo Restante: <span id="countdownTimer"></span></p>
<h1><?php echo $tituloEvaluacion; ?></h1>
<p><?php echo $descripcionEvaluacion; ?></p>
<p>Puntaje Total: <?php echo $puntajeTotal; ?></p>

<?php echo form_open('evaluaciones_estudiante/procesar_evaluacion', array('id' => 'executionForm')); ?>
<input type="hidden" name="idCurso" value="<?php echo $idCurso; ?>">
<?php if (!empty($preguntas)) : ?>
    <?php foreach ($preguntas as $index => $pregunta) : ?>
        <div class="question">
            <p>Pregunta <?php echo $index + 1; ?>:</p>
            <p><?php echo $pregunta['enunciadoPregunta']; ?></p>
            <!-- Mostrar imagen si existe -->
        <?php if (!empty($pregunta['imagen'])) : ?>
            <!-- <?php echo $pregunta['imagen']; ?> -->
            <img src="<?php echo base_url($pregunta['imagen']); ?>"  style="max-width: 100%; display: block; margin: 0 auto;">
           
        <?php endif; ?>
            <p>(<?php echo $pregunta['puntajePregunta']; ?> Puntos)</p>
            <?php if (!empty($pregunta['opciones'])) : ?>
                <?php foreach ($pregunta['opciones'] as $opcionIndex => $opciones) : ?>
                    <label>
                        <input type="radio" name="respuestas[<?php echo $index; ?>]" value="<?php echo $opcionIndex; ?>" required>
                        
                        <!-- <?php echo is_array($opciones) ? implode(', ', $opciones) : $opciones; ?> -->
                        <!-- <?php echo implode(', ', array_slice($opciones, 1)); ?> -->
                        <?php echo array_shift($opciones); ?>
                    </label>
                <?php endforeach; ?>

                <!-- Agregar campo oculto para 'idPregunta' -->
                <input type="hidden" name="idPregunta[<?php echo $index; ?>]" value="<?php echo $pregunta['idPregunta']; ?>">
            <?php else : ?>
                <p>No hay opciones de respuesta disponibles para esta pregunta.</p>
            <?php endif; ?>

        </div>
    <?php endforeach; ?>

    <?php if (isset($preguntas[0]['idEvaluacion'])) : ?>
        <!-- Agregar campo oculto para 'idEvaluacion' -->
        <input type="hidden" name="idEvaluacion" value="<?php echo $preguntas[0]['idEvaluacion']; ?>">
    <?php endif; ?>

<?php else : ?>
    <p>No hay preguntas disponibles.</p>
<?php endif; ?>

<!-- Agregar campos ocultos para idEvaluacion e idPregunta -->
<input type="submit" value="Enviar Respuestas">
<?php echo form_close(); ?>
<input type="hidden" name="idEstudiante" value="<?php echo isset($idEstudiante) ? $idEstudiante : ''; ?>">

<script>
  // Función para iniciar el cronómetro
  function startCountdown(duration) {
    if (!duration || duration === '00:00') {
      document.getElementById('countdownTimer').innerText = 'Sin tiempo límite';
      return;
    }

    const [hours, minutes] = duration.split(':');
    let timeRemaining = parseInt(hours) * 3600 + parseInt(minutes) * 60;

    // Función para actualizar y mostrar el tiempo restante
    function updateTimer() {
      const displayHours = Math.floor(timeRemaining / 3600);
      const displayMinutes = Math.floor((timeRemaining % 3600) / 60);
      const displaySeconds = timeRemaining % 60;

      // Formatear el tiempo como HH:MM:SS
      const formattedTime = `${displayHours.toString().padStart(2, '0')}:${displayMinutes.toString().padStart(2, '0')}:${displaySeconds.toString().padStart(2, '0')}`;

      // Mostrar el tiempo en algún elemento HTML
      document.getElementById('countdownTimer').innerText = formattedTime;

      // Verificar si el tiempo restante es 0
      if (timeRemaining === 0) {
        document.getElementById('countdownMessage').innerText = 'Examen terminado';
      }

      // Reducir el tiempo restante
      timeRemaining--;

      // Si el tiempo restante es mayor que cero, programar la próxima actualización
      if (timeRemaining >= 0) {
        setTimeout(updateTimer, 1000); // Actualizar cada 1 segundo
      }
    }

    // Iniciar el cronómetro
    updateTimer();
  }

  // Iniciar el cronómetro cuando la página esté completamente cargada
  document.addEventListener('DOMContentLoaded', function () {
    const duracion = "<?php echo $duracion; ?>"; // Obtener la duración desde PHP
    startCountdown(duracion);
  });
</script>



</body>
</html>

