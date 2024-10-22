<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verificación de Certificado</title>
    
    <!-- Fuente Poppins de Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
        }

        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 20px;
            background-color: #007bff;
        }

        .navbar a {
            text-decoration: none;
            padding: 8px 16px;
            color: #cccccc; /* Gris claro inicial */
            transition: color 0.3s ease;
            font-size: 18px;
            font-family: 'Poppins', sans-serif;
            font-weight: 400;
        }

        .navbar a:hover {
            color: #ffffff; /* Color blanco al pasar el ratón */
        }

        .container {
            background-color: white;
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            width: 400px;
            text-align: center;
            margin: 100px auto; /* Asegura que esté centrado en la página */
        }

        input[type="text"] {
            width: 100%;
            padding: 12px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        button {
            background-color: #28a745;
            border: none;
            color: white;
            padding: 12px 20px;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #218838;
        }

        #message {
            margin-top: 20px;
            font-size: 16px;
        }

        .back-button {
            margin-top: 20px;
            background-color: #dc3545;
            border: none;
            color: white;
            padding: 12px 20px;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
            display: inline-block;
        }

        .back-button:hover {
            background-color: #c82333;
        }
    </style>
</head>
<body>

<!-- Barra de navegación similar a la página principal -->
<nav class="navbar">
    <div class="nav-item">
        <a href="#">CEPRA</a>
    </div>
    <div class="nav-item">
        <a href="#">Verificación</a>
    </div>
    <div class="nav-item">
        <a href="#">Iniciar sesión</a>
    </div>
</nav>

<div class="container">
    <h2>Verificación de Certificado</h2>
    <p>Ingrese el código del certificado para verificar su validez.</p>

    <form id="verifyForm" method="post" action="<?php echo site_url('certificados/verificar_codigo'); ?>">
        <label for="codigo">Código del Certificado:</label>
        <input type="text" id="codigo" name="codigo" placeholder="Ingrese el código" required>

        <button type="submit">Verificar Certificado</button>
    </form>

    <!-- Botón para regresar -->
    <a href="http://localhost/videotutoriales/index.php" class="back-button">Regresar</a>

    <!-- Mensaje de respuesta -->
    <div id="message">
        <?php if (isset($certificado)): ?>
            Certificado verificado.<br>
            Nombre: <?php echo $certificado->nombre . ' ' . $certificado->primerApellido . ' ' . $certificado->segundoApellido; ?><br>
            Curso: <?php echo $certificado->titulo; ?><br>
            Fecha de emisión: <?php echo $certificado->fechaEmision; ?>
        <?php elseif (isset($error)): ?>
            Certificado no encontrado.
        <?php endif; ?>
    </div>
</div>

</body>
</html>
