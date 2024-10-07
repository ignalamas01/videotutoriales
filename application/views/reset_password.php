<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restablecer Contraseña</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f9f9f9;
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

        h2 {
            color: #00BFA6;
            margin-bottom: 20px;
        }

        p {
            color: #666;
            font-size: 14px;
            margin-bottom: 30px;
        }

        input[type="email"] {
            width: 100%;
            padding: 12px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        button {
            background-color: #00BFA6;
            border: none;
            color: white;
            padding: 12px 20px;
            font-size: 16px;
            border-radius: 5px;
            margin: 5px;
            cursor: pointer;
            width: 45%;
        }

        button:hover {
            background-color: #009d87;
        }

        .cancel {
            background-color: #f55c57;
        }

        .cancel:hover {
            background-color: #c44845;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>¿Ha olvidado su contraseña?</h2>
    <p>Usted va a recibir un mensaje de correo electrónico con instrucciones para restablecer su contraseña.</p>

    <!-- Actualizar la ruta del formulario -->
    <?php
  echo form_open_multipart('usuarios/process_reset', array('id'=>'form1', 'class'=>'needs-validation', 'method'=>'post'));
?>  
        <label for="email">Dirección de correo electrónico *</label>
        <input type="email" id="email" name="email" placeholder="Correo electrónico" required>

        <div>
            <button type="submit">ENVIAR</button>
            <button type="button" class="cancel" onclick="window.location.href='http://localhost/videotutoriales/index.php/usuarios/index/3'">ANULAR</button>
        </div>
        <?php 
echo form_close();
?>
</div>

</body>
</html>
