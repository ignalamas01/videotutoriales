<!DOCTYPE html>
<html>
<head>
    <title> Evaluación</title>
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
            padding: 20px;
            background-color: #f5f5f5;
            border-radius: 5px;
        }

        label {
            font-weight: bold;
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

<h1> <?php echo $tituloEvaluacion; ?></h1>
<?php echo $descripcionEvaluacion; ?>

    <?php echo form_open('evaluaciones_estudiante/procesar_evaluacion', array('id' => 'executionForm')); ?>

    <?php if (!empty($preguntas)) : ?>
        <?php foreach ($preguntas as $index => $pregunta) : ?>
            <div class="question">
                <p>Pregunta <?php echo $index + 1; ?>:</p>
                <p><?php echo $pregunta['enunciadoPregunta']; ?></p>
                <p> (<?php echo $pregunta['puntajePregunta']; ?> Puntos)</p>
                <?php if (!empty($pregunta['opciones'])) : ?>
                    <?php foreach ($pregunta['opciones'] as $opcionIndex => $opciones) : ?>
                        <label>
                            <input type="radio" name="respuestas[<?php echo $index; ?>]" value="<?php echo $opcionIndex; ?>" required>
                            <?php echo is_array($opciones) ? implode(', ', $opciones) : $opciones; ?>
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
</body>
</html>

