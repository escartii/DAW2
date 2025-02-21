<?php
include_once "Ave.php";

class Canario extends Ave {
    
    public function __construct($sexo = "M") {
        parent::__construct($sexo);
    }
    
    // Métodos
    public static function consSexo($sexo) {
        // igual que hacer new Canario
        return new self($sexo);
    }
    
    public static function consFull($sexo, $nombre) {
        $obj = new self($sexo);
        $obj->setNombre($nombre);
        return $obj;
    }
    
    // tengo que llamar al padre y pasarle el get comida
    public function alimentarse($comida = "") {
        echo $this->getClassIdentifier() . ": Estoy comiendo alpiste<br>";
    }
    // añadir Canario
    public function pia() {
        echo $this->getClassIdentifier() . ": Pio pio pio<br>";
    }
    // tendria que llamar al padre y pasarle el tostring
    protected function getClassIdentifier() {
        return "Canario" . ($this->nombre != "" ? " " . $this->nombre : "");
    }
    // llamar al padre para concantenar el toString
    public function __toString() {
        $nombreText = ($this->nombre != "") ? ", llamado " . $this->nombre : "";
        return "Soy un Animal, un Ave, en concreto un Canario, con sexo " . $this->getSexoCompleto() . $nombreText . "<br>";
    }
}
?>
