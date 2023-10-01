
<h2>Subir Videos</h2>
<div>   
    <a href="<?php echo base_url(); ?>index.php/cursos/cursos"> <button type="button" class="btn btn-danger"><--VOLVER A CURSOS</button> </a>
    <a href="<?php echo base_url(); ?>index.php/cursos/listar_videos"><button type="button" class="btn btn-danger">ver lista de videos</button></a>
    <a href="<?php echo base_url(); ?>index.php/cursos/ver_videos"><button type="button" class="btn btn-warning">videos</button>  </a>
    <a href="<?php echo base_url(); ?>index.php/cursos/crear_evaluacion"><button type="button" class="btn btn-warning">crear evaluacion</button>  </a>
    <br>           
                
     <!-- <a href="<?php echo base_url(); ?>index.php/usuarios/logout"> <button type="button" class="btn btn-danger">CERRAR SESION</button> </a> -->
</div>
---------------------------------------------------------
 <br> 

<head>
    <title>Subir Video</title>
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
    
    <form id="formularioSubida" action="<?php echo base_url(); ?>index.php/cursos/subir_video" method="POST" enctype="multipart/form-data">
        
        <input type="file" name="video" accept="video/*" required>
        <input type="submit" value="Subir Video">
    </form>
    
    <br>
    
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
        echo "Solo se permiten archivos MP4";
    }
}
?>
<br>
<!-- <div class="card-footer">
    

   <button type="reset" class="btn btn-success " onClick="history.go(-1);">Cancelar</button>
</div> -->
<br>

    <h1>Bienvenido a Mi Sitio Web</h1>
<ul >
    <!-- Inserta aquí el reproductor de video -->
    <video width="640" height="360" controls>
        
        <source src="<?php echo base_url(); ?>uploads/video/music2.mp4" type="video/mp4">
        Tu navegador no admite la reproducción de video.
    </video>
</ul>
    

    
    <button onclick="mostrarVideo()">Ver Video</button>

    <!-- Contenedor oculto para el video -->
    <div id="videoContainer" style="display: none;">
        <video width="640" height="360" controls>
             <source src="<?php echo base_url(); ?>uploads/video/2.mp4" type="video/mp4"> 
            Tu navegador no admite la reproducción de video.
            
        </video>
        
        
    </div>
    
    
<div>   
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
                //echo '<source src="' . $video_url . '" type="video/x-ms-wmv">';
                echo '<source src="' . $video_url . '" type="video/wmv">';

            

                echo 'Tu navegador no soporta la reproducción de video.';
                echo '</video>';
                echo '<br>';
                //echo "<a href='eliminar_video.php?nombre=" . urlencode($video) . "'>Eliminar</a>";
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
    
    
  
    <script>
        document.getElementById('formularioSubida').addEventListener('submit', function (event) {
            var inputFile = document.querySelector('input[type="file"]');
            if (inputFile && inputFile.files.length > 0) {
                var fileSize = inputFile.files[0].size; // Tamaño en bytes
                var maxSize = 41943040; // 40 MB en bytes

                if (fileSize > maxSize) {
                    alert("El archivo seleccionado es demasiado grande. El tamaño máximo permitido es de 40 MB.");
                    event.preventDefault(); // Detiene el envío del formulario
                }
            }
        });
    </script>


</body>
</html>