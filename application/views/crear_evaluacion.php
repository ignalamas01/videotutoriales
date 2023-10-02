<!DOCTYPE html>
<html>
<head>
    <title>Crear Evaluación</title>
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

        input[type="text"],
        input[type="date"],
        input[type="number"],
        textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 3px;
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

        /* Estilos para las preguntas */
        .question {
            background-color: #fff;
            padding: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <h1>Crear Evaluación</h1>
<?php echo form_open_multipart('evaluaciones/agregarbd'); ?>
    <form id="evaluationForm">
        <label for="title">Título de la Evaluación:</label>
        <input type="text" id="title" name="title" required><br><br>

        <label for="description">Descripción:</label>
        <textarea id="description" name="description"></textarea><br><br>

        <label for="deadline">Fecha de Vencimiento:</label>
        <input type="date" id="deadline" name="deadline"><br><br>

        <h2>Preguntas de Selección Múltiple</h2>
        <div id="questions">
            <!-- Campo de pregunta, opciones de respuesta y puntaje predeterminado -->
            <div class="question">
                <label for="question1">Pregunta 1:</label>
                <input type="text" id="question1" name="questions[]" required><br><br>

                <label for="options1">Opciones de Respuesta (separadas por comas):</label>
                <input type="text" id="options1" name="options[]" required><br><br>

                <label for="correctOptions1">Respuesta Correcta:</label>
                <input type="text" id="correctOptions1" name="correctOptions[]" required><br><br>

                <label for="score1">Puntaje de la Pregunta:</label>
                <input type="number" id="score1" name="scores[]" required><br><br>
            </div>
        </div>
        <button type="button" onclick="addQuestion()">Agregar Pregunta</button><br><br>

        <input type="submit" value="Crear Evaluación">
    </form>

    <script>
        let questionCount = 1; // Comenzamos con una pregunta predeterminada

        function addQuestion() {
            questionCount++; // Incrementamos el contador de preguntas
            const questionsContainer = document.getElementById('questions');

            // Clonamos el campo de pregunta, opciones de respuesta y puntaje predeterminado
            const clonedQuestion = document.querySelector('.question').cloneNode(true);

            // Borramos los valores existentes en los campos de la nueva pregunta
            clonedQuestion.querySelector('input[id^="question"]').value = '';
            clonedQuestion.querySelector('input[id^="options"]').value = '';
            clonedQuestion.querySelector('input[id^="correctOptions"]').value = '';
            clonedQuestion.querySelector('input[id^="score"]').value = ''; // Limpiamos el campo de puntaje

            // Cambiamos los IDs y etiquetas para que sean únicos
            clonedQuestion.querySelector('label[for^="question"]').textContent = `Pregunta ${questionCount}:`;
            clonedQuestion.querySelector('input[id^="question"]').id = `question${questionCount}`;
            clonedQuestion.querySelector('label[for^="options"]').textContent = `Opciones de Respuesta (separadas por comas):`;
            clonedQuestion.querySelector('input[id^="options"]').id = `options${questionCount}`;
            clonedQuestion.querySelector('label[for^="correctOptions"]').textContent = `Respuesta Correcta (número de opción, ej. 1, 2, 3, ...)`;
            clonedQuestion.querySelector('input[id^="correctOptions"]').id = `correctOptions${questionCount}`;
            clonedQuestion.querySelector('label[for^="score"]').textContent = `Puntaje de la Pregunta:`;
            clonedQuestion.querySelector('input[id^="score"]').id = `score${questionCount}`;

            // Agregamos la pregunta clonada al formulario
            questionsContainer.appendChild(clonedQuestion);
        }
    </script>
</body>
</html>
