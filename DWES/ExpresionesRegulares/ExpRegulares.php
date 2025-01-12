<?php

/**
 * @Author: Álvaro Escartí
 *
 */

//Ejercicios de Expresiones Regulares en PHP

echo "<pre>";
// a) Patrón para los teléfonos fijos de la provincia de Valencia
echo "a) Teléfonos fijos de la provincia de Valencia:\n";
$pattern_a = '/^96\d{7}$/';
$valid_a = "961234567";
$invalid_a = "981234567";

echo "  Cadena válida: $valid_a => " . (preg_match($pattern_a, $valid_a) ? "Válido" : "No válido") . "\n";
echo "  Cadena no válida: $invalid_a => " . (preg_match($pattern_a, $invalid_a) ? "Válido" : "No válido") . "\n\n";

// b) Patrón para los códigos postales de la Comunidad Valenciana
echo "b) Códigos postales de la Comunidad Valenciana:\n";
$pattern_b = '/^(03|12|46)\d{3}$/';
$valid_b = "46001";
$invalid_b = "45001";

echo "  Cadena válida: $valid_b => " . (preg_match($pattern_b, $valid_b) ? "Válido" : "No válido") . "\n";
echo "  Cadena no válida: $invalid_b => " . (preg_match($pattern_b, $invalid_b) ? "Válido" : "No válido") . "\n\n";

// c) Patrón para los teléfonos móviles
echo "c) Teléfonos móviles:\n";
$pattern_c = '/^[67]\d{8}$/';
$valid_c = "612345678";
$invalid_c = "512345678";

echo "  Cadena válida: $valid_c => " . (preg_match($pattern_c, $valid_c) ? "Válido" : "No válido") . "\n";
echo "  Cadena no válida: $invalid_c => " . (preg_match($pattern_c, $invalid_c) ? "Válido" : "No válido") . "\n\n";

// d) Patrón para un NIF
echo "d) NIF:\n";
$pattern_d = '/^\d{8}[A-Z]$/';
$valid_d = "12345678Z";
$invalid_d = "1234567A";

echo "  Cadena válida: $valid_d => " . (preg_match($pattern_d, $valid_d) ? "Válido" : "No válido") . "\n";
echo "  Cadena no válida: $invalid_d => " . (preg_match($pattern_d, $invalid_d) ? "Válido" : "No válido") . "\n\n";

// e) Patrón para fecha en formato dd/mm/aaaa o dd-mm-aaaa
echo "e) Fecha (dd/mm/aaaa o dd-mm-aaaa):\n";
$pattern_e = '/^(0[1-9]|[12]\d|3[01])[\/\-](0[1-9]|1[0-2])[\/\-](\d{4})$/';
$valid_e = "31/12/2020";
$invalid_e = "32/13/2020";

echo "  Cadena válida: $valid_e => " . (preg_match($pattern_e, $valid_e) ? "Válido" : "No válido") . "\n";
echo "  Cadena no válida: $invalid_e => " . (preg_match($pattern_e, $invalid_e) ? "Válido" : "No válido") . "\n\n";

// f) Patrón para una cadena que sea "aprobado" (puede ser mayúsculas o minúsculas)
echo "f) Cadena exacta 'aprobado' (cualquier combinación de mayúsculas/minúsculas):\n";
$pattern_f = '/^[Aa][Pp][Rr][Oo][Bb][Aa][Dd][Oo]$/';
$valid_f = "APROBADO";
$invalid_f = "Aprobada";

echo "  Cadena válida: $valid_f => " . (preg_match($pattern_f, $valid_f) ? "Válido" : "No válido") . "\n";
echo "  Cadena no válida: $invalid_f => " . (preg_match($pattern_f, $invalid_f) ? "Válido" : "No válido") . "\n\n";

// g) Patrón para una cadena que contenga "aprobado" en minúsculas
echo "g) Cadena exacta 'aprobado' en minúsculas:\n";
$pattern_g = '/^aprobado$/';
$valid_g = "aprobado";
$invalid_g = "Aprobado";

echo "  Cadena válida: $valid_g => " . (preg_match($pattern_g, $valid_g) ? "Válido" : "No válido") . "\n";
echo "  Cadena no válida: $invalid_g => " . (preg_match($pattern_g, $invalid_g) ? "Válido" : "No válido") . "\n\n";

