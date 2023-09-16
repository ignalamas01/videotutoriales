<!DOCTYPE html>
<html>
<head>
    <title>Mostrar Video</title>
</head>
<script>
function eliminarVideo(nombreVideo) {
    if (confirm("¿Seguro que deseas eliminar el video '" + nombreVideo + "'?")) {
        window.location.href = 'eliminar_video.php?nombre=' + nombreVideo + '&confirmar=si';
    }
}
</script>
<body>
<a href="<?php echo base_url(); ?>index.php/cursos/listar_videos">Volver a la lista de videos</a>
    <h2>Mostrar Video</h2>
    
    <?php
    if (isset($_GET["nombre"])) {
        $video_directory = "uploads/video/";
        $nombre_video = $_GET["nombre"];
        $video_path = $video_directory . $nombre_video;

        if (file_exists($video_path)) {
            echo '<video width="640" height="480" controls>';
            echo '<source src="' . $video_path . '" type="video/mp4">';
           // echo '<source src="' . $video_path . '" type="video/mp4">'; para agregar otro formato
            
            echo 'Tu navegador no soporta la reproducción de video.';
            
            echo '</video>';
            
        } else {
            echo 'El video no existe.';
        }
    } else {
        echo 'Nombre de video no proporcionado.';
    }
    ?>
    <?php
if (isset($_GET["nombre"])) {
    $video_directory = "uploads/video/";
    $nombre_video = $_GET["nombre"];
    $video_path = $video_directory . $nombre_video;

    if (file_exists($video_path)) {
        // Agregar una condición aquí (por ejemplo, requerir una confirmación)
        if (isset($_GET["confirmar"]) && $_GET["confirmar"] === "si") {
            if (unlink($video_path)) {
                echo "El video se ha eliminado correctamente.";
            } else {
                echo "Hubo un error al eliminar el video.";
            }
        } else {
            // Si la condición no se cumple, mostrar un enlace de confirmación con ventana emergente
            //echo "¿Seguro que deseas eliminar este video?";
            echo '<br>';
            echo '<a href="#" onclick="eliminarVideo(\'' . urlencode($nombre_video) . '\')"> ELIMINAR VIDEO</a>';
            echo '<br>';
            echo '<a href="ver_videos.php">ver todos los videos</a>';
        }
    } else {
        echo "El video no existe.";
    }
} else {
    echo "Nombre de video no proporcionado.";
}
?>
      
</body>
</html>
