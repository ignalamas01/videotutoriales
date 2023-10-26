<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles del Curso</title>
</head>
<body>
    <?php if ($curso) : ?>
        <h1><?php echo $curso->titulo; ?></h1>
        <p><?php echo $curso->descripcion; ?></p>
        <!-- Otros detalles del curso -->

        <!-- Puedes agregar más secciones, archivos, videos, etc. aquí -->

    <?php else : ?>
        <p>Curso no encontrado.</p>
    <?php endif; ?>
</body>
</html>