<?php

/**
 * @Author: Álvaro Escartí
 */



function permutaciones($V) {
    $N = count($V);
    for ($i = 0; $i < $N / 2; $i++) {
        $temp = $V[$i];
        $V[$i] = $V[$N - $i - 1];
        $V[$N - $i - 1] = $temp;
    }
    return $V;
}

?>