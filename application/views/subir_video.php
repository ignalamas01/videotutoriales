<!DOCTYPE html>
<html>
<head>
    <title>Subir Archivo MP4</title>
</head>
<body>
<h2>Subir Video</h2>
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
    <a href="<?php echo base_url(); ?>index.php/cursos/listar_videos">Ver lista de  Videos</a>
    <a href="<?php echo base_url(); ?>index.php/cursos/ver_videos">   Videos</a>
    
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

    <!-- Inserta aquí el reproductor de video -->
    <video width="640" height="360" controls>
        
        <source src="<?php echo base_url(); ?>uploads/video/music2.mp4" type="video/mp4">
        Tu navegador no admite la reproducción de video.
    </video>

    
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
<video width="640" height="360" controls>
    <source src=" " type="video/mp4">
    Tu navegador no admite la reproducción de video.
</video>

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