<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Carga de Documentos</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
<a href="<?php echo base_url(); ?>index.php/cursos/cursos"> <button type="button" class="btn btn-danger">volver a cursos</button> </a>
<a href="<?php echo base_url(); ?>index.php/cursos/listadoc"> <button type="button" class="btn btn-danger">lista de documentos subidos</button> </a>
    <h1>Formulario de Carga de Documentos</h1>

    <!-- Formulario para cargar documentos -->
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
        <label for="documento">Selecciona un documento:</label>
        <input type="file" name="documento" accept=".pdf, .docx, .xlsx" required>
        <button type="submit">Cargar Documento</button>
    </form>
    

    <!-- Enlace para ver el documento cargado -->
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_FILES["documento"])) {
            $nombreArchivo = $_FILES["documento"]["name"];
            $rutaArchivo = "documentos/" . $nombreArchivo; // Directorio donde se almacenarán los documentos

            if (move_uploaded_file($_FILES["documento"]["tmp_name"], $rutaArchivo)) {
                echo "El documento se ha cargado correctamente.";

                echo '<a href="' . $rutaArchivo . '" target="_blank">Ver Documento</a>';
                
            } else {
                echo "Hubo un error al cargar el documento.";
            }
        }
    }
    ?>



    <!-- Mostrar la lista de documentos en un enlace -->
   <!-- ... (código anterior) ... -->

<!-- Mostrar la lista de documentos en un enlace con botón de eliminación -->


<ul>
    <?php
    $directorioDocumentos = "documentos/"; // Directorio donde se almacenan los documentos
    $archivos = scandir($directorioDocumentos); // Obtener la lista de archivos en el directorio

    foreach ($archivos as $archivo) {
        // Filtrar archivos y excluir "." y ".."
        if ($archivo != "." && $archivo != "..") {
            $urlDocumento = base_url() . 'documentos/' . $archivo;
            echo '<li>
                <a href="' . $urlDocumento . '" target="_blank">
                    <img src="' . base_url() . 'img/pdflogo.png" width="30" alt="PDF">' . $archivo . '
                </a>
                 
            </li>';
        }
    }
    ?>
</ul>

<script>
    // Función para eliminar un documento
    $(document).ready(function() {
        $(".eliminar-btn").click(function() {
            var nombreDocumento = $(this).data("nombre");
            if (confirm("¿Estás seguro de que deseas eliminar el documento '" + nombreDocumento + "'?")) {
                // Realizar la eliminación del documento aquí
                alert('El documento "' + nombreDocumento + '" ha sido eliminado.');

                // Puedes agregar código para eliminar el documento del servidor aquí

                // Actualizar la lista de documentos eliminando el elemento
                $(this).closest('li').remove();
            }
        });
    });
</script>


<!-- ... (código posterior) ... -->


    

</body>
</html>
