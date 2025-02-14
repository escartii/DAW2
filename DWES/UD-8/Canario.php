<?php
include_once "Ave.php";

class Canario extends Ave {
    
    public function __construct($sexo = "M") {
        parent::__construct($sexo);
    }
    
    // Métodos fábrica
    public static function consSexo($sexo) {
        return new self($sexo);
    }
    
    public static function consFull($sexo, $nombre) {
        $obj = new self($sexo);
        $obj->setNombre($nombre);
        return $obj;
    }
    
    // El canario come alpiste
    public function alimentarse($comida = "") {
        echo $this->getClassIdentifier() . ": Estoy comiendo alpiste<br>";
    }
    
    public function pia() {
        echo $this->getClassIdentifier() . ": Pio pio pio<br>";
    }
    
    protected function getClassIdentifier() {
        return "Canario" . ($this->nombre != "" ? " " . $this->nombre : "");
    }
    
    public function __toString() {
        $nombreText = ($this->nombre != "") ? ", llamado " . $this->nombre : "";
        return "Soy un Animal, un Ave, en concreto un Canario, con sexo " . $this->getSexoCompleto() . $nombreText . "<br>";
    }
}
?>
