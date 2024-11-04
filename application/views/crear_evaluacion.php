<!DOCTYPE html>
<html>
<head>
    <title>Crear Evaluación</title>
    <style>
        /* Estilos básicos */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #e9ecef;
        }

        /* Contenedor principal */
        .container {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 20px;
        }

        /* Cabecera */
        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        /* Formulario */
        form {
            width: 100%;
            max-width: 600px;
            padding: 20px;
            background-color: #f5f5f5;
            border-radius: 5px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }

        label {
            font-weight: bold;
            display: block;
            margin-top: 10px;
        }

        input[type="text"],
        input[type="date"],
        input[type="number"],
        input[type="time"],
        textarea,
        select {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 3px;
        }

        /* Botones */
        button, input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 3px;
            cursor: pointer;
        }

        button:hover, input[type="submit"]:hover {
            background-color: #0056b3;
        }

        /* Estilos para preguntas */
        .question {
            background-color: #fff;
            padding: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-bottom: 20px;
        }

        /* Botón de eliminar pregunta */
        .deleteButton {
            background-color: #dc3545;
            color: #fff;
            border: none;
            padding: 5px 10px;
            border-radius: 3px;
            cursor: pointer;
        }

        .deleteButton:hover {
            background-color: #c82333;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Crear Evaluación</h1>
        <?php echo form_open_multipart('evaluaciones/agregarbd'); ?>
            <label for="title">Título de la Evaluación:</label>
            <input type="text" id="title" name="title" required>

            <label for="description">Descripción:</label>
            <textarea id="description" name="description"></textarea>

            <label for="startDate">Fecha de Habilitación:</label>
            <input type="date" id="startDate" name="startDate" min="<?php echo date('Y-m-d'); ?>">

            

            <label for="deadline">Fecha de Vencimiento:</label>
            <input type="date" id="deadline" name="deadline"min="<?php echo date('Y-m-d'); ?>">

            <label for="curso">Curso en general:</label>
            <select id="curso" name="curso" onchange="handleSelection('curso')">
                <option value="">Seleccionar Curso</option>
                <?php foreach ($cursos as $curso) : ?>
                    <option value="<?php echo $curso->id; ?>" data-curso-id="<?php echo $curso->id; ?>"><?php echo $curso->titulo; ?></option>
                <?php endforeach; ?>
            </select>

            <label for="seccion">Curso y sección en específico:</label>
            <select id="seccion" name="seccion" onchange="handleSelection('seccion')">
                <option value="">Seleccionar Sección</option>
                <?php foreach ($secciones as $seccion) : ?>
                    <option value="<?php echo $seccion->idSeccion; ?>" data-curso-id="<?php echo $seccion->idCurso; ?>">
                        <?php echo $seccion->nombre; ?> - <?php echo $seccion->tituloCurso; ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <input type="hidden" id="hiddenCursoId" name="hiddenCursoId" value="">
            <input type="hidden" id="hiddenSeccionId" name="hiddenSeccionId" value="">

            <h2>Preguntas de Selección Múltiple</h2>
            <div id="questions">
                <div class="question">
                    <label for="question1">Pregunta 1:</label>
                    <input type="text" id="question1" name="questions[]" required>

                    <label for="imageQuestion1">Imagen de la Pregunta:</label>
                    <input type="file" id="imageQuestion1" name="imageQuestion[]" accept="image/*" multiple>

                    <label for="options1">Opciones de Respuesta (separadas por comas):</label>
                    <input type="text" id="options1" name="options[]" required>

                    <label for="correctOptions1">Respuesta Correcta:</label>
                    <input type="text" id="correctOptions1" name="correctOptions[]" required>

                    <label for="score1">Puntaje de la Pregunta:</label>
                    <input type="number" id="score1" name="scores[]" required onchange="updateTotalScore()">
                </div>
            </div>
            <button type="button" onclick="addQuestion()">Agregar Pregunta</button>

            <label for="totalScore">Puntaje Total:</label>
            <input type="text" id="totalScore" name="totalScore" readonly value="0">

            <label for="numeroIntentos">Número de Intentos Permitidos:</label>
            <input type="number" id="numeroIntentos" name="numeroIntentos" value="1" min="1" required>

            <label for="duracion">Duración de la Evaluación (HH:MM):</label>
            <input type="time" id="duracion" name="duracion" required>
            <small>(Deja vacío o ingresa 00:00 para indicar sin límite de tiempo)</small>

            <input type="submit" value="Crear Evaluación">
        <?php echo form_close(); ?>
    </div>

    <script>
        let questionCount = 1;

        function addQuestion() {
            questionCount++;
            const questionsContainer = document.getElementById('questions');
            const newQuestion = document.createElement('div');
            newQuestion.classList.add('question');
            newQuestion.innerHTML = `
                <label for="question${questionCount}">Pregunta ${questionCount}:</label>
                <input type="text" id="question${questionCount}" name="questions[]" required>
                <label for="imageQuestion${questionCount}">Imagen de la Pregunta:</label>
                <input type="file" id="imageQuestion${questionCount}" name="imageQuestion[]" accept="image/*" multiple>
                <label for="options${questionCount}">Opciones de Respuesta (separadas por comas):</label>
                <input type="text" id="options${questionCount}" name="options[]" required>
                <label for="correctOptions${questionCount}">Respuesta Correcta:</label>
                <input type="text" id="correctOptions${questionCount}" name="correctOptions[]" required>
                <label for="score${questionCount}">Puntaje de la Pregunta:</label>
                <input type="number" id="score${questionCount}" name="scores[]" required onchange="updateTotalScore()">
                <button type="button" class="deleteButton" onclick="deleteQuestion(this)">Eliminar</button>
            `;
            questionsContainer.appendChild(newQuestion);
            updateTotalScore();
        }

        function deleteQuestion(button) {
            button.parentElement.remove();
            questionCount--;
            updateTotalScore();
        }

        function updateTotalScore() {
            let totalScore = 0;
            for (let i = 1; i <= questionCount; i++) {
                const scoreField = document.getElementById(`score${i}`);
                totalScore += parseInt(scoreField?.value || 0);
            }
            document.getElementById('totalScore').value = totalScore;
        }

        function handleSelection(selected) {
            const curso = document.getElementById('curso');
            const seccion = document.getElementById('seccion');
            const hiddenCursoId = document.getElementById('hiddenCursoId');
            const hiddenSeccionId = document.getElementById('hiddenSeccionId');

            if (selected === 'curso') {
                seccion.disabled = true;
                hiddenCursoId.value = curso.options[curso.selectedIndex].dataset.cursoId;
                hiddenSeccionId.value = '';
            } else {
                curso.disabled = true;
                hiddenSeccionId.value = seccion.value;
                hiddenCursoId.value = seccion.options[seccion.selectedIndex].dataset.cursoId;
            }
        }
    </script>
</body>
</html>
