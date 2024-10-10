<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verificación de Certificado</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f0f0f0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            background-color: white;
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            width: 400px;
            text-align: center;
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
    </style>
</head>
<body>

<div class="container">
    <h2>Verificación de Certificado</h2>
    <p>Ingrese el código del certificado para verificar su validez.</p>

    <form id="verifyForm" method="post" action="<?php echo site_url('certificados/verificar_codigo'); ?>">
        <label for="codigo">Código del Certificado:</label>
        <input type="text" id="codigo" name="codigo" placeholder="Ingrese el código" required>

        <button type="submit">Verificar Certificado</button>
    </form>

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
