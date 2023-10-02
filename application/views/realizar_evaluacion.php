<!DOCTYPE html>
<html>
<head>
    <title>Ejecutar Evaluación</title>
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
    <h1>Ejecutar Evaluación</h1>

    <?php echo form_open('evaluaciones_estudiante/procesar_evaluacion'); ?>
    <form id="executionForm">

       
            <?php foreach ($preguntas as $index => $pregunta): ?>
                <div class="question">
                    <p>Pregunta <?php echo $index + 1; ?>:</p>
                    <p><?php echo $pregunta['enunciadoPregunta']; ?></p>

                    <?php if (!empty($pregunta['opciones'])) : ?>
                        <?php foreach ($pregunta['opciones'] as $opcionIndex => $opcion): ?>
                            <label>
                                <input type="radio" name="respuestas[<?php echo $index; ?>]" value="<?php echo $opcionIndex; ?>" required>
                                <?php echo $opcion; ?>
                            </label>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p>No hay opciones de respuesta disponibles para esta pregunta.</p>
                    <?php endif; ?>

                </div>
            <?php endforeach; ?>
        

        <input type="submit" value="Enviar Respuestas">
    </form>
    <?php echo form_close(); ?>
</body>
</html>