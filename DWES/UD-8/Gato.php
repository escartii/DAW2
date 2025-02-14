<?php
include_once "Mamifero.php";

class Gato extends Mamifero {
    private $raza;
    
    public function __construct($sexo = "M", $raza = "") {
        parent::__construct($sexo);
        $this->raza = $raza;
    }
    
    public function setRaza($raza) {
        $this->raza = $raza;
    }
    
    public function getRaza() {
        return $this->raza;
    }
    
    // Fábricas
    public static function consSexoNombre($sexo, $nombre) {
        $obj = new self($sexo);
        $obj->setNombre($nombre);
        return $obj;
    }
    
    public static function consFull($sexo, $nombre, $raza) {
        $obj = new self($sexo, $raza);
        $obj->setNombre($nombre);
        return $obj;
    }
    
    // El gato come pescado
    public function alimentarse($comida = "") {
        echo $this->getClassIdentifier() . ": Estoy comiendo pescado<br>";
    }
    
    public function maulla() {
        echo $this->getClassIdentifier() . ": Miauuuu<br>";
    }
    
    protected function getClassIdentifier() {
        return "Gato" . ($this->nombre != "" ? " " . $this->nombre : "");
    }
    
    public function __toString() {
        $nombreText = ($this->nombre != "") ? ", mi nombre es " . $this->nombre : " y no tengo nombre";
        $razaText = ($this->raza != "") ? " raza " . $this->raza : " raza";
        return "Soy un Animal, un Mamífero, en concreto un Gato, con sexo " . $this->getSexoCompleto() . $razaText . $nombreText . "<br>";
    }
}
?>
