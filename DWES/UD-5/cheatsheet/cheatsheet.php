<?php
// ******************************************
// PHP Cheatsheet Creado por: @Alvaro
// ******************************************

// ------------------------------------------
// VARIABLES
// ------------------------------------------
$nombre = "Juan";  // String
$edad = 25;        // Integer
$pi = 3.14;        // Float
$esActivo = true;  // Boolean

// Concatenación
echo "Hola, mi nombre es " . $nombre . " y tengo " . $edad . " años.\n";

// Constantes
define("PI", 3.14159); // Declarar una constante
echo "El valor de PI es: " . PI . "\n";

// ------------------------------------------
// CONDICIONALES
// ------------------------------------------
$a = 10;
$b = 20;

// if-else
if ($a > $b) {
    echo "$a es mayor que $b\n";
} else {
    echo "$a no es mayor que $b\n";
}

// if-elseif-else
if ($a == $b) {
    echo "$a es igual a $b\n";
} elseif ($a < $b) {
    echo "$a es menor que $b\n";
} else {
    echo "$a es mayor que $b\n";
}

// Operador ternario
$resultado = ($a > $b) ? "$a es mayor" : "$b es mayor";
echo $resultado . "\n";

// switch
$color = "rojo";
switch ($color) {
    case "rojo":
        echo "El color es rojo\n";
        break;
    case "azul":
        echo "El color es azul\n";
        break;
    default:
        echo "Color desconocido\n";
        break;
}

// ------------------------------------------
// BUCLES
// ------------------------------------------

// while
$i = 1;
while ($i <= 5) {
    echo "Número: $i\n";
    $i++;
}

// do-while
$j = 1;
do {
    echo "Número en do-while: $j\n";
    $j++;
} while ($j <= 5);

// for
for ($k = 1; $k <= 5; $k++) {
    echo "Número en for: $k\n";
}

// foreach
$frutas = ["Manzana", "Banana", "Naranja"];
foreach ($frutas as $fruta) {
    echo "Fruta: $fruta\n";
}

// ------------------------------------------
// ARRAYS
// ------------------------------------------

// Array indexado
$numeros = [10, 20, 30];
echo "Primer número: " . $numeros[0] . "\n";

// Array asociativo
$persona = [
    "nombre" => "Juan",
    "edad" => 25,
    "ciudad" => "Valencia"
];
echo "Nombre: " . $persona["nombre"] . "\n";

// Recorrer array asociativo
foreach ($persona as $clave => $valor) {
    echo "$clave: $valor\n";
}

// Array multidimensional
$matriz = [
    [1, 2, 3],
    [4, 5, 6],
    [7, 8, 9]
];
echo "Elemento en (2,3): " . $matriz[1][2] . "\n";

// ------------------------------------------
// FUNCIONES
// ------------------------------------------
function saludar($nombre) {
    return "Hola, $nombre\n";
}
echo saludar("Carlos");

// Función con valor por defecto
function sumar($a, $b = 0) {
    return $a + $b;
}
echo "Suma: " . sumar(5, 10) . "\n";
echo "Suma con valor por defecto: " . sumar(5) . "\n";

// ------------------------------------------
// UTILIDADES EXTRA
// ------------------------------------------

// String functions
$cadena = "Hola Mundo";
echo "Longitud: " . strlen($cadena) . "\n";
echo "En mayúsculas: " . strtoupper($cadena) . "\n";
echo "En minúsculas: " . strtolower($cadena) . "\n";

// Número aleatorio
echo "Número aleatorio: " . rand(1, 10) . "\n";

// ------------------------------------------
// SUPERGLOBALES
// ------------------------------------------
// $_GET, $_POST, $_SERVER, etc.
echo "Método de la petición: " . $_SERVER["REQUEST_METHOD"] . "\n";

 
?>
