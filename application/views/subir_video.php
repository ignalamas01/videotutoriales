
<h2>Subir Videos</h2>
<div>   
    <a href="<?php echo base_url(); ?>index.php/cursos/cursos"> <button type="button" class="btn btn-danger">VOLVER A CURSOS</button> </a>
                
                
     <!-- <a href="<?php echo base_url(); ?>index.php/usuarios/logout"> <button type="button" class="btn btn-danger">CERRAR SESION</button> </a> -->
</div>
---------------------------------------------------------
 <br> 
 <!DOCTYPE html>
<html>
<head>
    <title>Subir Video</title>
</head>
<body>
    
    <form action="<?php echo base_url(); ?>index.php/cursos/subir_video" method="POST" enctype="multipart/form-data">
        
        <input type="file" name="video" accept="video/*" required>
        <input type="submit" value="Subir Video">
    </form>
    <br>
    <a href="<?php echo base_url(); ?>index.php/cursos/listar_videos"><button type="button" class="btn btn-danger">ver lista de videos</button></a>
    <a href="<?php echo base_url(); ?>index.php/cursos/ver_videos"><button type="button" class="btn btn-warning">videos</button>  </a>
    
<?php
$video_directory = "uploads/video/";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["video"])) {
    $video_file = $video_directory . basename($_FILES["video"]["name"]);

    $allowed_extensions = array("mp4");
    $file_extension = strtolower(pathinfo($video_file, PATHINFO_EXTENSION));

    if (in_array($file_extension, $allowed_extensions)) {
        if (move_uploaded_file($_FILES["video"]["tmp_name"], $video_file)) {
            echo "El video se ha subido correctamente.";
        } else {
            echo "Hubo un error al subir el video.";
        }
    } else {
        echo "Solo se permiten archivos MP4.";
    }
}
?>


   

</body>
</html>




<br>
<br>
---------------------------------------------------------------
<br>
   
    


    

    <h1>Bienvenido a Mi Sitio Web</h1>
<ul>
    <!-- Inserta aquí el reproductor de video -->
    <video width="640" height="360" controls>
        
        <source src="<?php echo base_url(); ?>uploads/video/music2.mp4" type="video/mp4">
        Tu navegador no admite la reproducción de video.
    </video>
</ul>
    
<!-- falta editar y eliminar  -->
    
     <button onclick="mostrarVideo()">Ver Video</button>

    <!-- Contenedor oculto para el video -->
    <div id="videoContainer" style="display: none;">
        <video width="640" height="360" controls>
            <source src="<?php echo base_url(); ?>uploads/video/2.mp4" type="video/mp4">
            Tu navegador no admite la reproducción de video.
        </video>
        
    </div>
    
    
<div>
<div>   
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

            

                echo 'Tu navegador no soporta la reproducción de video.';
                echo '</video>';
                echo '<br>';
                echo "<a href='eliminar_video.php?nombre=" . urlencode($video) . "'>Eliminar</a>";
                echo "</li>";
            }
        }
    ?>
        
    </ul>
</div>

</div>
    <p>Este es el contenido de mi página de inicio.</p>

    <script>
        function mostrarVideo() {
            var videoContainer = document.getElementById("videoContainer");
            videoContainer.style.display = "block";
        }
    </script>


</body>
</html>