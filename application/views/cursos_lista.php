<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Lista de cursos</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>index.php/base/index">Home</a></li>
              <li class="breadcrumb-item active">DataTables</li>
              <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>index.php/usuarios/logout">cerrar sesion</a></li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
           
            <!-- /.card -->

            <div class="card">
              <div class="card-header">
                <h3 class="card-title">cursos</h3>
              </div>
             <!--- <h1><?php
              //date_default_timezone_set('America/la_paz');
              // echo date('y/m/d H:i:s'); ?> hora actualizada   </h1>-->
              
              <div>   
                <a href="<?php echo base_url(); ?>index.php/cursos/agregar"> <button type="button" class="btn btn-danger">AGREGAR CURSOS</button> </a>
                <a href="<?php echo base_url(); ?>index.php/cursos/deshabilitados"> <button type="button" class="btn btn-primary">VER LISTA DE CURSOS DESHABILITADOS</button> </a>
                <a href="<?php echo base_url(); ?>index.php/cursos/subir_video"> <button type="button" class="btn btn-danger">LISTA DE VIDEOS</button> </a>
                <!-- <a href="<?php echo base_url(); ?>index.php/usuarios/logout"> <button type="button" class="btn btn-danger">CERRAR SESION</button> </a> -->
              </div>
              
              <!-- <h3> 
                login:<?php  echo $this ->session->userdata('login');?><br>
                id:   <?php  echo $this ->session->userdata('idusuario');?><br>
                tipo: <?php  echo $this ->session->userdata('tipo');?><br>
              </h3> -->


 <!-- <a href ="<?php echo base_url();?>index.php/base/listapdf" target="_blank"><button type="submit" class="btn btn-success btn-block">lista de empleados en pdf</button>   </a>  -->
 

 
           
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example"  class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <td>no</td>
                      <td>TITULO</td>
                  
                      <td>DESCRIPCION</td>
                      <td>VIDEO</td>
                      <td>FECHA DE REGISTRO</td>
                      
                      <td>MODIFICAR</td>
                      <td>ELIMINAR</td>
                      <td>DESHABILITAR</td>
                      <td>VIDEO</td>
                              
                    </tr>
                  </thead>
                  <tbody>
                 
                    <?php
                      $indice = 1;
                      foreach ($cursos->result() as  $row) 
                      {
                    ?>
                        <tr>
                            <td> <?php echo $indice; ?> </td>
                            <td> <?php echo $row->titulo; ?> </td>
                            <td> <?php echo $row->descripcion; ?> </td>
                            <td> <?php echo $row->video; ?> </td>

                             <td> <?php echo formatearFecha($row->fechaRegistro); ?> </td> 
                           
                          
                           
                            <td>
                              <?php
                                echo form_open_multipart('cursos/modificar')
                              ?>
                                <input type="hidden" name="idcursos" value="<?php echo $row->id; ?> ">
                                <button type="submit" class="btn btn-success">MODIFICAR</button>
                              <?php
                                echo form_close();
                              ?>
                            </td>

                            <td>

                                <?php
                                echo form_open_multipart('cursos/eliminarbd')
                                ?>
                                <input type="hidden" name="idcursos" value="<?php echo $row->id; ?> ">
                                <button type="submit" class="btn btn-danger">ELIMINAR</button>
                                <?php
                                echo form_close();
                                ?>
                            </td>
                            <td>

                                <?php
                                echo form_open_multipart('cursos/deshabilitarbd')
                                ?>
                                <input type="hidden" name="idcursos" value="<?php echo $row->id; ?> ">
                                <button type="submit" class="btn btn-warning">DESHABILITAR</button>
                                <?php
                                echo form_close();
                                ?>
                            </td>

                            
                            <td>
                              <?php
                              $video=$row->video;
                              if($video=="")
                                {
                              ?>
                              <img width="100" src="<?php echo base_url(); ?>uploads/cursos/per.jpg">
                              <?php
                                }
                              else
                                {
                              ?>
                              <img width="100" src="<?php echo base_url(); ?>uploads/cursos/<?php echo $video; ?>">
                              <?php
                                }
                              ?> 
                              
                              
                              <?php
                                echo form_open_multipart('cursos/subirfoto')
                                ?>
                                <input type="hidden" name="idcursos" value="<?php echo $row->id; ?>">
                                <button type="submit" class="btn btn-primary">SUBIR</button>
                                <?php
                                echo form_close();
                              ?>  
                            </td>
                        </tr>

                    <?php
                      $indice++;
                      }
                    ?>
                 
                  </tbody>
                  <tfoot>
                  <tr>
                  <td>no</td>
                  <td>TITULO</td>
                  
                  <td>DESCRIPCION</td>
                  <td>VIDEO</td>

                  <td>FECHA DE REGISTRO</td>
                  <td>MODIFICAR</td>
                  <td>ELIMINAR</td>
                  <td>DESHABILITAR</td>
                  <td>FOTO</td>
                  </tr>
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
