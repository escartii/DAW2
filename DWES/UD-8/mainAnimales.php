<?php
/**
 * @author Silvia Vilar
 * Ej6UD8 - PruebaAnimales.php
 */

include_once "Canario.php";
include_once "Pinguino.php";
include_once "Perro.php";
include_once "Lagarto.php";
include_once "Gato.php";
print Animal::getTotalAnimales();
print Ave::getTotalAves();
print Mamifero::getTotalMamiferos();

//creamos varios animales de Lagarto
$godzilla = new Lagarto();
$godzilla->setNombre("Godzilla");
$diana = Lagarto::consSexo("H");
$diana->setNombre("Diana");
$juancho = Lagarto::consFull("M", "Juancho");
print Animal::getTotalAnimales();

print($godzilla);
$godzilla->tomarSol();
$godzilla->dormirse();
$godzilla->morirse();
print($diana);
$diana->tomarSol();
print($juancho);
$juancho->alimentarse();
print Animal::getTotalAnimales();

//creamos varios animales de Canario
$amarillo=new Canario();
$amarillo->setNombre("Amarillo");
$canaria=Canario::consSexo("H");
$canaria->setNombre("Canaria");
$piolin=Canario::consFull("M","Piolín");
print Animal::getTotalAnimales();
print Ave::getTotalAves();

print($piolin);
$piolin->alimentarse();
$piolin->ponerHuevo();
print($amarillo);
$amarillo->pia();
$amarillo->morirse();
print($canaria);
$canaria->alimentarse();
$canaria->ponerHuevo();
print Animal::getTotalAnimales();
print Ave::getTotalAves();

//creamos varios animales de Pinguino
$p1=new Pinguino();
$pingui=Pinguino::consSexo("H");
$pingui->setNombre("Pingui");
$tux=Pinguino::consFull("H","TUX");
print Animal::getTotalAnimales();
print Ave::getTotalAves();

print($tux);
$tux->alimentarse();
$tux->programar();
$tux->dormirse();
print($pingui);
$pingui->alimentarse();
$pingui->ponerHuevo();
print($p1);
$p1->programar();
$p1->morirse();
print Animal::getTotalAnimales();
print Ave::getTotalAves();

//creamos varios animales de Perro
$perro=new Perro();
$laika = Perro::consSexoNombre("H", "Laika");
$toby = Perro::consFull("M", "Toby", "Cocker");
print Animal::getTotalAnimales();
print Ave::getTotalAves();
print Mamifero::getTotalMamiferos();
print($perro);
$perro->alimentarse();
$perro->morirse();
print($laika);
$laika->dormirse();
$laika->alimentarse();
$laika->amamantar();
print($toby);
$toby->ladra();
$toby->dormirse();
$toby->amamantar();
print Animal::getTotalAnimales();
print Ave::getTotalAves();
print Mamifero::getTotalMamiferos();

//creamos varios animales de Gato
$cat=new Gato();
$sofia=Gato::consSexoNombre("H","Sofía");
$isidoro=Gato::consFull("M","Isidoro","Persa");
print Animal::getTotalAnimales();
print Mamifero::getTotalMamiferos();
print($cat) ;
$cat->alimentarse();
$cat->morirse();
print($sofia);
$sofia->maulla();
$sofia->amamantar();
$sofia->dormirse();
print($isidoro);
$isidoro->alimentarse();
$isidoro->maulla();
$isidoro->dormirse();

//recuento final
print Animal::getTotalAnimales();
print Ave::getTotalAves();
print Mamifero::getTotalMamiferos();
print("Fin del Programa");

?>
