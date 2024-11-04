<div class="content-wrapper">
    <section class="content-header">
        <h1>Editar Suscripción</h1>
        <?php echo form_open('suscripciones/actualizar/' . $suscripcion->idSuscripcion); ?>
        <input type="hidden" name="idSuscripcion" value="<?php echo $suscripcion->idSuscripcion; ?>">
    </section>

    <section class="content">
        <div class="form-group">
            <label>Fecha de Inicio</label>
            <div class="col-md-5"> <!-- Controlar ancho usando col-md-6 -->
            <input type="date" name="fechaInicio" class="form-control" value="<?php echo $suscripcion->fechaInicio; ?>" required>
        </div>
        <div class="form-group">
        <div class="col-md-5"> <!-- Controlar ancho usando col-md-6 -->
            <label>Fecha de Fin</label>
            <input type="date" name="fechaFin" class="form-control" value="<?php echo $suscripcion->fechaFin; ?>" required>
        </div>
        <button type="submit" class="btn btn-warning">Actualizar</button>
        <button type="reset" class="btn btn-primary" onClick="history.go(-1);">Cancelar</button>
        </form>
    </section>
</div>
