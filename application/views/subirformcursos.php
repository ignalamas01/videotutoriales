
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
              <li class="breadcrumb-item"><a href="#">Home</a></li>
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
        <h2 class="featurette-heading">SUBIR FOTO<span class="text-muted"> ****</span></h2>


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
    echo form_open_multipart('cursos/subir')
    ?>



    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-9">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Adjunte foto de portada</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form>
                            <div class="card-body">
                                <div class="form-group">
                                    <input type="hidden" name="idCursos" value="<?php echo $id; ?>">
                                    
                                </div>
                                
                                <div class="form-group">
                                    
                                    <input type="file" name="userfile" class="form-control">
                                </div>

         

                            </div>
                            <!-- /.card-body -->


                        </form>
                        
                    </div>
                    <!-- /.card -->
                    <div class="card-footer">
                        <button type="submit" class="btn btn-success ">Subir</button>

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