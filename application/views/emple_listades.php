<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>   LISTA DE PROFESORES DESHABILTADOS     </h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item active">profesores deshabilitados</li>
              <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>index.php/base/index">inicio</a></li>
              
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <div class="row featurette">
    <div class="col-md-7">
        <br>
        <h2 class="featurette-heading"><span class="text-muted"> </span></h2><br>
        
        <!-- <a href="<?php echo base_url(); ?>index.php/base/deshabilitados"> <button type="button" class="btn btn-info">VER LISTA DE EMPLEADOS DESHABILITADOS</button> </a> -->
    
    </div>
    <div class="col-md-5">
        <!-- <center><img src="<?php echo base_url(); ?>img/imgvt.png" width="120"></center> -->

    </div>

    <table class="table">
        <tr>
            <td>no</td>
            <td>NOMBRE</td>
            <td>PRIMER APELLIDO</td>
            <td>SEGUNDO APELLIDO</td>
            <td>DEPARTAMENTO</td>
            <td>FECHA DE NACIMIENTO</td>
            <td>TELEFONO</td>
            <td>DIRECCION</td>
            
            <td>HABILITAR</td>



        </tr>
        <?php
        $indice = 1;
        foreach ($empleado->result() as  $row) {
        ?>
            <tr>
                <td> <?php echo $indice; ?> </td>
                <td> <?php echo $row->nombre;?> </td>
                <td> <?php echo $row->primerApellido; ?> </td>
                <td> <?php echo $row->segundoApellido; ?> </td>
                <td> <?php echo $row->departamento;  ?></td>
                <td> <?php echo $row->fechaNacimiento; ?></td>
                <td> <?php echo $row->telefono; ?></td>
                <td> <?php echo $row->direccion; ?></td>
               
                <td>

                    <?php
                    echo form_open_multipart('base/habilitarbd')
                    ?>
                    <input type="hidden" name="idempleado" value="<?php echo $row->id; ?> ">
                    <button type="submit" class="btn btn-info">HABILITAR</button>
                    <?php
                    echo form_close();
                    ?>
                </td>





            </tr>

        <?php
            $indice++;
        }
        ?>
    </table>
</div>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->