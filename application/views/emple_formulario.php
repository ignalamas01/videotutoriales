
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
        <h2 class="featurette-heading">AGREGAR EMPLEADO<span class="text-muted"> ****</span></h2>


    </div>
    <div class="col-md-5">
        <center><img src="<?php echo base_url(); ?>img/imgvt.png" width="120"></center>

    </div>

    <!--<div col-md-12> -->



    <?php
    /*  lo mismo que multipart  y form
                <form action="<?php echo base_url(); ?>index.php/estudiante/agregarbd" method="POST">
                */ ?>
    <?php
    echo form_open_multipart('base/agregarbd')
    ?>



    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-9">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Datos Generales</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">NOMBRES</label>
                                    <input type="text" name="nombre" placeholder="escriba su nombre" class="form-control" required><br>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">PRIMER APELLIDO</label>
                                    <input type="text" name="primerApellido" placeholder="escriba su primer apellido" class="form-control" required><br>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">SEGUNDO APELLIDO</label>
                                    <input type="text" name="segundoApellido" placeholder="escriba su segundo apellido" class="form-control"><br>
                                </div>
                                <label for="newEmail">Correo Electrónico</label>
    <input type="email" id="destinatario" name="destinatario" placeholder="Escriba su correo electrónico" class="form-control" required>
</div>
<div class="form group">
                <label class="form-label" for="asunto">Asunto del correo</label>
                <input type="text" class="form-control" name="asunto" id="asunto" placeholder="El asunto del correo electrónico">
              </div>
              <div class="form group">
                <label class="form-label" for="contenido">Mensaje</label>
                <input type="text" class="form-control" name="contenido" id="contenido" placeholder="Escribe aquí...">
              </div>

                                <div class="row">
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

                                    <!--FALTA CARGAR CALENDARIO-->
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label>FECHA DE NACIMIENTO:</label>
                                            <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                                <input type="date" name="fechaNac" class="form-control datetimepicker-input" data-target="#reservationdate" placeholder="AAAA-MM-DD" />
                                                <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">CONTACTO</label>
                                            <input type="text" class="form-control" name="telefono" placeholder="numero de celular">
                                        </div>

                                    </div>


                                </div>

                                <div class="row">
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="municipio">DIRECCION</label>
                                            <input type="text" class="form-control" name="direccion" placeholder="direccion">
                                        </div>
                                    </div>

                                </div>





                            </div>
                            <!-- /.card-body -->


                        </form>
                    </div>
                    <!-- /.card -->
                    <div class="card-footer">
                        <button type="submit" class="btn btn-success ">agregar</button>

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


<?php
echo form_close();
?>



<!--        </form>*/ -->


</div>


</div>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->