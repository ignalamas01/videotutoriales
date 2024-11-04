<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Lista de Suscritos</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <!-- <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>index.php/base/index">Home</a></li> -->
                        <li class="breadcrumb-item active">Lista de Suscritos</li>
                        <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>index.php/usuarios/logout">Cerrar sesión</a></li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <!-- Agrega aquí la tabla con los datos -->
                    <table class="table table-bordered" id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>N°</th>
                            <th>Nombre del Estudiante</th>
                            <th>Título del Curso</th>
                            <th>Fecha de Inicio</th>
                            <th>Fecha de Fin</th>
                            <th>MODIFICAR</th>
                            <th>ELIMINAR</th>
                            <th>DESHABILITAR</th>

                        </tr>
                    </thead>
                    <tbody>
                        
                        <?php
                        $indice = 1;
                        foreach ($estudiante->result() as $row)
                        {
                        ?>
                            <tr>
                                <td> <?php echo $indice; ?> </td>
                                <td><?php echo $row->nombre_estudiante; ?></td>
                                <td><?php echo $row->titulo_curso; ?></td>
                                <td><?php echo $row->fechaInicio; ?></td>
                                <td><?php echo $row->fechaFin; ?></td>
                                <td>
    <?php echo form_open('suscripciones/editar/' . $row->idSuscripcion); ?>
        <button type="submit" class="btn btn-success" title="Editar">
            <i class="fas fa-pencil-alt"></i>
        </button>
    <?php echo form_close(); ?>
</td>

<td>
    <?php echo form_open('suscripciones/eliminar/' . $row->idSuscripcion, array('onsubmit' => 'return confirm("¿Estás seguro de eliminar esta suscripción?");')); ?>
        <button type="submit" class="btn btn-danger" title="Eliminar">
            <i class="fas fa-trash"></i>
        </button>
    <?php echo form_close(); ?>
</td>

<td>
    <?php echo form_open('suscripciones/inhabilitar/' . $row->idSuscripcion); ?>
        <button type="submit" class="btn btn-warning" title="Deshabilitar">DESHABILITAR</button>
    <?php echo form_close(); ?>
</td>

                            </tr>
                            <?php
                        $indice++;
                        }
                        ?>
                        
                    </tbody>
                </table>
                </div>
            </div>
        </div>
    </section>
</div>