// h) Patrón para una cadena que contenga "aprobado" tanto en mayúsculas como en minúsculas
echo "h) Cadena que contiene 'aprobado' en cualquier combinación de mayúsculas/minúsculas:\n";
$pattern_h = '/[Aa][Pp][Rr][Oo][Bb][Aa][Dd][Oo]/';
$valid_h = "He estado APROBADO en el examen.";
$invalid_h = "He estado aprobadoa.";

echo "  Cadena válida: \"$valid_h\" => " . (preg_match($pattern_h, $valid_h) ? "Válido" : "No válido") . "\n";
echo "  Cadena no válida: \"$invalid_h\" => " . (preg_match($pattern_h, $invalid_h) ? "Válido" : "No válido") . "\n\n";

// i) Patrón para letras mayúsculas/minúsculas y espacios
echo "i) Letras (mayúsculas/minúsculas) y espacios:\n";
$pattern_i = '/^[A-Za-z\s]+$/';
$valid_i = "Juan Pérez";
$invalid_i = "Juan Pérez1";

echo "  Cadena válida: \"$valid_i\" => " . (preg_match($pattern_i, $valid_i) ? "Válido" : "No válido") . "\n";
echo "  Cadena no válida: \"$invalid_i\" => " . (preg_match($pattern_i, $invalid_i) ? "Válido" : "No válido") . "\n\n";

// j) Patrón para solamente números, sin espacios
echo "j) Solo números, sin espacios:\n";
$pattern_j = '/^\d+$/';
$valid_j = "1234567890";
$invalid_j = "123 456";

echo "  Cadena válida: \"$valid_j\" => " . (preg_match($pattern_j, $valid_j) ? "Válido" : "No válido") . "\n";
echo "  Cadena no válida: \"$invalid_j\" => " . (preg_match($pattern_j, $invalid_j) ? "Válido" : "No válido") . "\n\n";

// k) Patrón para números con espacios
echo "k) Números con espacios:\n";
$pattern_k = '/^\d+(?:\s\d+)*$/';
$valid_k = "123 456 7890";
$invalid_k = "123-456-7890";

echo "  Cadena válida: \"$valid_k\" => " . (preg_match($pattern_k, $valid_k) ? "Válido" : "No válido") . "\n";
echo "  Cadena no válida: \"$invalid_k\" => " . (preg_match($pattern_k, $invalid_k) ? "Válido" : "No válido") . "\n\n";

// l) Patrón para texto en blanco, números, mayúsculas/minúsculas y caracteres acentuados
echo "l) Texto con espacios, números, letras y caracteres acentuados:\n";
$pattern_l = '/^[A-Za-z0-9\sáéíóúÁÉÍÓÚñÑ]+$/';
$valid_l = "España 2025 año de progreso";
$invalid_l = "España@2025";

echo "  Cadena válida: \"$valid_l\" => " . (preg_match($pattern_l, $valid_l) ? "Válido" : "No válido") . "\n";
echo "  Cadena no válida: \"$invalid_l\" => " . (preg_match($pattern_l, $invalid_l) ? "Válido" : "No válido") . "\n\n";

// m) Patrón para el caso anterior añadiendo signos de puntuación
echo "m) Texto con espacios, números, letras, caracteres acentuados y signos de puntuación:\n";
$pattern_m = '/^[A-Za-z0-9\sáéíóúÁÉÍÓÚñÑ\',.;:-]+$/';
$valid_m = "Hola, mundo: todo está bien.";
$invalid_m = "Hola@ mundo!";

echo "  Cadena válida: \"$valid_m\" => " . (preg_match($pattern_m, $valid_m) ? "Válido" : "No válido") . "\n";
echo "  Cadena no válida: \"$invalid_m\" => " . (preg_match($pattern_m, $invalid_m) ? "Válido" : "No válido") . "\n\n";

// n) Patrón para validar una dirección de email
echo "n) Dirección de email:\n";
$pattern_n = '/^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,}$/';
$valid_n = "usuario@example.com";
$invalid_n = "usuario@.com";

