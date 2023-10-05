<!DOCTYPE html>
<html lang="en">

<head >
    <title>Zay Shop eCommerce HTML CSS Template</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="assets/img/apple-icon.png">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">

    <link rel="stylesheet" href="adminlte/dist/css/temp/bootstrap.min.css">
    <link rel="stylesheet" href="adminlte/dist/css/temp/templatemo.css">
    <link rel="stylesheet" href="adminlte/dist/css/temp/custom.css">

    <!-- Load fonts style after rendering the layout styles -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;200;300;400;500;700;900&display=swap">
    <link rel="stylesheet" href="adminlte/dist/css/temp/fontawesome.min.css">
    <!--
    
    TemplateMo 559 Zay Shop

    https://templatemo.com/tm-559-zay-shop

    -->
</head>

<body style="background-color: #919197 ;" >
    <!-- Start Top Nav -->
    <nav class="navbar navbar-expand-lg bg-dark navbar-light d-none d-lg-block" id="templatemo_nav_top">
        <div class="container text-light">
            <div class="w-100 d-flex justify-content-between">
                <div>
                    <i class="fa fa-envelope mx-2"></i>
                    <a class="navbar-sm-brand text-light text-decoration-none" href="mailto:info@cepra.com">info@cepra.com</a>
                    <i class="fa fa-phone mx-2"></i>
                    <a class="navbar-sm-brand text-light text-decoration-none" href="tel:79988432">79988432</a>
                </div>
                <div>
                    <a class="text-light" href="https://www.facebook.com/CentrodePreparacionAcademica.CepraCbba" target="_blank" rel="sponsored"><i class="fab fa-facebook-f fa-sm fa-fw me-2"></i></a>
                    <a class="text-light" href="https://www.instagram.com/" target="_blank"><i class="fab fa-instagram fa-sm fa-fw me-2"></i></a>
                    <a class="text-light" href="https://twitter.com/" target="_blank"><i class="fab fa-twitter fa-sm fa-fw me-2"></i></a>
                    <a class="text-light" href="https://www.linkedin.com/" target="_blank"><i class="fab fa-linkedin fa-sm fa-fw"></i></a>
                </div>
            </div>
        </div>
    </nav>
    <!-- Close Top Nav -->


    <!-- Header -->
    <nav class="navbar navbar-expand-lg navbar-light shadow" style="background-color: #093562 ;" >
    <div class="container d-flex justify-content-between align-items-center"  >
    <a href="<?php echo base_url(); ?>index.php/system/index" class="navbar-brand" style="color: red;">
    <img  src="<?php echo base_url(); ?>/adminlte/dist/img/logo_cepra.jpeg" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8; width: 65px; display: inline-block; vertical-align: middle; margin-left: 10px;">
        <a class="navbar-brand" href="<?php echo base_url(); ?>index.php/system/index" style="color: skyblue;">CEPRA</a>
    </a>
    <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#templatemo_main_nav" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>



            <div class="align-self-center collapse navbar-collapse flex-fill  d-lg-flex justify-content-lg-between" id="templatemo_main_nav" >
                <div class="flex-fill">
                   
                <ul class="nav navbar-nav d-flex justify-content-between mx-lg-auto">
                        <li class="nav-item" >
                            <a class="breadcrumb-item" href="<?php echo base_url(); ?>index.php/base/index">/Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="breadcrumb-item" href="about.html">estadistica</a>
                        </li>
                        <li class="nav-item">
                            <a class="breadcrumb-item" href="<?php echo base_url(); ?>index.php/usuarios/logout">Registrarse</a>
                        </li>
                        <li class="nav-item">
                            <a class="breadcrumb-item" href="<?php echo base_url(); ?>index.php/usuarios/logout">Iniciar sesión</a>
                        </li>
                        
        <!-- <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>index.php/base/index">Home</a></li>
        <li class="breadcrumb-item active">DataTables</li>
        <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>index.php/usuarios/logout">Registrate</a></li>
        <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>index.php/usuarios/logout">Iniciar sesion</a></li>
        <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>index.php/registro/registrar">Registrate</a></li> -->
                    </ul>
                </div>
                <div class="navbar align-self-center d-flex" >
                    <div class="d-lg-none flex-sm-fill mt-3 mb-4 col-7 col-sm-auto pr-3" >
                        <div class="input-group"  >
                            <input type="text" class="form-control" id="inputMobileSearch" placeholder="Search ..." >
                            <div class="input-group-text" >
                                <i class="fa fa-fw fa-search"></i>
                            </div>
                        </div>
                    </div>
                    <a class="nav-icon d-none d-lg-inline" href="#" data-bs-toggle="modal" data-bs-target="#templatemo_search">
                        <i class="fa fa-fw fa-search text-dark mr-2"></i>
                    </a>
                    <a class="nav-icon position-relative text-decoration-none" href="#">
                        <i class="fa fa-fw fa-cart-arrow-down text-dark mr-1"></i>
                        <span class="position-absolute top-0 left-100 translate-middle badge rounded-pill bg-light text-dark">7</span>
                    </a>
                    <a class="nav-icon position-relative text-decoration-none" href="#">
                        <i class="fa fa-fw fa-user text-dark mr-3"></i>
                        <span class="position-absolute top-0 left-100 translate-middle badge rounded-pill bg-light text-dark">+99</span>
                    </a>
                </div>
            </div>

        </div>
    </nav>
    <!-- Close Header -->

    <!-- Modal -->
    <div class="modal fade bg-white" id="templatemo_search" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="w-100 pt-1 mb-5 text-right">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" method="get" class="modal-content modal-body border-0 p-0">
                <div class="input-group mb-2">
                    <input type="text" class="form-control" id="inputModalSearch" name="q" placeholder="Search ...">
                    <button type="submit" class="input-group-text bg-success text-light">
                        <i class="fa fa-fw fa-search text-white"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>



    <!-- Start Banner Hero -->
    <div id="template-mo-zay-hero-carousel" class="carousel slide" data-bs-ride="carousel">
        <ol class="carousel-indicators">
            <li data-bs-target="#template-mo-zay-hero-carousel" data-bs-slide-to="0" class="active"></li>
            <li data-bs-target="#template-mo-zay-hero-carousel" data-bs-slide-to="1"></li>
            <li data-bs-target="#template-mo-zay-hero-carousel" data-bs-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <div class="container">
                    <div class="row p-5">
                        <div class="mx-auto col-md-8 col-lg-6 order-lg-last">
                            <img class="img-fluid" src="<?php echo base_url(); ?>img/logobig.jpg"  alt="">
                        </div>
                        <div class="col-lg-6 mb-0 d-flex align-items-center">
                            <div class="text-align-left align-self-center">
                            <h1 class="h1 text-black"><b></b>Nuestro compromiso es tu desarrollo</h1>
                            <h3 class="h2 text-black">CEPRA tu camino hacia el éxito educativo</h3>

                                <p>
                                En el Instituto CEPRA, estamos dedicados a forjar el futuro de nuestros estudiantes. Con una trayectoria de excelencia educativa, nuestro instituto se enorgullece de ofrecer programas académicos de alta calidad, un equipo de profesionales apasionados y un ambiente de aprendizaje que fomenta el crecimiento personal y académico. <a rel="sponsored" class="text-success" href="https://templatemo.com" target="_blank"></a> 
                                     <a rel="sponssored" class="text-success" href="https://stories.freepik.com/" target="_blank"></a>
                                    <a rel="sponsored" class="text-success" href="https://unsplash.com/" target="_blank"></a> 
                                    <a rel="sponsored" class="text-success" href="https://icons8.com/" target="_blank"></a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <div class="container">
                    <div class="row p-5">
                        <div class="mx-auto col-md-8 col-lg-6 order-lg-last">
                            <img class="img-fluid" src="<?php echo base_url(); ?>img/logobig_3.jpeg" alt="">
                        </div>
                        <div class="col-lg-6 mb-0 d-flex align-items-center">
                            <div class="text-align-left">
                                <h1 class="h1">Aprendizaje constante</h1>
                                <h3 class="h2">Aprende a tu ritmo, donde quieras, cuando quieras</h3>
                                <p>
                                Entendemos que la educación debe ser accesible en todo momento, por lo que también valoramos la importancia de los videotutoriales. Nuestros alumnos pueden acceder a una amplia gama de recursos educativos en línea, incluyendo videotutoriales de alta calidad que complementan su experiencia en el aula. Aquí, no solo construimos conocimiento, sino también sueños y oportunidades.
                                    <strong></strong>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <div class="container">
                    <div class="row p-5">
                        <div class="mx-auto col-md-8 col-lg-6 order-lg-last">
                            <img class="img-fluid" src="<?php echo base_url(); ?>img/logobig_5.jpg" alt="">
                        </div>
                        <div class="col-lg-6 mb-0 d-flex align-items-center">
                            <div class="text-align-left">
                                <h1 class="h1">El camino hacia el crecimiento personal</h1>
                                <h3 class="h2">Fomentando la excelencia para un futuro brillante </h3>
                                <p>
                                Nuestros programas educativos están diseñados para nutrir la excelencia interior, fomentando habilidades como la autoconfianza, la resiliencia y el liderazgo. Aquí encontrarás un ambiente enriquecedor donde puedes explorar tus pasiones, establecer metas ambiciosas y alcanzar nuevos horizontes.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <a class="carousel-control-prev text-decoration-none w-auto ps-3" href="#template-mo-zay-hero-carousel" role="button" data-bs-slide="prev">
            <i class="fas fa-chevron-left"></i>
        </a>
        <a class="carousel-control-next text-decoration-none w-auto pe-3" href="#template-mo-zay-hero-carousel" role="button" data-bs-slide="next">
            <i class="fas fa-chevron-right"></i>
        </a>
        
    </div>
    <!-- End Banner Hero -->


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
                <h2 class="h5 text-center mt-3 mb-3">Diseño 3D</h2>
                <p class="text-center"><a class="btn btn-success">ir al Curso</a></p>
            </div>
            <div class="col-12 col-md-4 p-5 mt-3">
                <a href="#"><img src="<?php echo base_url(); ?>img/programacion_cero.jpeg" class="rounded-circle img-fluid border"></a>
                <h2 class="h5 text-center mt-3 mb-3">Programación</h2>
                <p class="text-center"><a class="btn btn-success">ir al Curso</a></p>
            </div>
        </div>
    </section>
    <!-- End Categories of The Month -->


    <!-- Start Featured Product -->
    <section class="bg-light">
        <div class="container py-5">
            <div class="row text-center py-3">
                <div class="col-lg-6 m-auto">
                    <h1 class="h1">Valoraciones y testimonios</h1>
                    <p>
                    ¡La voz de nuestros estudiantes importa! En esta sección. Vea las calificaciones y reseñas honestas de nuestros alumnos para obtener una idea clara de lo que puedes esperar. Nos enorgullece compartir sus comentarios y estamos comprometidos a brindarte una experiencia educativa excepcional."
                    </p>
                </div>
            </div>
            <div class="row">
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
                            <a href="shop-single.html" class="h2 text-decoration-none text-dark">Modelado 3D con Solidworks</a>
                            <p class="card-text">
                                El curso fue satisfactorio, pero falto mas carga horaria - Anonimo
                            </p>
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
    </section>
    <!-- End Featured Product -->


    <!-- Start Footer -->
    <footer class="bg-dark" id="tempaltemo_footer">
        <div class="container">
            <div class="row">

                <div class="col-md-4 pt-5">
                <h2 class="h2 text-success border-bottom pb-3 border-light logo" style="color: #007BFF;">CEPRA</h2>

                    <ul class="list-unstyled text-light footer-link-list">
                        <li>
                            <i class="fas fa-map-marker-alt fa-fw"></i>
                            Calle Sucre N°458
                        </li>
                        <li>
                            <i class="fa fa-phone fa-fw"></i>
                            <a class="text-decoration-none" href="tel:010-020-0340">79988432</a>
                        </li>
                        <li>
                            <i class="fa fa-envelope fa-fw"></i>
                            <a class="text-decoration-none" href="mailto:info@company.com">info@cepra.com</a>
                        </li>
                    </ul>
                </div>

                <div class="col-md-4 pt-5">
                    <h2 class="h2 text-light border-bottom pb-3 border-light">Recursos libres</h2>
                    <ul class="list-unstyled text-light footer-link-list">
                        <li><a class="text-decoration-none" href="#">Cursos gratis</a></li>
                        <li><a class="text-decoration-none" href="#">Blog</a></li>
                        <li><a class="text-decoration-none" href="#">Conferencias</a></li>
                        <li><a class="text-decoration-none" href="#">Comunidad</a></li>
                        <li><a class="text-decoration-none" href="#">Servicions para colegios y universidades</a></li>
                      
                    </ul>
                </div>

                <div class="col-md-4 pt-5">
                    <h2 class="h2 text-light border-bottom pb-3 border-light">Más</h2>
                    <ul class="list-unstyled text-light footer-link-list">
                        <li><a class="text-decoration-none" href="#">Home</a></li>
                        <li><a class="text-decoration-none" href="#">About Us</a></li>

                        <li><a class="text-decoration-none" href="#">Contact</a></li>
                    </ul>
                </div>

            </div>

            <div class="row text-light mb-4">
                <div class="col-12 mb-3">
                    <div class="w-100 my-3 border-top border-light"></div>
                </div>
                <div class="col-auto me-auto">
                    <ul class="list-inline text-left footer-icons">
                        <li class="list-inline-item border border-light rounded-circle text-center">
                            <a class="text-light text-decoration-none" target="_blank" href="http://facebook.com/"><i class="fab fa-facebook-f fa-lg fa-fw"></i></a>
                        </li>
                        <li class="list-inline-item border border-light rounded-circle text-center">
                            <a class="text-light text-decoration-none" target="_blank" href="https://www.instagram.com/"><i class="fab fa-instagram fa-lg fa-fw"></i></a>
                        </li>
                        <li class="list-inline-item border border-light rounded-circle text-center">
                            <a class="text-light text-decoration-none" target="_blank" href="https://twitter.com/"><i class="fab fa-twitter fa-lg fa-fw"></i></a>
                        </li>
                        <li class="list-inline-item border border-light rounded-circle text-center">
                            <a class="text-light text-decoration-none" target="_blank" href="https://www.linkedin.com/"><i class="fab fa-linkedin fa-lg fa-fw"></i></a>
                        </li>
                    </ul>
                </div>
                <div class="col-auto">
                    <label class="sr-only" for="subscribeEmail">Email address</label>
                    <div class="input-group mb-2">
                        <input type="text" class="form-control bg-dark border-light" id="subscribeEmail" placeholder="Email address">
                        <div class="input-group-text btn-success text-light">Subscribe</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="w-100 bg-black py-3">
            <div class="container">
                <div class="row pt-2">
                    <div class="col-12">
                        <p class="text-left text-light">
                            Copyright &copy; 2023 CEPRA
                            <!-- | Designed by <a rel="sponsored" href="https://templatemo.com" target="_blank">TemplateMo</a> -->
                        </p>
                    </div>
                </div>
            </div>
        </div>

    </footer>
    <!-- End Footer -->

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