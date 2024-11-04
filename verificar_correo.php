<?php
// Incluir conexión a la base de datos
include('conexion.php'); // Asegúrate de que este archivo tenga la conexión a la base de datos

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];

    // Consulta para verificar si el correo ya existe
    $stmt = $conn->prepare("SELECT COUNT(*) FROM usuarios WHERE email = ?"); // Cambia 'usuarios' al nombre de tu tabla
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $stmt->bind_result($count);
    $stmt->fetch();
    $stmt->close();

    // Retorna 'exists' si el correo ya está en uso, de lo contrario 'available'
    echo $count > 0 ? 'exists' : 'available';
}
?>
