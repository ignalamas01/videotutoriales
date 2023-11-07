<li class="nav-item">
    <a href="#" class="nav-link">
        <i class="nav-icon fas fa-copy"></i>
        <p>
            secciones
            <i class="fas fa-angle-left right"></i>
            <span class="badge badge-info right">6</span>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <?php
        $cursos = obtenerListaDeCursos(); // Reemplaza con la función o array que contiene los cursos
        foreach ($cursos as $curso) {
        ?>
            <li class="nav-item">
                <a href="<?php echo base_url(); ?>index.php/secciones/seccion/<?php echo $curso['id']; ?>" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p><?php echo $curso['nombre']; ?></p>
                </a>
            </li>
        <?php
        }
        ?>
    </ul>
</li>