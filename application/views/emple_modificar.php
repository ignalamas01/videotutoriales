<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <!-- <h1>*</h1> -->
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
        <h2 class="featurette-heading"> MODIFICAR <span class="text-muted"> </span></h2><br>


    </div>
    <div class="col-md-5">
        <!-- <center><img src="<?php echo base_url(); ?>img/imgvt.png" width="120"></center> -->

    </div>

    <!--<div col-md-12> -->

    <?php
    foreach ($infoempleado->result() as  $row) {
        echo form_open_multipart('base/modificarbd')
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
                                        <input type="hidden" name="idempleado" class="form-control" value="<?php echo $row->id; ?>">
                                        <label for="exampleInputEmail1">Nombres</label>
                                        <input type="text" name="nombre" placeholder="escriba su nombre" class="form-control" value="<?php echo $row->nombre; ?>"><br>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Primer Apellido</label>
                                        <input type="text" name="primerApellido" placeholder="escriba su primer apellido" class="form-control" value="<?php echo $row->primerApellido; ?>"><br>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Segundo Apellido</label>
                                        <input type="text" name="segundoApellido" placeholder="Escriba su segundo apellido" class="form-control" value="<?php echo $row->segundoApellido; ?>"><br>
                                    </div>
                                    <div class="form-group">
     <label for="seudonimo">TÍTULO</label>
     <select name="seudonimo" class="form-control select2" style="width: 20%;" value="<?php echo $row->seudonimo; ?>">>
        <!-- <option value="" disabled selected>Seleccione...</option> -->
        <option value="Mr.">Mr.</option>
        <option value="Ing.">Ing.</option>
        <option value="Lic.">Lic.</option>
        <option value="Dr.">Dr.</option>
        <option value="Ms.">Ms.</option>
        <option value="Sr.">Sr.</option>
        <option value="Sra.">Sra.</option>
        <option value="Srta.">Srta.</option> <!-- Opción añadida para Señorita -->
        <option value="Prof.">Prof.</option>
    </select>
</div>
<div class="form-group">
                                        <label for="exampleInputPassword1">Correo</label>
                                        <input type="text" name="correo" placeholder="escriba su segundo apellido" class="form-control" value="<?php echo $row->email; ?>"><br>
                                    </div>
                                    <div class="row">
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label> Departamento</label>
                                                <select name="departamento" class="form-control select2" style="width: 100%;" value="<?php echo $row->departamento; ?>">
                                                   
                                                    <option value="Beni">Beni</option>
                                                    <option value="Beni">cochabamba</option>
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
                                                <label>Fecha Nacimiento:</label>
                                                <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                                    <input type="date" name="fechaNac" class="form-control datetimepicker-input" data-target="#reservationdate" placeholder="AAAA-MM-DD" value="<?php echo $row->fechaNacimiento; ?>">
                                                    <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">contacto</label>
                                                <input type="text" class="form-control" name="telefono" placeholder="numero de celular" value="<?php echo $row->telefono; ?>">
                                            </div>

                                        </div>
                                        <input type="hidden" name="idUsuario" value="<?php echo $row->idUsuario; ?>">


                                    </div>

                                    <div class="row">
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label for="municipio">direccion</label>
                                                <input type="text" class="form-control" name="direccion" placeholder="direccion" value="<?php echo $row->direccion; ?>">
                                            </div>
                                        </div>

                                    </div>





                                </div>
                                <!-- /.card-body -->
                                <div class="form-group">
    <label for="firma">Subir Firma</label>
    <input type="file" class="form-control-file" name="firma" accept=".jpg, .jpeg, .png">

    <?php if (!empty($row->firma)): ?>
        <?php
            // Si en la base de datos ya está almacenada la ruta completa, 
            // entonces reemplaza la parte "C:/xampp/htdocs/videotutoriales/" con base_url().
            // Si solo almacenas la parte relativa, entonces base_url() es suficiente.
            $firmaUrl = str_replace("C:/xampp/htdocs/videotutoriales/", base_url(), $row->firma);
        ?>
        <p>Firma actual: <img src="<?php echo $firmaUrl; ?>" alt="Firma" style="width:100px;"></p>
    <?php endif; ?>
</div>



                            </form>
                        </div>
                        <!-- /.card -->
                        <div class="card-footer">
                            <button type="submit" class="btn btn-success ">Modificar</button>

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