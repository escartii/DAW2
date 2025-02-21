<?php
include_once "Animal.php";

class Lagarto extends Animal {
    
    public function __construct($sexo = "M") {
        // Llama al constructor de la clase padre que es Animal
        parent::__construct($sexo);
    }
    
    // Métodos fábrica
    public static function consSexo($sexo) {
        return new self($sexo);
    }
    // añadir getNombre
    public static function consFull($sexo, $nombre) {
        $obj = new self($sexo);
        $obj->setNombre($nombre);
        return $obj;
    }
    
    // El lagarto come insectos
    public function alimentarse($comida = "") {
        echo $this->getClassIdentifier() . ": Estoy comiendo insectos<br>";
    }
    // modificar 
    public function tomarSol() {
        echo $this->getClassIdentifier() . ": Estoy tomando el sol<br>";
    }
    
    // Para los mensajes de acciones se muestra: "Lagarto [nombre]"
    protected function getClassIdentifier() {
        return "Lagarto" . ($this->nombre != "" ? " " . $this->nombre : "");
    }
    
    public function __toString() {
        $nombreText = ($this->nombre != "") ? ", llamado " . $this->nombre : ", no tengo nombre";
        return "Soy un Animal, en concreto un Lagarto, con sexo " . $this->getSexoCompleto() . $nombreText . "<br>";
    }
}
?>
