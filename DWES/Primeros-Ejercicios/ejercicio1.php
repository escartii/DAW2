<?php
/**
 * @Author: Álvaro Escartí
 */

// como levantar un servidor en el puerto 8000
// php -S localhost:puerto
$nombre = readline("Dime tu nombre: ");
echo ("Hola $nombre, Encantado de conocerte\n");

for ($i = 0; $i < 7; $i++) {
    echo ("contador: " .$i);
}


?>

