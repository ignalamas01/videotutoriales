<!-- verificar_certificado.php -->
<h2>Verificar Certificado</h2>

<form method="post" action="<?php echo base_url('index.php/certificados/verificar_codigo'); ?>">
    <label for="codigo">Ingrese el código de certificación:</label>
    <input type="text" id="codigo" name="codigo" required>
    <button type="submit">Verificar</button>
</form>
