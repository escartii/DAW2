<?php
// a) Múltiplos de 5 entre 0 y 100 usando bucle for
echo "Múltiplos de 5 usando bucle for:<br>";
for ($i = 0; $i <= 100; $i += 5) {
    echo $i . "<br>";
}

// b) Múltiplos de 5 entre 0 y 100 usando bucle while
echo "<br>Múltiplos de 5 usando bucle while:<br>";
$i = 0;
while ($i <= 100) {
    echo $i . "<br>";
    $i += 5;
}

// c) Múltiplos de 5 entre 0 y 100 usando bucle do-while
echo "<br>Múltiplos de 5 usando bucle do-while:<br>";
$i = 0;
do {
    echo $i . "<br>";
    $i += 5;
} while ($i <= 100);
?>