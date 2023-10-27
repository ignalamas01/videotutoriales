
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>*</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>index.php/base/index">Home</a></li>
              <li class="breadcrumb-item active">DataTables</li>

            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <div class="row featurette">
    <div class="col-md-7">
        <br>
        <h2 class="featurette-heading">AGREGAR CURSOS<span class="text-muted" > </span></h2>
        
        <div id="alerta" style="display: none;"></div>


    </div>
    <!-- <div class="col-md-5">
        <center><img src="<?php echo base_url(); ?>img/imgvt.png" width="120"></center>

    </div> -->
    


    


    <?php
    /*  lo mismo que multipart  y form
                <form action="<?php echo base_url(); ?>index.php/estudiante/agregarbd" method="POST">
                */ ?>
    <?php
    echo form_open_multipart('cursos/agregarbd')
    ?>
    
    

<input type="hidden" name="idUsuario" value="<?php echo $this->session->userdata('idusuario'); ?>">

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-9">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Datos </h3>
                        </div>
                        <?php
$alerta = $this->session->flashdata('alerta');
if ($alerta) {
    echo '<div class="alert alert-success">' . $alerta . '</div>';
} else {
    echo '<div class="alert alert-danger">No se agregó ningún curso y sección.</div>';
}
?>
                        

                        <!-- /.card-header -->
                        <!-- form start -->
                        <form>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">TITULO</label>
                                    <input type="text" name="titulo" placeholder="escriba el titulo del curso" class="form-control" required><br>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">DESCRIPCION</label>
                                    <input type="text" name="descripcion" placeholder="escriba la descripcion del video" class="form-control" required><br>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">LINK DE PORTADA DE CURSO</label>
                                    <input type="text" name="foto" placeholder="subir" class="form-control"><br>
                                </div>
                                
                                <!-- <div class="row">
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label>DEPARTAMENTO</label>
                                            <select name="departamento" class="form-control select2" style="width: 100%;">
                                              
                                                <option value="Beni">Beni</option>
                                                <option value="Cochabamba">cochabamba</option>
                                                <option value="Chuquisaca">Chuquisaca</option>
                                                <option value="La Paz">La Paz</option>
                                                <option value="Oruro">Oruro</option>
                                                <option value="Potosi">Potosi</option>
                                                <option value="Pando">Pando</option>
                                                <option value="Santa Cruz">Santa Cruz</option>
                                                <option value="Tarija">Tarija</option>
                                            </select>
                                        </div>
                                    </div>

                                </div> -->

                                <!-- <div class="row">
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="municipio">DIRECCION</label>
                                            <input type="text" class="form-control" name="direccion" placeholder="direccion">
                                        </div>
                                    </div>

                                </div> -->





                            </div>
                            
                            <!-- /.card-body -->
                        <!-- ... Código anterior ... -->
                        
<!-- Botón para agregar más secciones -->

<button type="button" class="btn btn-success" id="agregarSeccion">Agregar Sección</button>

<!-- Contenedor para las secciones adicionales -->
<div id="contenedorSecciones"></div>
<!-- Agregar un campo oculto para almacenar el número total de secciones -->
<input type="hidden" name="numeroSecciones" id="numeroSecciones" value="0">
<input type="hidden" name="numeroArchivos" id="numeroArchivos" value="0">
<input type="hidden" name="numeroVideos" id="numeroVideos" value="0">

                        <!-- </form> -->
                    </div>
                    <!-- /.card -->
                    <div class="card-footer">
                        <button type="submit" class="btn btn-success ">Agregar Curso</button>

                        <button type="reset" class="btn btn-success " onClick="history.go(-1);">Cancelar</button>
                    </div>

                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!--/.col (right) -->
        </div>
        <!-- /.row -->

    </section>
</div><!-- /.container-fluid -->

