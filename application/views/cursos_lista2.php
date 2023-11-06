

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <!-- <h1>Lista de cursos</h1> -->
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <!-- <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>index.php/base/index">Home</a></li>
              <li class="breadcrumb-item active">DataTables</li> -->
              <!-- <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>index.php/cursos/agregar">agregar curso</a></li>
              <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>index.php/cursos/deshabilitados">deshabilitados</a></li>
              <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>index.php/suscripciones/agregarEstudiante">inscribir a un curso</a></li> -->
              <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>index.php/estudiante/invitado">Inicio</a></li>
              <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>index.php/usuarios/logout">Cerrar sesión</a></li>
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
                <h3 class="card-title">CURSOS</h3>
              </div>
             <!--- <h1><?php
              //date_default_timezone_set('America/la_paz');
              // echo date('y/m/d H:i:s'); ?> hora actualizada   </h1>-->
              
              
              
              <!-- <h3> 
                login:<?php  echo $this ->session->userdata('login');?><br>
                id:   <?php  echo $this ->session->userdata('idusuario');?><br>
                tipo: <?php  echo $this ->session->userdata('tipo');?><br>
              </h3> -->


 <!-- <a href ="<?php echo base_url();?>index.php/base/listapdf" target="_blank"><button type="submit" class="btn btn-success btn-block">lista de empleados en pdf</button>   </a>  -->
 

 
           
              <!-- /.card-header -->
              <div class="card-body">

  <!-- /.content -->
  <div  class="container" >
    <div class="row" >
      
        <?php
        foreach ($cursos->result() as $row) {
            $progreso = $this->certificados_model->actualizar_progreso($row->id);
        
        ?>
            <div class="col-12 col-md-4 mb-4">
                <div class="card h-100">
                
                <a href="<?php echo base_url('index.php/vercurso/ver/' . $row->id); ?>">
                        <img src="./assets/img/feature_prod_01.jpg" class="card-img-top" alt="">
                    </a>
                    <div class="card-body">
                        <ul class="list-unstyled d-flex justify-content-between">
                            <li>
                                <!-- <i class="text-warning fa fa-star"></i>
                                <i class="text-warning fa fa-star"></i>
                                <i class="text-warning fa fa-star"></i>
                                <i class="text-warning fa fa-star"></i>
                                <i class="text-muted fa fa-star"></i> -->
                            </li>
                            <li class="text-muted text-center">
                        <!-- Mostrar el porcentaje de completado -->
                        <span>Avance : <?php echo $progreso; ?>%</span>
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
                        <!-- <p class="text-muted">Reviewsss (24)</p> -->
                       
                    </div>
                </div>
            </div>
        <?php
        }
        ?>
    </div>
</div>







    </section>
    <!-- <section>
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
      
                                    
    </section> -->
    
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






