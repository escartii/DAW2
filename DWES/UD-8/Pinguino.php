<?php
include_once "Ave.php";

class Pinguino extends Ave {
    
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
    
    // El pingüino come peces
    public function alimentarse($comida = "") {
        echo $this->getClassIdentifier() . ": Estoy comiendo peces<br>";
    }

    // añadir getNombre y setNombre
    
    public function programar() {
        echo $this->getClassIdentifier() . ": Soy un pingüino programandor en PHP<br>";
    }
    
    protected function getClassIdentifier() {
        return "Pingüino" . ($this->nombre != "" ? " " . $this->nombre : "");
    }
    // llamar al padre y pasarle tostring
    public function __toString() {
        $nombreText = ($this->nombre != "") ? ", llamado " . $this->nombre : "";
        return "Soy un Animal, un Ave, en concreto un Pingüino, con sexo " . $this->getSexoCompleto() . $nombreText . "<br>";
    }
}
?>
