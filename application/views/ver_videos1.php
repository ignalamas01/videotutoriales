<!DOCTYPE html>
<html>
<head>
    <title>Listado de Videos</title>
    <style>
        /* Estilo para la cuadrícula de videos */
        .video-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
            gap: 20px;
            list-style: none;
            padding: 0;
        }

        .video-item {
            text-align: center;
        }

        .video-item video {
            width: 100%;
            height: auto;
        }

        .video-item a {
            display: block;
            margin-top: 10px;
        }
    </style>
      <style>
        body {
            background-color: #CCC; /* Aquí puedes especificar el color que desees utilizando el código hexadecimal, nombre de color o RGB */
        }
    </style>
</head>
<body>
<h2>Ver Videos</h2>
<br>

<a href="<?php echo base_url(); ?>index.php/base/invitado"> <button type="button" class="btn btn-danger">volver</button> </a>
    <ul class="video-grid">
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
               // echo '<source src="' . $video_url . '" type="video/wmv">';
               // echo '<source src="' . $video_url . '" type="video/x-ms-wmv">';
            
               

                echo 'Tu navegador no soporta la reproducción de video.';
                echo '</video>';
                echo '<br>';
                //echo "<a href='eliminar_video.php?nombre=" . urlencode($video) . "'>Eliminar</a>";
                
                echo "</li>";
            }
        }
        ?>
        
    </ul>