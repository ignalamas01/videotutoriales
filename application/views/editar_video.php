<!DOCTYPE html>
<html>
<head>
    <title>Editar Video</title>
</head>
<body>
<a href="<?php echo base_url(); ?>index.php/cursos/listar_videos">Volver a la lista de videos</a>
    <h2>Editar Video</h2>
    <?php
    
    if (isset($_GET["nombre"])) {
        $video_directory = "uploads/video/";
        $nombre_video = $_GET["nombre"];
        $video_path = $video_directory . $nombre_video;

        if (file_exists($video_path)) {
            // Muestra el video
            echo '<video width="640" height="360" controls>';
            //echo '<source src="' . $video_path . '" type="video/mp4">';
            echo '<source src="' . base_url('uploads/video/' . $nombre_video) . '" type="video/mp4">';
            echo 'Tu navegador no soporta la reproducción de video.';
            echo '</video>';

            // Formulario para cambiar el nombre del video
            echo '<form action="editar_video.php?nombre=' . urlencode($nombre_video) . '" method="POST">';
            
            
            echo '<label>Nuevo nombre del video:</label>';
            echo '<input type="text" name="nuevo_nombre" required>';
            echo '<input type="submit" value="Cambiar Nombre">';
            echo '</form>';
        } else {
            echo 'El video no existe.';
        }
    } else {
        echo 'Nombre de video no proporcionado.';
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_GET["nombre"]) && isset($_POST["nuevo_nombre"])) {
        $nombre_anterior = $_GET["nombre"];
        $nuevo_nombre = $_POST["nuevo_nombre"];

        // Agregar la extensión .mp4 al nuevo nombre si no la tiene
        if (!preg_match('/\.mp4$/', $nuevo_nombre)) {
            $nuevo_nombre .= '.mp4';
        }

        $video_anterior_path = $video_directory . $nombre_anterior;
        $video_nuevo_path = $video_directory . $nuevo_nombre;

        if (file_exists($video_anterior_path) && !file_exists($video_nuevo_path)) {
            if (rename($video_anterior_path, $video_nuevo_path)) {
                echo "El video se ha renombrado correctamente.";
                header("Location: listar_videos.php");
                exit;
            } else {
                echo "Hubo un error al renombrar el video.";
            }
        } else {
            echo "El nuevo nombre ya existe o el video original no se encontró.";
        }
    }
    ?>
    <br>
    
</body>
</html>
