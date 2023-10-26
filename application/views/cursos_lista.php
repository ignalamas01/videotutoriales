
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
                <h3 class="card-title">Cursos</h3>
              </div>
             <!--- <h1><?php
              //date_default_timezone_set('America/la_paz');
              // echo date('y/m/d H:i:s'); ?> hora actualizada   </h1>-->
              
              <div>   
                <a href="<?php echo base_url(); ?>index.php/cursos/agregar"> <button type="button" class="btn btn-danger">Agregar curso</button> </a>
                <a href="<?php echo base_url(); ?>index.php/cursos/deshabilitados"> <button type="button" class="btn btn-primary">Lista de cursos deshabilitados</button> </a>
                <a href="<?php echo base_url(); ?>index.php/cursos/subir_video"> <button type="button" class="btn btn-danger">Videos</button> </a>
                <a href="<?php echo base_url(); ?>index.php/cursos/subir_archivos"> <button type="button" class="btn btn-danger">Archivos</button> </a>
                <a href="<?php echo base_url(); ?>index.php/cursos/crear_evaluacion"><button type="button" class="btn btn-warning">Crear evaluacion</button>  </a>
                <a href="<?php echo base_url(); ?>index.php/cursos/realizar_evaluacion"><button type="button" class="btn btn-warning">Realizar evaluacion</button>  </a>
               
                
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
                <!--comentado no me acuerdo we <?php
                foreach($cursos as $curso){
                  ?>
                    

                  <?php
                }
              ?>   -->


                <thead>
                    <tr>
                      <td>no</td>
                      <td>TITULO</td>
                  
                      <td>DESCRIPCION</td>
                      <td>FOTO</td>
                      <td>FECHA DE REGISTRO</td>
                      
                      <td>MODIFICAR</td>
                      <td>ELIMINAR</td>
                      <td>DESHABILITAR</td>
                      <td>FOTO</td>
                              
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
                            <td> 

                            <?php
                              $foto=$row->foto;
                              if($foto=="")
                                {
                              ?>
                              <img width="100" src="<?php echo base_url(); ?>uploads/cursos/per.jpg">
                              <?php
                                }
                              else
                                {
                              ?>
                              <img width="100" src="<?php echo base_url(); ?>uploads/cursos/<?php echo $foto; ?>">
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

                            </td>
                             <td> <?php echo formatearFecha($row->fechaRegistro); ?> </td> 
                           
                          
                           
                            <td>
                              <?php
                                echo form_open_multipart('cursos/modificar')
                              ?>
                                <input type="hidden" name="idcursos" value="<?php echo $row->id; ?> ">
                                <button type="submit" class="btn btn-success"><i class="fas fa-pencil-alt"></i></button>
                              <?php
                                echo form_close();
                              ?>
                            </td>

                            <td>

                                <?php
                                echo form_open_multipart('cursos/eliminarbd')
                                ?>
                                <input type="hidden" name="idcursos" value="<?php echo $row->id; ?> ">
                                <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i></button>
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
                                echo form_open_multipart('cursos/subir_video')
                                ?>
                                <input type="hidden" name="idcursos" value="<?php echo $row->id; ?>">
                                <button type="submit" class="btn btn-danger">SUBIRvideo</button>
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
                  <td>FOTO</td>

                  <td>FECHA DE REGISTRO</td>
                  <td>MODIFICAR</td>
                  <td>ELIMINAR</td>
                  <td>DESHABILITAR</td>
                  <td>SUBIR VIDEO/FOTO</td>
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
  <div  class="container" >
    <div class="row" >
      
        <?php
        foreach ($cursos->result() as $row) {
        ?>
            <div class="col-12 col-md-4 mb-4">
                <div class="card h-100">
                
                <a href="<?php echo base_url('index.php/vercurso/ver/' . $row->id); ?>">
                        <img src="./assets/img/feature_prod_01.jpg" class="card-img-top" alt="...">
                    </a>
                    <div class="card-body">
                        <ul class="list-unstyled d-flex justify-content-between">
                            <li>
                                <i class="text-warning fa fa-star"></i>
                                <i class="text-warning fa fa-star"></i>
                                <i class="text-warning fa fa-star"></i>
                                <i class="text-warning fa fa-star"></i>
                                <i class="text-muted fa fa-star"></i>
                            </li>
                            <li class="text-muted text-right"></li>
                        </ul>
                        <a href="<?php echo base_url('index.php/vercurso/ver/' . $row->id); ?>" class="h2 text-decoration-none text-dark"><?php echo $row->titulo; ?></a>
                <p class="card-text">
                        <p class="card-text">
                            <?php echo $row->descripcion; ?>
                        </p>
                        <p>
                        <?php
                              $foto=$row->foto;
                              if($foto=="")
                                {
                              ?>
                              <!-- <img width="100" src="<?php echo base_url(); ?>uploads/cursos/per.jpg"> -->
                              <?php
                                }
                              else
                                {
                              ?>
                              <img width="140" src="<?php echo base_url(); ?>uploads/cursos/<?php echo $foto; ?>">
                              <?php
                                }
                              ?>
                        </p>
                        <p class="text-muted">Reviewsss (24)</p>
                    </div>
                </div>
            </div>
        <?php
        }
        ?>
    </div>
</div>






<body style="background-color: #919197 ;" >
    

    <!-- Start Categories of The Month -->
    <section class="container py-5">
        <div class="row text-center pt-3">
            <div class="col-lg-6 m-auto">
                <h1 class="h1">Algunos de nuestros cursos</h1>
                <!-- <p>
                    Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia
                    deserunt mollit anim id est laborum.
                </p> -->
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-md-4 p-5 mt-3">
                <a href="#"><img src="<?php echo base_url(); ?>img/large_IA.jpg" class="rounded-circle img-fluid border"></a>
                <h5 class="text-center mt-3 mb-3">Inteligencia artificial</h5>
                <p class="text-center"><a class="btn btn-success">ir al Curso</a></p>
                
            </div>
            <div class="col-12 col-md-4 p-5 mt-3">
                <a href="#"><img src="<?php echo base_url(); ?>img/diseno-3d.png" class="rounded-circle img-fluid border"></a>
                <h2 class="h5 text-center mt-3 mb-3">Diseño 3DDD</h2>
                <p class="text-center"><a class="btn btn-success">ir al Curso</a></p>
            </div>
            <div class="col-12 col-md-4 p-5 mt-3">
                <a href="#"><img src="<?php echo base_url(); ?>img/programacion_cero.jpeg" class="rounded-circle img-fluid border"></a>
                <h2 class="h5 text-center mt-3 mb-3">Programación</h2>
                <p class="text-center"><a class="btn btn-success">ir al Curso</a></p>
            </div>
        </div>
    </section>
    <section>
      <div class="row">
        <div class="col-4">
            <div class="form-group">
                 <label>CURSOS</label>
                                            
                        <select name="id" class="form-control form-select form-select-lg required" style="width: 100%">
                        <option value="" disabled selected>Seleccione un curso</option>
                        <?php
                          foreach ($cursos->result() as $row) {
                          echo '<option value="' . $row->id . '">' . $row->titulo . '</option>';
                      }
                          ?>
                      </select>
            </div>
        </div>
                                        
      </div>
      
                                    
    </section>
    
    <!-- End Categories of The Month -->


    <!-- Start Script -->
    <script src="<?php echo base_url(); ?>adminlte/plugins/jquery-1.11.0.min.js"></script>
    <script src="<?php echo base_url(); ?>adminlte/plugins/jquery-migrate-1.2.1.min.js"></script>
    <!-- <script src="<?php echo base_url(); ?>adminlte/plugins/bootstrapTEMP.bundle.min.js"></script> -->
    <!-- <script src="assets/js/bootstrap.bundle.min.js"></script> -->
    <script src="<?php echo base_url(); ?>adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?php echo base_url(); ?>adminlte/plugins/templatemo.js"></script>
    <script src="<?php echo base_url(); ?>adminlte/plugins/custom.js"></script>
    <!-- End Script -->
</body>







<!-- jQuery -->
<script src="<?php echo base_url(); ?>adminlte/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?php echo base_url(); ?>adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url(); ?>/adminlte/dist/js/adminlte.min.js"></script>
    

</html>


</div>

    <!-- End Categories of The Month -->


    <!-- Start Featured Product -->
    <!-- <section class="bg-light">
        <div class="container py-5">
            <div class="row text-center py-3">
                <div class="col-lg-6 m-auto">
                    <h1 class="h1">Valoraciones y testimonios</h1>
                    <p>
                    ¡La voz de nuestros estudiantes importa! En esta sección. Vea las calificaciones y reseñas honestas de nuestros alumnos para obtener una idea clara de lo que puedes esperar. Nos enorgullece compartir sus comentarios y estamos comprometidos a brindarte una experiencia educativa excepcional."
                    </p>
                </div>
            </div>
        </div> -->




   
                  

            <!-- <div class="row">
           
                <div class="col-12 col-md-4 mb-4">
                
                    <div class="card h-100">
                        <a href="shop-single.html">
                            <img src="./assets/img/feature_prod_01.jpg" class="card-img-top" alt="...">
                        </a>
                        <div class="card-body">
                            <ul class="list-unstyled d-flex justify-content-between">
                                <li>
                                    <i class="text-warning fa fa-star"></i>
                                    <i class="text-warning fa fa-star"></i>
                                    <i class="text-warning fa fa-star"></i>
                                    <i class="text-warning fa fa-star"></i>
                                    <i class="text-muted fa fa-star"></i>
                                </li>
                                <li class="text-muted text-right"></li>
                            </ul>
                            <a href="shop-single.html" class="h2 text-decoration-none text-dark"><?php echo $row->titulo; ?></a>
                            <p class="card-text">
                                El curso fue satisfactorio, pero falto mas carga horaria - Anonimo
                            </p>
                            <tbody>
<?php
$indice = 1;
foreach ($cursos->result() as  $row) {
?>
    <tr>
        <td> <?php echo $indice; ?> </td>
        <td> <?php echo $row->titulo; ?> </td>
        <td> <?php echo $row->descripcion; ?> </td>
        <td> <?php echo $row->foto; ?> </td>
        <td> <?php echo formatearFecha($row->fechaRegistro); ?> </td> 
        <td>
            <?php echo form_open_multipart('cursos/modificar') ?>
            <input type="hidden" name="idcursos" value="<?php echo $row->id; ?> ">
            <button type="submit" class="btn btn-success"><i class="fas fa-pencil-alt"></i></button>
            <?php echo form_close(); ?>
        </td>
        <td>
            <?php echo form_open_multipart('cursos/eliminarbd') ?>
            <input type="hidden" name="idcursos" value="<?php echo $row->id; ?> ">
            <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i></button>
            <?php echo form_close(); ?>
        </td>
        <td>
            <?php echo form_open_multipart('cursos/deshabilitarbd') ?>
            <input type="hidden" name="idcursos" value="<?php echo $row->id; ?> ">
            <button type="submit" class="btn btn-warning">DESHABILITAR</button>
            <?php echo form_close(); ?>
        </td>
        <td>
            <?php echo form_open_multipart('cursos/subir_video') ?>
            <input type="hidden" name="idcursos" value="<?php echo $row->id; ?>">
            <button type="submit" class="btn btn-primary">SUBIR</button>
            <?php echo form_close(); ?>
        </td>
        <td>
            <?php echo form_open('pagina_de_curso') // Reemplaza 'pagina_de_curso' con la URL real de la página del curso ?>
            <input type="hidden" name="idcursos" value="<?php echo $row->id; ?>">
            <button type="submit" class="btn btn-primary">Ver Curso</button>
            <?php echo form_close(); ?>
        </td>
    </tr>
<?php
$indice++;
}
?>
</tbody>

                            
                            <p class="text-muted">Reviews (24)</p>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-4 mb-4">
                    <div class="card h-100">
                        <a href="shop-single.html">
                            <img src="./assets/img/feature_prod_02.jpg" class="card-img-top" alt="...">
                        </a>
                        <div class="card-body">
                            <ul class="list-unstyled d-flex justify-content-between">
                                <li>
                                    <i class="text-warning fa fa-star"></i>
                                    <i class="text-warning fa fa-star"></i>
                                    <i class="text-warning fa fa-star"></i>
                                    <i class="text-muted fa fa-star"></i>
                                    <i class="text-muted fa fa-star"></i>
                                </li>
                                <li class="text-muted text-right"></li>
                            </ul>
                            <a href="shop-single.html" class="h2 text-decoration-none text-dark">Programación en Python: Desde Principiante hasta Avanzado</a>
                            <p class="card-text">
                                Buen curso pero ya se nota un poco de desactualizacion - Anonimo
                            </p>
                            <p class="text-muted">Reviews (48)</p>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-4 mb-4">
                    <div class="card h-100">
                        <a href="shop-single.html">
                            <img src="./assets/img/feature_prod_03.jpg" class="card-img-top" alt="...">
                        </a>
                        <div class="card-body">
                            <ul class="list-unstyled d-flex justify-content-between">
                                <li>
                                    <i class="text-warning fa fa-star"></i>
                                    <i class="text-warning fa fa-star"></i>
                                    <i class="text-warning fa fa-star"></i>
                                    <i class="text-warning fa fa-star"></i>
                                    <i class="text-warning fa fa-star"></i>
                                </li>
                                <li class="text-muted text-right"></li>
                            </ul>
                            <a href="shop-single.html" class="h2 text-decoration-none text-dark">Diseño de Experiencia de Usuario (UX) para Aplicaciones Móviles</a>
                            <p class="card-text">
                                Excelente curso - Anonimo
                            </p>
                            <p class="text-muted">Reviews (74)</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> -->
    
    <!-- End Featured Product -->


    

    <!-- Start Script -->
    <script src="<?php echo base_url(); ?>adminlte/plugins/jquery-1.11.0.min.js"></script>
    <script src="<?php echo base_url(); ?>adminlte/plugins/jquery-migrate-1.2.1.min.js"></script>
    <!-- <script src="<?php echo base_url(); ?>adminlte/plugins/bootstrapTEMP.bundle.min.js"></script> -->
    <!-- <script src="assets/js/bootstrap.bundle.min.js"></script> -->
    <script src="<?php echo base_url(); ?>adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?php echo base_url(); ?>adminlte/plugins/templatemo.js"></script>
    <script src="<?php echo base_url(); ?>adminlte/plugins/custom.js"></script>
    <!-- End Script -->
</body>







<!-- jQuery -->
<script src="<?php echo base_url(); ?>adminlte/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?php echo base_url(); ?>adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url(); ?>/adminlte/dist/js/adminlte.min.js"></script>
    

</html>


</div>
</div>






