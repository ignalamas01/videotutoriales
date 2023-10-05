<a href="<?php echo base_url(); ?>index.php/cursos/listar_videos"><button type="button" class="btn btn-danger">ver lista de videos</button></a>

<br>

<?php
if (isset($_GET["nombre"])) {
    $video_directory = "uploads/video/";
    $nombre_video = $_GET["nombre"];
    $video_path = $video_directory . $nombre_video;

    if (file_exists($video_path)) {
        if (unlink($video_path)) {
            // Eliminación exitosa
            echo "El video se ha eliminado correctamente.";
        } else {
            // Error al eliminar
            echo "Hubo un error al eliminar el video.";
        }
    } else {
        // El video no existe
        echo 'El video no existe.';
    }
} else {
    // Nombre de video no proporcionado
    echo 'Nombre de video no proporcionado.';
}
?>
