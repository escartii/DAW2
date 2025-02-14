<?php
include_once "Animal.php";

abstract class Mamifero extends Animal {
    static protected $totalMamiferos = 0;
    
    public function __construct($sexo = "M") {
        parent::__construct($sexo);
        self::$totalMamiferos++;
    }
    
    public static function getTotalMamiferos() {
        return "Hay un total de " . self::$totalMamiferos . " mamíferos<br>";
    }
    
    public static function decrementMamiferos() {
        self::$totalMamiferos--;
    }
    
    // Método propio de los mamíferos.
    public function amamantar() {
        if($this->sexo == "M") {
            echo $this->getClassIdentifier() . ": Soy macho, no puedo amamantar<br>";
        } else {
            echo $this->getClassIdentifier() . ": Amamantando a mis crias<br>";
        }
    }
}
?>
