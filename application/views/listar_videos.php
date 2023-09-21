<!DOCTYPE html>
<html>
<head>
    <title>Listar y Mostrar Videos</title>
</head>

<!-- <script>
function eliminarVideo(nombreVideo) {
    if (confirm("¿Seguro que deseas eliminar el video '" + nombreVideo + "'?")) {
        window.location.href = 'eliminar_video.php?nombre=' + nombreVideo + '&confirmar=si';
    }
}
</script> -->

<body>
<a href="<?php echo base_url(); ?>index.php/cursos/subir_video">Subir nuevo Video</a>
    <h2>Listar y Mostrar Videos</h2>
    <ul>
   
        <?php
        $video_directory = "uploads/video/";
        $videos = scandir($video_directory);

        foreach ($videos as $video) {
            if ($video !== "." && $video !== "..") {
                //echo '<li><a href="mostrar_video.php?nombre=' . urlencode($video) . '">' . $video . '</a></li>';
                echo '<li><a href="' . base_url('index.php/cursos/mostrar_video') . '?nombre=' . urlencode($video) . '">' . $video . '</a></li>';
               // echo '<source src="' . base_url('index.php/cursos/mostrar_video') . '?nombre=' . urlencode($video) . '" type="video/mp4">';
                //echo '<li><a href="' . base_url('index.php/cursos/mostrar_video/') . urlencode($video) . '">' . $video . '</a></li>';
                //para editar
                //echo '<li><a href="' . base_url('index.php/cursos/editar_video/') . urlencode($video) . '">Renombrar video</a></li>';
                echo '<li><a href="' . base_url('index.php/cursos/editar_video') . '?nombre=' . urlencode($video) . '">Renombrar video</a></li>';
                
                
                // echo '<li><a href="' . base_url() . 'index.php/cursos/mostrar_video.php?nombre=' . urlencode($video) . '">' renombrar video '</a></li>';
                
                
                
                //echo '<li><a href="editar_video.php?nombre=' . urlencode($video) . '">renombrar video</a></li>';
                
                
               // echo ' <a href="eliminar_video.php?nombre=' . urlencode($video) . '" onclick="return confirm(\'¿Seguro que deseas eliminar el video?\')">Eliminar video</a>';
                
                echo '<br>';
                
            }
      
        }
        
        ?>
        
    </ul>
    

</body>
</html>

