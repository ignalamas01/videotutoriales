

<!-- Navbar -->
<link rel="stylesheet" href="<?php echo base_url(); ?>/adminlte/dist/css/stylemenu.css">
<nav class="main-header navbar navbar-expand navbar-white navbar-light" style="background-color: #093562;">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item">
      <div class="container-fluid">
                            <!-- <a class="navbar-brand" href="<?php echo base_url(); ?>index.php/base/index">INICIO</a> -->
                            <!-- <button><li class="breadcrumb-item"><a href="<?php echo base_url(); ?>index.php/base/index">INICIO</a></li></button> -->
                            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="sera buscar?">
                                <span class="navbar-toggler-icon"></span>
                            </button>
                           
                        </div>
      </li>

      <!-- <li class="nav-item d-none d-sm-inline-block">
        <a href="<?php echo base_url(); ?>index.php/base/index" class="nav-link">Home</a>
      </li> -->
      
    
      <div class="collapse navbar-collapse" id="navbarCollapse">
                                <ul class="navbar-nav me-auto mb-2 mb-md-0" >
                                <button class="navbar-btn"><li class="breadcrumb-item"><a href="<?php echo base_url(); ?>index.php/base/index"style="color: white;">INICIO</a></li></button>
                                    <!-- <li class="nav-item">
                                        <a class="nav-link active" aria-current="page" href="<?php echo base_url(); ?>index.php/base/res">RESUMEN</a>
                                    </li> -->
                                    <!-- <li class="nav-item">
                                        <a class="navbar-brand" aria-current="page" href="<?php echo base_url(); ?>index.php/base/obj">ACERCA DE CEPRA</a>
                                    </li> -->

                                    
                                    <button class="navbar-btn" ><li class="breadcrumb-item; c"><a href="<?php echo base_url(); ?>index.php/base/obj"style="color: white;">ACERCA DE CEPRA</a></li></button>
                                    
                                    <!-- <li class="nav-item">
                                        <a class="nav-link active" aria-current="page" href="<?php echo base_url(); ?>index.php/estudiante/est">ESTUDIANTES</a>
                                    </li> -->
                                    <!-- <button><li class="breadcrumb-item "><a href="<?php echo base_url(); ?>index.php/estudiante/est"style="color: white;">ESTUDIANTES</a></li></button> -->

                                    <!-- <li class="nav-item">
                                        <a class="nav-link active" aria-current="page" href="<?php echo base_url(); ?>index.php/base/emple">PROFESORES</a>
                                    </li> -->
                                    <!-- <button><li class="breadcrumb-item"><a href="<?php echo base_url(); ?>index.php/base/emple"style="color: white;">PROFESORES</a></li></button> -->
                                    <!-- <li class="nav-item">
                                        <a class="nav-link active" aria-current="page" href="<?php echo base_url(); ?>index.php/cursos/cursos">CURSOS</a>
                                    </li> -->
                                    <button><li class="breadcrumb-item"><a href="<?php echo base_url(); ?>index.php/cursos/cursos2"style="color: white;">MIS CURSOS</a></li></button>
                                    <!-- <li class="nav-item">
                                        <a class="nav-link active" aria-current="page" href="<?php echo base_url(); ?>index.php/foros/for">foros</a>
                                    </li> -->
                                    <button><li class="breadcrumb-item"><a href="<?php echo base_url(); ?>index.php/suscripciones/lista"style="color: white;">MIS EVALUACIONES</a></li></button>
                                    
                                    <!-- <li class="nav-item">
                                        <a class="nav-link active" aria-current="page" href="<?php echo base_url(); ?>index.php/suscripciones/lista">inscritos</a>
                                    </li> -->
                                    
                                    <button><li class="breadcrumb-item"><a href="<?php echo base_url(); ?>index.php/certificados/certificados_lista"style="color: white;">MIS CERTIFICADOS</a></li></button>
                                    <!-- <button><li class="breadcrumb-item"><a href="<?php echo base_url(); ?>index.php/foros/index">Home</a></li></button> -->
                                    <button><li class="breadcrumb-item"><a href="<?php echo base_url(); ?>index.php/foros/for"style="color: white;">FOROS</a></li></button>

                                </ul>
                                <!-- <form class="d-flex">
                                    <input class="form-control me-2" type="search" placeholder="buscar" aria-label="buscar">
                                    <button class="btn btn-outline-success" type="submit">buscar</button>
                                </form> -->
                            </div>

    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->
      <li class="nav-item">
        <a class="nav-link" data-widget="navbar-search" href="#" role="button">
          <i class="fas fa-search"></i>
        </a>
        <div class="navbar-search-block">
          <form class="form-inline">
            <div class="input-group input-group-sm">
              <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
              <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                  <i class="fas fa-search"></i>
                </button>
                <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
          </form>
        </div>
      </li>

      <!-- Messages Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-comments"></i>
          <span class="badge badge-danger navbar-badge">3</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="../../dist/img/user1-128x128.jpg" alt="User Avatar" class="img-size-50 mr-3 img-circle">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  Brad Diesel
                  <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">Call me whenever you can</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="../../dist/img/user8-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  John Pierce
                  <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">I got your message bro</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="../../dist/img/user3-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  Nora Silvester
                  <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">The subject goes here</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
        </div>
      </li>
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <span class="badge badge-warning navbar-badge">15</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header">15 Notifications</span>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-envelope mr-2"></i> 4 new messages
            <span class="float-right text-muted text-sm">3 mins</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-users mr-2"></i> 8 friend requests
            <span class="float-right text-muted text-sm">12 hours</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-file mr-2"></i> 3 new reports
            <span class="float-right text-muted text-sm">2 days</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
          <i class="fas fa-th-large"></i>
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->