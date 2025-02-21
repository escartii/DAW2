<?php
include_once "Mamifero.php";

class Perro extends Mamifero {
    private $raza;
    
    // En consSexoNombre asignamos por defecto la raza "teckel"
    public function __construct($sexo = "M") {
        parent::__construct($sexo);
    }
    // Actualizar la raza
    public function setRaza($raza) {
        $this->raza = $raza;
    }
    // getter de raza
    public function getRaza() {
        return $this->raza;
    }
    
    // Fábricas
    public static function consSexoNombre($sexo, $nombre) {
        $obj = new self($sexo, "teckel");
        $obj->setNombre($nombre);
        return $obj;
    }
    
    public static function consFull($sexo, $nombre, $raza) {
        $obj = new self($sexo, $raza);
        $obj->setNombre($nombre);
        return $obj;
    }
    
    // El perro come carne
    public function alimentarse($comida = "") {
        echo $this->getClassIdentifier() . ": Estoy comiendo carne<br>";
    }
    
    public function ladra() {
        echo $this->getClassIdentifier() . ": Guau guau<br>";
    }
    
    // Para los mensajes de acción se muestra: "Perro [nombre]"
    protected function getClassIdentifier() {
        return "Perro" . ($this->nombre != "" ? " " . $this->nombre : "");
    }
    // llamar al padre y pasarle tostring
    public function __toString() {
        $nombreText = ($this->nombre != "") ? ", mi nombre es " . $this->nombre : " y no tengo nombre";
        $razaText = ($this->raza != "") ? " raza " . $this->raza : " raza";
        return "Soy un Animal, un Mamífero, en concreto un Perro, con sexo " . $this->getSexoCompleto() . $razaText . $nombreText . "<br>";
    }
}
?>
