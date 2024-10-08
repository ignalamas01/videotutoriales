<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restablecer Contraseña</title>
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
        input[type="email"], input[type="password"] {
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
            cursor: pointer;
        }
        button:hover {
            background-color: #009d87;
        }
        #message {
            margin-top: 20px;
            color: red; /* Para mensajes de error */
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Restablecer Contraseña</h2>
    <p>Por favor, ingrese su correo electrónico y la nueva contraseña para restablecerla.</p>
    <input type="hidden" id="token" name="token" value="<?php echo $token; ?>">
    
    <form id="resetPasswordForm" method="post">
        <label for="email">Correo Electrónico:</label>
        <input type="email" id="email" name="email" placeholder="Ingrese su correo" required>

        <label for="password">Nueva Contraseña:</label>
        <input type="password" id="password" name="password" placeholder="Nueva contraseña" required>

        <label for="confirmPassword">Confirmar Contraseña:</label>
        <input type="password" id="confirmPassword" name="confirm_password" placeholder="Confirmar contraseña" required>
        
        <button type="submit">Restablecer Contraseña</button>
        <button type="button" onclick="redirectToHome()">Ir a Inicio</button> <!-- Nuevo botón para redirección -->
    </form>

    <!-- Aquí aparecerán los mensajes de éxito o error -->
    <div id="message" style="color: red; margin-top: 10px;"></div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
   $(document).ready(function() {
    $('#resetPasswordForm').on('submit', function(event) {
        event.preventDefault(); // Prevenir que el formulario se envíe de manera predeterminada

        var email = $('#email').val();
        var password = $('#password').val();
        var confirmPassword = $('#confirmPassword').val();
        var token = $('#token').val(); // Obtiene el token

        // Verificar que los campos no estén vacíos
        if (!email || !password || !confirmPassword) {
            $('#message').html("Por favor, complete todos los campos.").fadeIn();
            return;
        }

        // Verificar que las contraseñas coincidan
        if (password !== confirmPassword) {
            $('#message').html("Las contraseñas no coinciden").fadeIn();
            return;
        }

        // Si los campos están correctos, enviar la solicitud AJAX
        $.ajax({
            url: "<?php echo site_url('usuarios/update_password'); ?>", 
            type: "POST",
            data: { email: email, password: password, confirm_password: confirmPassword, token: token },
            success: function(response) {
                $('#message').html(response).fadeIn(); 
            },
            error: function() {
                $('#message').html("Ocurrió un error.").fadeIn();
            }
        });
    });
});

// Función para redirigir al inicio
function redirectToHome() {
    window.location.href = "<?php echo site_url('usuarios/index'); ?>"; // Cambia esta ruta según sea necesario
}
</script>
</body>
</html>
