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
        <h2 class="featurette-heading">MODIFICAR EVALUACION<span class="text-muted"></span></h2><br>


    </div>
    <div class="col-md-5">
        <center><img src="<?php echo base_url(); ?>img/imgvt.png" width="120"></center>

    </div>

    <!--<div col-md-12> -->

    <?php foreach ($infocursos->result() as $row) : ?>
    <?php echo form_open_multipart('evaluaciones/modificarbd'); ?>
    <input type="hidden" name="idEvaluacion" value="<?php echo $row->idEvaluacion; ?>">
    
    <label for="titulo">TITULO</label>
    <input type="text" name="titulo" placeholder="Escriba el título" class="form-control" value="<?php echo $row->tituloEvaluacion; ?>"><br>

    <label for="descripcion">DESCRIPCION</label>
    <input type="text" name="descripcion" placeholder="Escriba la descripción" class="form-control" value="<?php echo $row->descripcionEvaluacion; ?>"><br>
    <label for="startDate">Fecha de Habilitacion:</label>
<input type="date" id="startDate" name="startDate"value="<?php echo $row->fechaInicio; ?>"><br><br>
        <label for="deadline">Fecha de Vencimiento:</label>
        <input type="date" id="deadline" name="deadline"value="<?php echo $row->fechaFin; ?>"><br><br>
    <!-- ... (otros campos) ... -->

    <!-- Preguntas y Respuestas: -->
    <h2>Preguntas de Selección Múltiple</h2>
    <div id="questions">
    <?php $contadorPregunta = 1; ?>
        <?php foreach ($preguntas as $pregunta) : ?>
            <div class="question">
                <label for="question<?php echo $pregunta->idPregunta; ?>">Pregunta <?php echo $contadorPregunta; ?>:</label>
                <input type="text" id="question<?php echo $pregunta->idPregunta; ?>" name="questions[]" required value="<?php echo $pregunta->enunciadoPregunta; ?>"><br><br>
                
                <?php $contadorPregunta++; ?>
                <!-- ... (otros campos de pregunta y respuestas) ... -->

                <!-- <button type="button" class="deleteButton" onclick="deleteQuestion(this)">Eliminar</button> -->
            </div>
        <?php endforeach; ?>
    </div>
    <!-- <button type="button" onclick="addQuestion()">Agregar Pregunta</button><br><br> -->

    <label for="totalScore">Puntaje Total:</label>
    <input type="text" id="totalScore" name="totalScore" readonly value="<?php echo $row->puntajeTotal; ?>"><br><br>

    <label for="numeroIntentos">Número de Intentos Permitidos:</label>
    <input type="number" id="numeroIntentos" name="numeroIntentos" value="<?php echo $row->numeroIntentos; ?>" min="1" required><br><br>

    <input type="submit" value="Modificar Evaluación">
    <?php echo form_close(); ?>
<?php endforeach; ?>

                            <button type="submit" class="btn btn-success ">modificar</button>

                            <button type="reset" class="btn btn-primary" onClick="history.go(-1);">Cancelar</button>
                        </div>

                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!--/.col (right) -->
            </div>
            <!-- /.row -->

        </section>
</div><!-- /.container-fluid -->


<?php
        echo form_close();
    
?>



<!--        </form>*/ -->


</div>


</div>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->