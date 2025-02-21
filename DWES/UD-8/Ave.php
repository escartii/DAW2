<?php
include_once "Animal.php";

abstract class Ave extends Animal {
    static protected $totalAves = 0;
    
    // corregir 
    public function __construct($sexo = "M") {
        parent::__construct($sexo);
        self::$totalAves++;
    }
    
    public static function getTotalAves() {
        return "Hay un total de " . self::$totalAves . " aves<br>";
    }
    
    public static function decrementAves() {
        self::$totalAves--;
    }
    
    // Método específico para las aves.
    public function ponerHuevo() {
        if($this->sexo == "M") {
            echo $this->getClassIdentifier() . ": Soy macho, no puedo poner huevos<br>";
        } else {
            echo $this->getClassIdentifier() . ": He puesto un huevo!<br>";
        }
    }
    // falta morirse 
    
    // llamar al padre
    abstract public function __toString();
}
?>
