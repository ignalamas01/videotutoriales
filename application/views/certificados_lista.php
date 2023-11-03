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
                                <img src="<?php echo base_url('uploads/certificados/') . $row->rutaImagen; ?>" class="card-img-top" alt="Certificado">
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
                                    <li class="text-muted text-right"><?php echo $row->fechaEmision; ?></li>
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
                              ?>
                              <img width="300" src="<?php echo base_url('uploads/certificados/') . basename($row->rutaImagen); ?>">
                              <?php
                                }
                              ?>
                        </p>
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
    <!-- End Script -->
</body>

<!-- jQuery -->
<script src="<?php echo base_url(); ?>adminlte/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?php echo base_url(); ?>adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url(); ?>/adminlte/dist/js/adminlte.min.js"></script>

</html>
