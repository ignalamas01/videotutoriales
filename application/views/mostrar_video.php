<!DOCTYPE html>
<html>
<head>
    <title>Mostrar Video</title>
    <a href="<?php echo base_url(); ?>index.php/cursos/listar_videos">Volver a la lista de videos</a>
    <a href="<?php echo base_url(); ?>index.php/cursos/ver_videos">ver todos los videos</a>
    <h2>Mostrar Video</h2>
</head>

<script>
function eliminarVideo(nombreVideo) {
    if (confirm("¿Seguro que deseas eliminar el video '" + nombreVideo + "'?")) {
        window.location.href = '<?php echo base_url("index.php/cursos/eliminar_video"); ?>?nombre=' + nombreVideo;
    }
}
</script>
<body>

<?php
if (isset($_GET["nombre"])) {
    $video_directory = "uploads/video/";
    $nombre_video = $_GET["nombre"];
    $video_path = $video_directory . $nombre_video;

    if (file_exists($video_path)) {
        echo '<video width="640" height="480" controls>';
        echo '<source src="' . base_url('uploads/video/' . $nombre_video) . '" type="video/mp4">';
        echo 'Tu navegador no soporta la reproducción de video.';
        echo '</video>';
        
        // Mostrar el enlace para eliminar el video este tambien elimina
        echo '<br>';
       // echo '<a href="#" onclick="eliminarVideo(\'' . urlencode($nombre_video) . '\')">ELIMINAR VIDEO</a>';
        
        echo '<br>';
        
        // Procesar la eliminación del video si se confirma
        // Agregar una condición aquí (por ejemplo, requerir una confirmación)
        if (isset($_GET["confirmar"]) && $_GET["confirmar"] === "si") {
            if (unlink($video_path)) {
                echo "El video se ha eliminado correctamente.";
                // Después de eliminar el video, redirige a la lista de videos
                echo '<script>window.location.href = "listar_videos.php";</script>';
            } else {
                echo "Hubo un error al eliminar el video.";
            }
        } else {
            // Si la condición no se cumple, mostrar un enlace de confirmación con ventana emergente
            //echo '<br>';
            echo '<a href="#" onclick="eliminarVideo(\'' . urlencode($nombre_video) . '\')">ELIMINAR VIDEO</a>';
            echo '<br>';
           
        }
    } else {
        echo 'El video no existe.';
    }
} else {
    echo 'Nombre de video no proporcionado.';
}
?>

</body>
</html>
