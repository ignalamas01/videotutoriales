<!-- certificado_verificado.php -->
<h2>Certificado Verificado</h2>
<p>El certificado con código <strong><?php echo $certificado->codificacion; ?></strong> está verificado.</p>
<p><strong>Estudiante:</strong> <?php echo $certificado->nombre . ' ' . $certificado->primerApellido . ' ' . $certificado->segundoApellido; ?></p>
<p><strong>Curso:</strong> <?php echo $certificado->titulo; ?></p>
<p><strong>Fecha de emisión:</strong> <?php echo $certificado->fechaEmision; ?></p>
