<?php

function formatearFecha($fecha)
{
   // <!--2023-05-18 10:13:53 -->
    $dia=substr($fecha,8,2);
    $mes=substr($fecha,5,2);
    $anio=substr($fecha,0,4);
    $hora=substr($fecha,11,5);
    
    $fechaFormateada=$dia."-".$mes."-".$anio." ".$hora;
    return $fechaFormateada;
}
?>
