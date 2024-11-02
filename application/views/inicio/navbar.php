

<header>
    <!-- Navegación principal de la página -->
    <nav class="navbar navbar-expand-lg fixed-top bg-white">
        <div class="container-fluid d-flex justify-content-between align-items-center">
            <a class="navbar-brand d-flex align-items-center" href="<?php echo base_url(); ?>">
                <img src="<?php echo base_url('assets_admin/img/logo_cepra.jpeg'); ?>" alt="CEPRA Logo" style="width: 50px; height: auto;" class="me-2">
                <span class="h4 mb-0 text-dark" style="font-weight: 400;">CEPRA</span>
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="offcanvas offcanvas-end" tabindex="-1" id="navbarNav" aria-labelledby="offcanvasNavbarLabel">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Menú</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <ul class="navbar-nav ms-auto align-items-center">
                        <li class="nav-item">
                            <a class="nav-link active text-dark" href="<?php echo base_url(); ?>">Inicio</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-dark" href="<?php echo base_url('about'); ?>">Nosotros</a>
                        </li>
                        
                        <li class="nav-item">
                            <a class="nav-link text-dark" href="<?php echo base_url('index.php/certificados/verificar_certificado'); ?>">Verificación</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-dark" href="<?php echo base_url('index.php/usuarios/recuperarcontrasena'); ?>">Recuperar Contraseña</a>
                        </li>

                        <?php if (!empty($categorias)): ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-dark" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Productos
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="<?php echo base_url('cliente/productos'); ?>">Ver Todos los Productos</a></li>
                                <?php foreach ($categorias as $categoria): ?>
                                    <li><a class="dropdown-item" href="<?php echo base_url('cliente/productos_por_categoria/' . $categoria->id); ?>"><?php echo $categoria->nombre; ?></a></li>
                                <?php endforeach; ?>
                            </ul>
                        </li>
                        <?php endif; ?>

                        <li class="nav-item ms-3">
                            <a class="btn btn-login text-dark" href="<?php echo base_url('index.php/usuarios/index'); ?>">
                                <i class="fas fa-sign-in-alt"></i> Iniciar Sesión
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
</header>
