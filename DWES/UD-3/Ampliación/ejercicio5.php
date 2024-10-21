<?php

/**
 * @Author: Álvaro Escartí
 */


// Realiza el control de acceso a una caja fuerte. La combinación será un número de 4 cifras. El
//programa nos pedirá la combinación para abrirla. Si no acertamos, se nos mostrará el mensaje
// “Lo siento, esa no es la combinación” y si acertamos se nos dirá “La caja fuerte se ha abierto
//satisfactoriamente”. Tendremos cuatro oportunidades para abrir la caja fuerte.

$minimo = 0000;
$maximo = 9999;
$numeroSecreto = rand($minimo, $maximo);
// Función que permite aañdir 0 hasta un número de cuatro cifras.
$numeroSecreto = str_pad($numeroSecreto, 4, '0', STR_PAD_LEFT);
$contador = 1;

while ($contador <= 4) {
    $respuesta = readline("introduce la combinación secreta: ");
    $contador++;
    if ($respuesta != $numeroSecreto) {
        echo "Lo siento, la combinación no es correcta, vuelve a intentarlo.\n";
    } else {
        echo "Enhorabuena, has acertado la combinación.\n";
        $contador = 5;
    }
}
?>