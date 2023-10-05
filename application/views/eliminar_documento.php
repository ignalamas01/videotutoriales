<?php
if (isset($_POST['nombreDocumento'])) {
    $nombreDocumento = $_POST['nombreDocumento'];
    $directorioDocumentos = "documentos/";

    // Verificar si el archivo existe antes de eliminarlo
    if (file_exists($directorioDocumentos . $nombreDocumento)) {
        // Intentar eliminar el archivo
        if (unlink($directorioDocumentos . $nombreDocumento)) {
            echo 'El documento "' . $nombreDocumento . '" ha sido eliminado correctamente.';
        } else {
            echo 'Error al eliminar el documento "' . $nombreDocumento . '".';
        }
    } else {
        echo 'El documento "' . $nombreDocumento . '" no existe.';
    }
} else {
    echo 'No se proporcionó un nombre de documento para eliminar.';
}
?>

