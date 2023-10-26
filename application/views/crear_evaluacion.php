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
        <label for="startDate">Fecha de Habilitacion:</label>
<input type="date" id="startDate" name="startDate"><br><br>
        <label for="deadline">Fecha de Vencimiento:</label>
        <input type="date" id="deadline" name="deadline"><br><br>
       <!-- Nueva casilla de selección para cursos -->
       
<!-- Nueva casilla de selección para cursos -->
<label for="curso">Curso en general:</label>
<select id="curso" name="curso" onchange="handleSelection('curso')">
    <option value="">Seleccionar Curso</option> <!-- Opción en blanco -->
    <?php foreach ($cursos as $curso) : ?>
        <option value="<?php echo $curso->id; ?>" data-curso-id="<?php echo $curso->id; ?>"><?php echo $curso->titulo; ?></option>
    <?php endforeach; ?>
</select><br><br>

<!-- Nueva casilla de selección para secciones -->
<label for="seccion">Curso y sección en específico:</label>
<select id="seccion" name="seccion" onchange="handleSelection('seccion')">
    <option value="">Seleccionar Sección</option> <!-- Opción en blanco -->
    <?php foreach ($secciones as $seccion) : ?>
        <option value="<?php echo $seccion->idSeccion; ?>" data-curso-id="<?php echo $seccion->idCurso; ?>">
            <?php echo $seccion->nombre; ?> - <?php echo $seccion->tituloCurso; ?>
        </option>
    <?php endforeach; ?>
   
</select><br><br>
<input type="hidden" id="hiddenCursoId" name="hiddenCursoId" value="">
<!-- Campo oculto para el ID de la sección -->
<input type="hidden" id="hiddenSeccionId" name="hiddenSeccionId" value="">
        <h2>Preguntas de Selección Múltiple</h2>
        <div id="questions">
            <!-- Campo de pregunta, opciones de respuesta y puntaje predeterminado -->
            <div class="question">
                <label for="question1">Pregunta 1:</label>
                <input type="text" id="question1" name="questions[]" required><br><br>
                <label for="imageQuestion${questionCount}">Imagen de la Pregunta:</label>
<input type="file" id="imageQuestion1" name="imageQuestion[]" accept="image/*" multiple><br><br>



                <label for="options1">Opciones de Respuesta (separadas por comas):</label>
                <input type="text" id="options1" name="options[]" required><br><br>

                <label for="correctOptions1">Respuesta Correcta:</label>
                <input type="text" id="correctOptions1" name="correctOptions[]" required><br><br>

                <label for="score1">Puntaje de la Pregunta:</label>
                <input type="number" id="score1" name="scores[]" required><br><br>
            </div>
        </div>
        <button type="button" onclick="addQuestion()">Agregar Pregunta</button><br><br>
<!-- Campo para mostrar el puntaje total -->
<label for="totalScore">Puntaje Total:</label>
        <input type="text" id="totalScore" name="totalScore" readonly value="0"><br><br>

        <input type="submit" value="Crear Evaluación">
    </form>
   
    <script>
    let questionCount = 1; // Comenzamos con una pregunta predeterminada

    function addQuestion() {
        questionCount++; // Incrementamos el contador de preguntas
        const questionsContainer = document.getElementById('questions');

        // Creamos un nuevo campo de pregunta
        const newQuestion = document.createElement('div');
        newQuestion.classList.add('question');

        // Creamos los elementos del nuevo campo
        newQuestion.innerHTML = `
            <label for="question${questionCount}">Pregunta ${questionCount}:</label>
            <input type="text" id="question${questionCount}" name="questions[]" required><br><br>
            <label for="imageQuestion${questionCount}">Imagen de la Pregunta:</label>
            <input type="file" id="imageQuestion${questionCount}" name="imageQuestion[]" accept="image/*" multiple><br><br>
            <label for="options${questionCount}">Opciones de Respuesta (separadas por comas):</label>
            <input type="text" id="options${questionCount}" name="options[]" required><br><br>
            <label for="correctOptions${questionCount}">Respuesta Correcta (número de opción, ej. 1, 2, 3, ...):</label>
            <input type="text" id="correctOptions${questionCount}" name="correctOptions[]" required><br><br>
            <label for="score${questionCount}">Puntaje de la Pregunta:</label>
            <input type="number" id="score${questionCount}" name="scores[]" required onchange="updateTotalScore()"><br><br>
            <button type="button" class="deleteButton" onclick="deleteQuestion(this)">Eliminar</button>
        `;

        // Agregamos la pregunta al formulario
        questionsContainer.appendChild(newQuestion);

        // Actualizamos el evento de cambio en el nuevo campo de puntaje
        updateTotalScore();
    }
    function deleteQuestion(button) {
    const questionContainer = button.parentElement;
    questionContainer.remove();

    updateQuestionNumbers();
    updateTotalScore();
}

function updateQuestionNumbers() {
    const questionsContainer = document.getElementById('questions');
    const questionElements = questionsContainer.getElementsByClassName('question');

    Array.from(questionElements).forEach((question, i) => {
        // Actualizamos la etiqueta de la pregunta
        const label = question.querySelector('label');
        label.textContent = `Pregunta ${i + 1}:`;

        // Actualizamos los IDs de los campos
        question.querySelectorAll('input').forEach(input => {
            const oldId = input.id;
            const newId = oldId.replace(/\d+$/, i + 1);
            input.id = newId;
        });
    });
    questionCount = questionElements.length; // Actualizamos la variable global questionCount
}

    function updateTotalScore() {
        let totalScore = 0;

        // Recorremos todos los campos de puntaje y sumamos los valores
        for (let i = 1; i <= questionCount; i++) {
            const scoreField = document.getElementById(`score${i}`);
            totalScore += parseInt(scoreField.value) || 0;
        }

        // Actualizamos el valor del campo totalScore
        document.getElementById('totalScore').value = totalScore;
    }

    // Asignamos un evento de cambio a cada campo de puntaje inicial
    for (let i = 1; i <= questionCount; i++) {
        const scoreField = document.getElementById(`score${i}`);
        scoreField.addEventListener('change', updateTotalScore);
        
        const fileInput = document.getElementById(`imageQuestion${i}`);
    fileInput.addEventListener('change', updateTotalScore);
    }
    function handleSelection(selected) {
    // Habilitar ambas casillas
    document.getElementById('curso').disabled = false;
    document.getElementById('seccion').disabled = false;

    // Obtener el elemento seleccionado
    const selectedElement = document.getElementById(selected);

    // Desactivar la otra casilla según la selección
    if (selected === 'curso') {
        document.getElementById('seccion').disabled = true;

        // Obtener el valor del campo oculto para el ID del curso
        const cursoId = selectedElement.options[selectedElement.selectedIndex].dataset.cursoId;

        console.log('Curso ID seleccionado:', cursoId);

        // Establecer el valor del campo oculto para el ID del curso
        document.getElementById('hiddenCursoId').value = cursoId;
    } else {
        document.getElementById('curso').disabled = true;

        // Obtener el valor del campo oculto para el ID de la sección y el ID del curso
        const seccionId = selectedElement.value;
        const cursoId = selectedElement.options[selectedElement.selectedIndex].dataset.cursoId;

        console.log('Curso ID seleccionado en la sección:', cursoId);
        console.log('Sección ID seleccionado:', seccionId);

        // Establecer el valor del campo oculto para el ID de la sección y el ID del curso
        document.getElementById('hiddenSeccionId').value = seccionId;
        document.getElementById('hiddenCursoId').value = cursoId;
    }
}

</script>

    
</body>
</html>
