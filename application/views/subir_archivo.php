<!DOCTYPE html>
<html>
<head>
    <title>Subir Archivo MP4</title>
</head>
<body>
    <h1> subir video a la pagina</h1>


    <!-- <form action="subir_archivo.php" method="POST" enctype="multipart/form-data"> -->
    <form action="<?php echo base_url(); ?>index.php/cursos/subir_archivo" method="POST" enctype="multipart/form-data" >    
        <input type="file" name="archivo" accept=".mp4">
        <!-- <input type="submit" value="Subir Archivo" name="submit"> -->
        <a href="<?php echo base_url(); ?>index.php/cursos/subir_archivo"> <button type="button" class="btn btn-danger">subir archivo</button> </a>
        <!-- <a href="listavideo.php"> <button type="button" class="btn btn-primary">lista videos</button> </a> -->
        <a href="<?php echo base_url(); ?>index.php/cursos/listavideo"> <button type="button" class="btn btn-danger">LISTA DE VIDEOS</button> </a>
    </form>
    <br>
    <!-- <form action="uploads" method="POST" enctype="multipart/form-data"> -->
    <form action="<?php echo base_url(); ?>uploads/video" method="POST" enctype="multipart/form-data"> 
    
        <input type="submit" value="lista de videos" name="submit">
        <br>
       
    </form>
    <br>
    /
    <!-- <h1>Videos Subidos</h1>

<?php
// Directorio donde se almacenan los videos subidos
    $directorioVideos = "uploads/";
 

// Obtener una lista de los archivos en el directorio de videos
$videos = glob($directorioVideos . "*.mp4");

if (!empty($videos)) {
    foreach ($videos as $video) {
        echo '<video width="640" height="360" controls>';
        echo '<source src="' . $video . '" type="video/mp4">';
        echo 'Tu navegador no admite la reproducción de video.';
        echo '</video>';
    }
} else {
    echo 'No se encontraron videos.';
}
?>


   
    <a href="uploads/vid.mp4" target="_blank">Ver Video en Nueva Pestaña</a> <br> 
    
    <?php
   if (isset($_POST['submit'])) {
    $targetDir = "uploads/";
    

    $targetFile = $targetDir . basename($_FILES["archivo"]["name"]);
    $uploadOk = 1;
    $archivoFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    // Verificar si el archivo es realmente un archivo .mp4
    if ($archivoFileType === "mp4") {
        // Mover el archivo al directorio de subidas
        if (move_uploaded_file($_FILES["archivo"]["tmp_name"], $targetFile)) {
            echo "El archivo .mp4 se ha subido correctamente.";
        } else {
            echo "Hubo un error al subir el archivo.";
        }
    } else {
        echo "Por favor, selecciona un archivo .mp4.";
    }
    
}

    ?>


    <h1>Bienvenido a Mi Sitio Web</h1>

 Enlace para abrir el video en otra pestaña -->


 <p>Este es el contenido de mi página de inicio.</p>

    <!-- <video width="640" height="360"  controls>
        <source src="<?php echo base_url(); ?>uploads/video/2.mp4" type="video/mp4" >
        Tu navegador no soporta la reproducción de video.
    </video> -->

    <h1>Bienvenido a Mi Sitio Web</h1>

    <!-- Inserta aquí el reproductor de video -->
    <video width="640" height="360" controls>
        
        <source src="<?php echo base_url(); ?>uploads/video/music2.mp4" type="video/mp4">
        Tu navegador no admite la reproducción de video.
    </video>

    <h1>Bienvenido a Mi Sitio Web sdhfsd</h1>

    <!-- Botón "Ver" para abrir el video -->
    <button onclick="mostrarVideo()">Ver Video</button>

    <!-- Contenedor oculto para el video -->
    <div id="videoContainer" style="display: none;">
        <video width="640" height="360" controls>
            <source src="<?php echo base_url(); ?>uploads/video/2.mp4" type="video/mp4">
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