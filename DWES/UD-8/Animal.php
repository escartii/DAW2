<?php
abstract class Animal {
    protected $sexo;
    protected $nombre = "";
    static protected $totalAnimales = 0;
    
    public function __construct($sexo = "M") {
        // Solo se permite "H" o "M". Si no es "H", se asigna "M".
        $this->sexo = (strtoupper($sexo) == "H") ? "H" : "M";
        self::$totalAnimales++;
    }
    
    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }
    
    public function getNombre() {
        return $this->nombre;
    }
    
    public function getSexo() {
        return $this->sexo;
    }
    
    protected function getSexoCompleto() {
        return ($this->sexo == "H") ? "HEMBRA" : "MACHO";
    }
    
    // Los métodos de comportamiento se basan en el identificador concreto que
    // cada subclase debe definir (por ejemplo: "Lagarto Godzilla" o "Perro Laika")
    public function dormirse() {
        echo $this->getClassIdentifier() . ": Zzzzzzz<br>";
    }
    
    // El método alimentarse() se sobreescribirá en cada subclase para indicar la comida
    public function alimentarse($comida = "") {
        echo $this->getClassIdentifier() . ": Estoy comiendo " . $comida . "<br>";
    }
    
    public function morirse() {
        echo $this->getClassIdentifier() . ": Adiós!<br>";
        self::$totalAnimales--;
        // Si el animal es Ave o Mamífero se actualizan sus contadores específicos.
        if($this instanceof Ave) {
            Ave::decrementAves();
        }
        if($this instanceof Mamifero) {
            Mamifero::decrementMamiferos();
        }
    }
    
    public static function getTotalAnimales() {
        return "Hay un total de " . self::$totalAnimales . " animales<br>";
    }
    
    // Cada subclase concreta debe devolver el identificador usado en los mensajes de acción.
    abstract protected function getClassIdentifier();
    
    // Cada subclase concreta debe definir cómo se muestra la descripción completa.
    abstract public function __toString();
}
?>
