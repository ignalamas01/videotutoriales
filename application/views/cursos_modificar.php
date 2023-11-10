<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>index.php/base/index">Home</a></li>
                        <!-- <li class="breadcrumb-item active">DataTables</li> -->
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <div class="row featurette">
        <div class="col-md-7">
            <br>
            <h2 class="featurette-heading">MODIFICAR CURSOS<span class="text-muted"></span></h2><br>
        </div>
        <div class="col-md-5">
            <!-- <center><img src="<?php echo base_url(); ?>img/imgvt.png" width="120"></center> -->
        </div>

        <?php
        foreach ($infocursos->result() as $row) {
            echo form_open_multipart('cursos/modificarbd')
        ?>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <!-- left column -->
                    <div class="col-md-9">
                        <!-- general form elements -->
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Datos de los cursos</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form>
                                <div class="card-body">
                                    <div class="form-group">
                                        <input type="hidden" name="idcursos" class="form-control" value="<?php echo $row->id; ?>">
                                        <label for="exampleInputEmail1">TITULO</label>
                                        <input type="text" name="titulo" placeholder="escriba su nombre" class="form-control" value="<?php echo $row->titulo; ?>"><br>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">DESCRIPCION</label>
                                        <input type="text" name="descripcion" placeholder="escriba la descripcion" class="form-control" value="<?php echo $row->descripcion; ?>"><br>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">FOTO</label>
                                        <input type="text" name="foto" placeholder="escriba su segundo apellido" class="form-control" value="<?php echo $row->foto; ?>"><br>
                                    </div>

                                   <!-- Secciones -->
<?php foreach ($infosecciones as $seccion) : ?>
    <?php if ($seccion->idCurso == $row->id) : ?>
    <div class="card card-info">
        <div class="card-header">
            <h3 class="card-title">Datos de la Sección</h3>
        </div>
        <div class="card-body">
            <input type="hidden" name="idSeccion[]" class="form-control" value="<?php echo $seccion->idSeccion; ?>">
            <label for="exampleInputPassword1">Nombre de la Sección</label>
            <input type="text" name="nombre_seccion[]" class="form-control" value="<?php echo $seccion->nombre; ?>"><br>

            <!-- Videos -->
            <?php foreach ($seccion->videos as $video) : ?>
                <?php if ($video->idSeccion == $seccion->idSeccion) : ?>
                    <div class="card card-warning">
                        <div class="card-header">
                            <h3 class="card-title">Datos del Video</h3>
                        </div>
                        <div class="card-body">
                            <input type="hidden" name="idVideo[]" class="form-control" value="<?php echo $video->idVideo; ?>">
                            <label for="exampleInputPassword1">Título del Video</label>
                            <input type="text" name="titulo_video[]" class="form-control" value="<?php echo $video->tituloVideo; ?>"><br>
                            <label for="exampleInputPassword1">Descripción del Video</label>
                            <input type="text" name="descripcion_video[]" class="form-control" value="<?php echo $video->descripcionVideo; ?>"><br>
                            <label for="exampleInputPassword1">Enlace del Video</label>
                            <input type="text" name="enlace_video[]" class="form-control" value="<?php echo $video->enlaceVideo; ?>"><br>
                            <!-- Agrega otros campos de video según sea necesario -->
                        </div>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>

            <!-- Archivos -->
            <?php foreach ($seccion->archivos as $archivo) : ?>
                <?php if ($archivo->idSeccion == $seccion->idSeccion) : ?>
                    <div class="card card-danger">
                        <div class="card-header">
                            <h3 class="card-title">Datos del Archivo</h3>
                        </div>
                        <div class="card-body">
                            <input type="hidden" name="idArchivo[]" class="form-control" value="<?php echo $archivo->idArchivo; ?>">
                            <label for="exampleInputPassword1">Nombre del Archivo</label>
                            <input type="text" name="nombre_archivo[]" class="form-control" value="<?php echo $archivo->nombreArchivo; ?>"><br>
                            <label for="exampleInputPassword1">Ruta del Archivo</label>
                            <input type="text" name="ruta_archivo[]" class="form-control" value="<?php echo $archivo->rutaArchivo; ?>"><br>
                            <!-- Agrega otros campos de archivo según sea necesario -->
                        </div>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>

        </div>
    </div>
    <?php endif; ?>
<?php endforeach; ?>
                                </div>
                            </form>
                        </div>
                        <!-- /.card -->
                        <div class="card-footer">
                            <button type="submit" class="btn btn-success">Modificar</button>
                            <button type="reset" class="btn btn-primary" onClick="history.go(-1);">Cancelar</button>
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
    <?php
        echo form_close();
    }
    ?>
    <!--        </form>*/ -->
</div>
</div>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->
