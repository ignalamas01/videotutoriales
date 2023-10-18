<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["nombreDocumento"])) {
        $nombreDocumento = $_POST["nombreDocumento"];
        $directorioDocumentos = "documentos/"; // Directorio donde se almacenan los documentos

        // Verifica que el nombre del documento sea seguro para evitar posibles ataques
        if (is_file($directorioDocumentos . $nombreDocumento)) {
            // Intenta eliminar el documento
            if (unlink($directorioDocumentos . $nombreDocumento)) {
                echo "El documento se ha eliminado correctamente.";
                // Puedes personalizar la respuesta si es necesario
            } else {
                echo "Hubo un error al eliminar el documento.";
            }
        } else {
            echo "El documento no existe.";
        }
    } else {
        echo "Nombre de documento no proporcionado.";
    }
} else {
    echo "Solicitud no válida.";
}
?>
