<?php
// Definimos un array que represente la tabla de perfiles
$tablaPerfiles = [
    'Delegado' => [
        'Mayor de edad'  => false,
        'Menor de edad'  => true,
        'Con cargo'      => true,
        'Sin cargo'      => false
    ],
    'Estudiante' => [
        'Mayor de edad'  => false,
        'Menor de edad'  => true,
        'Con cargo'      => false,
        'Sin cargo'      => true
    ],
    'Profesor' => [
        'Mayor de edad'  => true,
        'Menor de edad'  => false,
        'Con cargo'      => false,
        'Sin cargo'      => true
    ],
    'Director' => [
        'Mayor de edad'  => true,
        'Menor de edad'  => false,
        'Con cargo'      => true,
        'Sin cargo'      => false
    ]
];