echo "  Cadena válida: \"$valid_n\" => " . (preg_match($pattern_n, $valid_n) ? "Válido" : "No válido") . "\n";
echo "  Cadena no válida: \"$invalid_n\" => " . (preg_match($pattern_n, $invalid_n) ? "Válido" : "No válido") . "\n\n";

// o) Patrón para validar una URL sencilla
echo "o) URL sencilla (http://www.ieslasenia.org/ejercicio?16):\n";
$pattern_o = '/^https?:\/\/www\.[A-Za-z0-9.-]+\.[A-Za-z]{2,}(\/[A-Za-z0-9?=&-]*)?$/';
$valid_o = "http://www.ieslasenia.org/ejercicio?16";
$invalid_o = "ftp://www.ieslasenia.org/ejercicio";

echo "  Cadena válida: \"$valid_o\" => " . (preg_match($pattern_o, $valid_o) ? "Válido" : "No válido") . "\n";
echo "  Cadena no válida: \"$invalid_o\" => " . (preg_match($pattern_o, $invalid_o) ? "Válido" : "No válido") . "\n\n";

// p) Patrón para validar una contraseña
echo "p) Contraseña con al menos una minúscula, una mayúscula, un número y al menos 6 caracteres:\n";
$pattern_p = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{6,}$/';
$valid_p = "Passw0rd";
$invalid_p = "password";

echo "  Cadena válida: \"$valid_p\" => " . (preg_match($pattern_p, $valid_p) ? "Válido" : "No válido") . "\n";
echo "  Cadena no válida: \"$invalid_p\" => " . (preg_match($pattern_p, $invalid_p) ? "Válido" : "No válido") . "\n\n";

// q) Patrón para validar una IPv4
echo "q) Dirección IPv4:\n";
$pattern_q = '/^((25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)\.){3}(25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)$/';
$valid_q = "192.168.1.1";
$invalid_q = "256.100.50.25";

echo "  Cadena válida: \"$valid_q\" => " . (preg_match($pattern_q, $valid_q) ? "Válido" : "No válido") . "\n";
echo "  Cadena no válida: \"$invalid_q\" => " . (preg_match($pattern_q, $invalid_q) ? "Válido" : "No válido") . "\n\n";

// r) Patrón para validar una MAC separada por ':'
echo "r) Dirección MAC separada por ':'\n";
$pattern_r = '/^([0-9A-Fa-f]{2}:){5}[0-9A-Fa-f]{2}$/';
$valid_r = "00:1A:2B:3C:4D:5E";
$invalid_r = "00:1A:2B:3C:4D";

echo "  Cadena válida: \"$valid_r\" => " . (preg_match($pattern_r, $valid_r) ? "Válido" : "No válido") . "\n";
echo "  Cadena no válida: \"$invalid_r\" => " . (preg_match($pattern_r, $invalid_r) ? "Válido" : "No válido") . "\n\n";

// s) Patrón para validar una MAC separada por '-'
echo "s) Dirección MAC separada por '-'\n";
$pattern_s = '/^([0-9A-Fa-f]{2}-){5}[0-9A-Fa-f]{2}$/';
$valid_s = "00-1A-2B-3C-4D-5E";
$invalid_s = "00-1A-2B-3C-4D";

echo "  Cadena válida: \"$valid_s\" => " . (preg_match($pattern_s, $valid_s) ? "Válido" : "No válido") . "\n";
echo "  Cadena no válida: \"$invalid_s\" => " . (preg_match($pattern_s, $invalid_s) ? "Válido" : "No válido") . "\n\n";

// t) Patrón para validar una matrícula de vehículo española
echo "t) Matrícula de vehículo española:\n";
$pattern_t = '/^\d{4}[BCDFGHJKLMNPRSTVWXYZ]{3}$/';
$valid_t = "1234BCD";
$invalid_t = "1234BÑD";

echo "  Cadena válida: \"$valid_t\" => " . (preg_match($pattern_t, $valid_t) ? "Válido" : "No válido") . "\n";
echo "  Cadena no válida: \"$invalid_t\" => " . (preg_match($pattern_t, $invalid_t) ? "Válido" : "No válido") . "\n\n";
echo "</pre>";

?>