<?php
include_once "Animal.php";

abstract class Mamifero extends Animal {
    static protected $totalMamiferos = 0;
    
    public function __construct($sexo = "M") {
        // constructor de la clase padre
        parent::__construct($sexo);
        self::$totalMamiferos++;
    }
    
    public static function getTotalMamiferos() {
        return "Hay un total de " . self::$totalMamiferos . " mamíferos<br>";
    }
    
    public static function decrementMamiferos() {
        // 
        self::$totalMamiferos--;
    }
    
    // Metodo que comprobamos si puede amamantar
    public function amamantar() {
        if($this->sexo == "M") {
            echo $this->getClassIdentifier() . ": Soy macho, no puedo amamantar<br>";
        } else {
            echo $this->getClassIdentifier() . ": Amamantando a mis crias<br>";
        }
    }
    
    abstract public function __toString();
}
?>
