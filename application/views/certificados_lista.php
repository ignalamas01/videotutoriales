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
                        <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>index.php/base/index">Home</a></li>
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
                <?php
                foreach ($certificados->result() as $row) {
                ?>
                    <div class="col-12 col-md-4 mb-4">
                        <div class="card h-100">
                            <a href="<?php echo base_url('index.php/vercertificado/ver/' . $row->idCertificado); ?>">
                            <!-- <img src="<?php echo base_url('uploads/certificados/') . $row->rutaImagen; ?>" class="card-img-top" alt="Certificado"> -->
                            </a>
                           
                            <div class="card-body">
                                <ul class="list-unstyled d-flex justify-content-between">
                                    <!-- <li>
                                        <i class="text-warning fa fa-star"></i>
                                        <i class="text-warning fa fa-star"></i>
                                        <i class="text-warning fa fa-star"></i>
                                        <i class="text-warning fa fa-star"></i>
                                        <i class="text-muted fa fa-star"></i>
                                    </li> -->
                                    
                                </ul>
                                <p>
                        <?php
                              $rutaImagen=$row->rutaImagen;
                              if($rutaImagen=="")
                                {
                              ?>
                              <!-- <img width="100" src="<?php echo base_url(); ?>uploads/cursos/per.jpg"> -->
                              <?php
                                }
                              else
                                {
                                    $idCurso = $row->idCurso;
                                $curso = $this->certificados_model->obtener_curso_por_id($idCurso);

                         // Verificar si se obtuvo el curso antes de mostrar el título
                                if ($curso) {
                                // echo 'Curso: ' . $curso->titulo;
                            }
                              ?>
                              <img width="300" src="<?php echo base_url('uploads/certificados/') . basename($row->rutaImagen); ?>">
                              
                              <?php
                                }
                              ?>
                              
                        </p>
                        <li class="text-muted text-left">Emitido el:  <?php echo $row->fechaEmision; ?></li>
                        <li class="text-muted text-left">ID del certificado: <?php echo $row->codificacion; ?></li>
                        <li class="text-muted text-left">Curso:  <?php echo $curso->titulo; ?></li>
                        <!-- <a href="<?php echo base_url('uploads/certificados/'). basename($row->rutaPDF); ?>"class="btn btn-primary" target="_blank" download>Descargar Certificado</a> -->
                        <a href="<?php echo base_url('uploads/certificados/') . basename($row->rutaPDF); ?>" target="_blank" download>Descargar Certificado</a>
                        <button class="btn btn-primary btn-share" data-url="<?php echo base_url('index.php/vercertificado/ver/' . $row->idCertificado); ?>">
        Compartir Logro
    </button>
                        <!-- <a href="<?php echo base_url('index.php/vercertificado/ver/' . $row->idCertificado); ?>" class="h2 text-decoration-none text-dark"><?php echo $row->tituloCurso; ?></a> -->
                                <!-- <p class="card-text"><?php echo $row->descripcionCurso; ?></p> -->
                            </div>
                        </div>
                    </div>
                <?php
                }
                ?>
            </div>
        </div>
    </section>

    <!-- Start Script -->
    <script src="<?php echo base_url(); ?>adminlte/plugins/jquery-1.11.0.min.js"></script>
    <script src="<?php echo base_url(); ?>adminlte/plugins/jquery-migrate-1.2.1.min.js"></script>
    <script src="<?php echo base_url(); ?>adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?php echo base_url(); ?>adminlte/plugins/templatemo.js"></script>
    <script src="<?php echo base_url(); ?>adminlte/plugins/custom.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- End Script -->


</body>
<script>
    $(document).ready(function() {
        $(".btn-share").on("click", function() {
            var certificadoUrl = $(this).data("url");
            // Abrir enlace en Facebook
            window.open("https://www.facebook.com/sharer/sharer.php?u=" + encodeURIComponent(certificadoUrl), "_blank");
        });
    });
</script>
<!-- jQuery -->
<script src="<?php echo base_url(); ?>adminlte/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?php echo base_url(); ?>adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url(); ?>/adminlte/dist/js/adminlte.min.js"></script>

</html>
