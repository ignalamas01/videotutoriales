<h2>Listar Videos</h2>
<br>
    <a href="<?php echo base_url(); ?>index.php/cursos/listar_videos">Volver a la lista de videos</a>
    <ul>
        <?php
        $video_directory = "uploads/video/";

        // Escanea la carpeta de videos
        $videos = scandir($video_directory);

        foreach ($videos as $video) {
            if ($video !== "." && $video !== "..") {
                $video_url = base_url() . $video_directory . $video;
                echo "<li>";
                echo '<video width="320" height="240" controls>';
               
                echo '<source src="' . $video_url . '" type="video/mp4">';

                 //echo '<source src="' . $video_directory . $video . '" type="video/mp4">'; RUTA ANTIGUA
                 //RUTA CORRECTA
                // if ($video !== "." && $video !== "..") {
                //     $video_url = base_url() . $video_directory . $video;
                //     echo '<source src="' . $video_url . '" type="video/mp4">';
                // }
               

                echo 'Tu navegador no soporta la reproducción de video.';
                echo '</video>';
                echo '<br>';
                echo "<a href='eliminar_video.php?nombre=" . urlencode($video) . "'>Eliminar</a>";
                echo "</li>";
            }
        }
        ?>
        
    </ul>