<script>
document.addEventListener("DOMContentLoaded", function () {
    var contadorSecciones = 0;

    function agregarNuevaSeccion() {
        contadorSecciones++;
        // var contadorArchivos = 0;
        // var contadorVideos = 0;
        
        var nuevaSeccionHTML = `
            <div class="seccion" id="seccion_${contadorSecciones}">
                <h4>SECCIÓN ${contadorSecciones}</h4>

                <div class="form-group">
                    <label for="titulo_seccion_${contadorSecciones}">Título de la Sección</label>
                    <input type="text" name="titulo_seccion_${contadorSecciones}" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="descripcion_seccion_${contadorSecciones}">Descripción de la Sección</label>
                    <textarea name="descripcion_seccion_${contadorSecciones}" class="form-control"></textarea>
                </div>

                <!-- Botón para agregar archivos a esta sección -->
                <button type="button" class="btn btn-info agregarArchivo" data-seccion="${contadorSecciones}">Agregar Archivo</button>
                <!-- Botón para eliminar archivos de esta sección -->
                <button type="button" class="btn btn-danger eliminarArchivo" data-seccion="${contadorSecciones}">Eliminar Archivo</button>

                <!-- Contenedor para los archivos de esta sección -->
                <div class="contenedorArchivos" id="archivos_seccion_${contadorSecciones}"></div>

                <!-- Botón para agregar videos a esta sección -->
                <button type="button" class="btn btn-info agregarVideo" data-seccion="${contadorSecciones}">Agregar Video</button>
                <!-- Botón para eliminar videos de esta sección -->
                <button type="button" class="btn btn-danger eliminarVideo" data-seccion="${contadorSecciones}">Eliminar Video</button>

                <!-- Contenedor para los videos de esta sección -->
                <div class="contenedorVideos" id="videos_seccion_${contadorSecciones}"></div>

                <!-- Botón para eliminar esta sección -->
                <button type="button" class="btn btn-danger eliminarSeccion" data-seccion="${contadorSecciones}">Eliminar Sección</button>
            </div>
        `;
        
        document.getElementById("contenedorSecciones").insertAdjacentHTML("beforeend", nuevaSeccionHTML);
        document.getElementById('numeroSecciones').value = contadorSecciones;
        // Asignar eventos a los botones de esta sección
        asignarEventosSeccion(contadorSecciones, 'archivo');
        
    }

    function asignarEventosSeccion(numeroSeccion) {
        // Manejar clic en el botón "Agregar Archivo" para esta sección
        
        // Manejar clic en el botón "Eliminar Archivo" para esta sección
        document.querySelector(`#seccion_${numeroSeccion} .eliminarArchivo`).addEventListener("click", function () {
            eliminarUltimoArchivo(numeroSeccion);
        });

        // Manejar clic en el botón "Agregar Video" para esta sección
       
        // Manejar clic en el botón "Eliminar Video" para esta sección
        document.querySelector(`#seccion_${numeroSeccion} .eliminarVideo`).addEventListener("click", function () {
            eliminarUltimoVideo(numeroSeccion);
        });

        // Manejar clic en el botón "Eliminar Sección" para esta sección
        document.querySelector(`#seccion_${numeroSeccion} .eliminarSeccion`).addEventListener("click", function () {
            eliminarSeccion(numeroSeccion);
        });
        
    }

    function agregarNuevoArchivo(numeroSeccion) {
        
    // Obtener el contador de archivos actual de la sección
    var contadorArchivos = 1;
    var contenedorArchivos = document.getElementById(`archivos_seccion_${numeroSeccion}`);
    var archivosExistentes = contenedorArchivos.querySelectorAll('.form-group').length / 2; // Dividido por 2 porque hay dos campos por archivo

    if (archivosExistentes > 0) {
        // Si ya hay archivos, incrementar el contador al último número utilizado
        contadorArchivos = archivosExistentes + 1;
    }

    var nuevoArchivoHTML = `
        <div class="form-group">
            <label for="titulo_archivo_${numeroSeccion}_${contadorArchivos}">Título del Archivo ${contadorArchivos}</label>
            <input type="text" name="titulo_archivo_${numeroSeccion}_${contadorArchivos}" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="ruta_archivo_${numeroSeccion}_${contadorArchivos}">Ruta del Archivo ${contadorArchivos}</label>
            <input type="text" name="ruta_archivo_${numeroSeccion}_${contadorArchivos}" class="form-control" required>
        </div>
    `;

    contenedorArchivos.insertAdjacentHTML("beforeend", nuevoArchivoHTML);
    document.getElementById('numeroArchivos').value = contadorArchivos;
}

function agregarNuevoVideo(numeroSeccion) {
    // Obtener el contador de videos actual de la sección
    var contadorVideos = 1;
    var contenedorVideos = document.getElementById(`videos_seccion_${numeroSeccion}`);
    var videosExistentes = contenedorVideos.querySelectorAll('.form-group').length / 3; // Dividido por 2 porque hay dos campos por video

    if (videosExistentes > 0) {
        // Si ya hay videos, incrementar el contador al último número utilizado
        contadorVideos = videosExistentes + 1;
    }

    var nuevoVideoHTML = `
        <div class="form-group">
            <label for="titulo_video_${numeroSeccion}_${contadorVideos}">Título del Video ${contadorVideos}</label>
            <input type="text" name="titulo_video_${numeroSeccion}_${contadorVideos}" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="descripcion_video_${numeroSeccion}_${contadorVideos}">Descripcion del Video ${contadorVideos}</label>
            <input type="text" name="descripcion_video_${numeroSeccion}_${contadorVideos}" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="ruta_video_${numeroSeccion}_${contadorVideos}">Ruta del Video ${contadorVideos}</label>
            <input type="text" name="ruta_video_${numeroSeccion}_${contadorVideos}" class="form-control" required>
        </div>
    `;

    contenedorVideos.insertAdjacentHTML("beforeend", nuevoVideoHTML);
    document.getElementById('numeroVideos').value = contadorVideos;
}



    function eliminarUltimoArchivo(numeroSeccion) {
        var contenedorArchivos = document.getElementById(`archivos_seccion_${numeroSeccion}`);
        var ultimoArchivo = contenedorArchivos.lastElementChild;
        if (ultimoArchivo) {
            contenedorArchivos.removeChild(ultimoArchivo);
        }
    }

    

    function eliminarUltimoVideo(numeroSeccion) {
        var contenedorVideos = document.getElementById(`videos_seccion_${numeroSeccion}`);
        var ultimoVideo = contenedorVideos.lastElementChild;
        if (ultimoVideo) {
            contenedorVideos.removeChild(ultimoVideo);
        }
    }

    function eliminarSeccion(numeroSeccion) {
        // Eliminar la sección y sus contenidos
        var seccion = document.getElementById(`seccion_${numeroSeccion}`);
        seccion.parentNode.removeChild(seccion);
        contadorSecciones--;
        // Verificar si se eliminaron todas las secciones
        var secciones = document.getElementsByClassName("seccion");
        if (secciones.length === 0) {
            // Si no hay secciones, reiniciar el contador
            contadorSecciones = 0;
        }
    }

    // Asignar eventos a todos los botones "Agregar Archivo"
    document.getElementById("contenedorSecciones").addEventListener("click", function (event) {
        if (event.target.classList.contains("agregarArchivo")) {
            var numeroSeccion = event.target.getAttribute("data-seccion");
            agregarNuevoArchivo(numeroSeccion);
        } else if (event.target.classList.contains("eliminarArchivo")) {
            var numeroSeccion = event.target.getAttribute("data-seccion");
            eliminarUltimoArchivo(numeroSeccion);
        }
    });

    // Asignar eventos a todos los botones "Agregar Video"
    document.getElementById("contenedorSecciones").addEventListener("click", function (event) {
if (event.target.classList.contains("agregarVideo")) {
var numeroSeccion = event.target.getAttribute("data-seccion");
agregarNuevoVideo(numeroSeccion);
} else if (event.target.classList.contains("eliminarVideo")) {
var numeroSeccion = event.target.getAttribute("data-seccion");
eliminarUltimoVideo(numeroSeccion);
}
});
// Asignar evento a todos los botones "Eliminar Sección"
document.getElementById("contenedorSecciones").addEventListener("click", function (event) {
    if (event.target.classList.contains("eliminarSeccion")) {
        var numeroSeccion = event.target.getAttribute("data-seccion");
        eliminarSeccion(numeroSeccion);
    }
});

document.getElementById("agregarSeccion").addEventListener("click", function () {
    agregarNuevaSeccion();
});

    // Agregar evento para el formulario
    document.querySelector('form').addEventListener('submit', function (e) {
        e.preventDefault(); // Evita que el formulario se envíe automáticamente

        // Aquí puedes realizar la lógica para enviar el formulario y procesar la respuesta
        // Por simplicidad, supongamos que se ha agregado correctamente
        var exito = true; // Cambia esto en función de tu lógica real

        // Muestra la alerta
        var alerta = document.getElementById("alerta");
        if (exito) {
            alerta.textContent = "El curso y la sección se han agregado correctamente.";
            alerta.className = "alert alert-success";
        } else {
            alerta.textContent = "Error al agregar el curso y la sección.";
            alerta.className = "alert alert-danger";
        }
        alerta.style.display = "block";

        
    });
    
        

});



</script>





<?php
echo form_close();
?>


<!--        </form>*/ -->


</div>


</div>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
