<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>*</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>index.php/base/index">Home</a></li>
              <li class="breadcrumb-item active">DataTables</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <div class="row featurette">
    <div class="col-md-7">
        <br>
        <h2 class="featurette-heading">LISTA DE CURSOS<span class="text-muted"> ****</span></h2><br>
        
        <a href="<?php echo base_url(); ?>index.php/cursos/deshabilitados"> <button type="button" class="btn btn-info">VER LISTA DE CURSOS DESHABILITADOS</button> </a>
    
    </div>
    <div class="col-md-5">
        <center><img src="<?php echo base_url(); ?>img/imgvt.png" width="120"></center>

    </div>

    <table class="table">
        <tr>
            <td>no</td>
            <td>TITULO</td>
            <td>DESCRIPCION</td>
            <td>FOTO</td>
           
            
            <td>HABILITAR</td>



        </tr>
        <?php
        $indice = 1;
        foreach ($cursos->result() as  $row) {
        ?>
            <tr>
                <td> <?php echo $indice; ?> </td>
                <td> <?php echo $row->titulo;?> </td>
                <td> <?php echo $row->descripcion; ?> </td>
                <td> <?php echo $row->foto; ?> </td>
                
               
                <td>

                    <?php
                    echo form_open_multipart('cursos/habilitarbd')
                    ?>
                    <input type="hidden" name="idcursos" value="<?php echo $row->id; ?> ">
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