<?php

/**
 * @Author: Álvaro Escartí
 */


$caracter = readline("Introduce un caracter: ");


switch (true) {
    case ctype_upper($caracter):
        echo "El carácter ingresado es una letra mayúscula.";
        break;
    case ctype_lower($caracter):
        echo "El carácter ingresado es una letra minúscula.";
        break;
    case ctype_digit($caracter):
        echo "El carácter ingresado es un carácter numérico.";
        break;
    case ctype_space($caracter):
        echo "El carácter ingresado es un carácter blanco.";
        break;
    case ctype_punct($caracter):
        echo "El carácter ingresado es un carácter de puntuación.";
        break;
    default:
        echo "El carácter ingresado es un carácter especial.";
        break;
}

?>