<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
    en esta pagina se mostarran todos los videos
    
    <table id="example1" class="table table-bordered table-striped">
                <thead>
                 <tr>
                      <td>no</td>
                      <td>video </td>                     
                      <td>video 2</td>                
                      <td>video3</td>
                              
                    </tr>
                    <tr>
                    <td>no</td>
                    <td> 
                        <video width="440" height="200"  controls>
                            <source src="<?php echo base_url(); ?>uploads/video/music2.mp4" type="video/mp4" >
                            Tu navegador no soporta la reproducción de video.
                        </video> </td>
                    <td> 
                        <video width="440" height="200"  controls>
                            <source src="<?php echo base_url(); ?>uploads/video/2.mp4" type="video/mp4" >
                            Tu navegador no soporta la reproducción de video.
                        </video>
                    </td>
                    <td> 
                        <video width="440" height="200"  controls>
                            
                            <source src="<?php echo base_url(); ?>uploads/video/Camilo  Despeinada2.mp4" type="video/mp4" >
                            Tu navegador no soporta la reproducción de video.
                          
                        </video>
                    </td>

                    

                </tr>
                </thead>

    </table>
   
    <h1>Redireccionar a otro Enlace</h1>

<p>Haz clic en el botón para ver video:</p>

<form method="post" target="_blank" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <input type="submit" name="redireccionar" value="Ir al Enlace">
</form>

<?php
if (isset($_POST['redireccionar'])) {
    // URL de la página a la que quieres redirigir al usuario
    $url = "https://www.youtube.com/watch?v=uAYG46w1SCA&ab_channel=dojacatVEVO";

    // Realizar la redirección utilizando la función header()
    header("Location: $url");
    exit; // Asegúrate de que el script se detenga después de redirigir
}
?> 
<h1>-------------------------------------Videos Subidos lista</h1>

<?php
// Directorio donde se almacenan los videos subidos
$directorioVideos = "uploads/";

// Obtener una lista de los archivos en el directorio de videos
$videos = glob($directorioVideos . "*.mp4");

if (!empty($videos)) {
    foreach ($videos as $video) {
        echo '<video width="640" height="360" controls >';
        echo '<source src="' . $video . '" type="video/mp4">';
        echo 'Tu navegador no admite la reproducción de video.';
        echo '</video>';
    }
} else {
    echo 'No se encontraron videos.';
}
?>


</body>
</html>