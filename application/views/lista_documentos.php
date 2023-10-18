<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Documentos</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
<a href="<?php echo base_url(); ?>index.php/cursos/subir_archivos"> <button type="button" class="btn btn-danger">subir otro documento</button> </a>
    <h1>lista de documentos</h1>
    <!-- Mostrar la lista de documentos en un enlace -->
    


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
                 <button class="eliminar-btn" data-nombre="' . $archivo . '">Eliminar</button>
                
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




<!-- <script>
    // Función para eliminar un documento
    function eliminarDocumento(nombreDocumento) {
        if (confirm("¿Estás seguro de que deseas eliminar este documento?")) {
            // Realizar una solicitud AJAX al servidor para eliminar el documento
            const xhr = new XMLHttpRequest();
            xhr.open('POST', 'eliminar_documento.php'); // Ruta al script de eliminación en el servidor
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            
            // Enviar el nombre del documento a eliminar como parámetro
            const parametros = 'nombreDocumento=' + encodeURIComponent(nombreDocumento);
            
            xhr.onload = function () {
                if (xhr.status === 200) {
                    alert(xhr.responseText); // Muestra la respuesta del servidor (puedes personalizarla)
                    location.reload(); // Recarga la página para actualizar la lista
                } else {
                    alert('Error al eliminar el documento.');
                }
            };

            xhr.send(parametros);
        }
    }
</script> -->




    
</body>