<?php

/**
 * @Author: Álvaro Escartí
 */

// Fecha y hora actual                                 
$fecha_actual = new DateTime();                                                              
$fecha_deseada = new DateTime('2025-01-01 00:00:30');                                  
                              
$diferencia = $fecha_actual->diff($fecha_deseada);                                                                 
$horas = $diferencia->days * 24 + $diferencia->h;                                 
$minutos = $diferencia->i;                                 


echo "Quedan $horas horas y $minutos minutos para la fecha deseada.\n";
?>