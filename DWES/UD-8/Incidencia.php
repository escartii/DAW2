<?php

/**
 * @Author: Álvaro Escartí
 */

class Incidencia {
    private $codigo;
    private $puesto;
    private $descripcion;
    private $estado;
    private $resolucion;

    // Variables estáticas para asignar códigos automáticos y contar incidencias pendientes
    private static $codigoAutomatico = 1;
    private static $pendientes = 0;

    // Constructor: recibe el puesto y la descripción de la incidencia
    public function __construct($puesto, $descripcion) {
        $this->codigo = self::$codigoAutomatico;
        self::$codigoAutomatico++;

        $this->puesto = $puesto;
        $this->descripcion = $descripcion;
        $this->estado = "Pendiente";
        $this->resolucion = "";

        // Se incrementa el contador de incidencias pendientes
        self::$pendientes++;
    }

    // Método para resolver la incidencia: cambia el estado y guarda la información de resolución
    public function resuelve($resolucion) {
        if ($this->estado === "Pendiente") {
            $this->estado = "Resuelta";
            $this->resolucion = $resolucion;
            self::$pendientes--;
        }
    }

    // Método estático para obtener el número de incidencias pendientes
    public static function getPendientes() {
        return self::$pendientes;
    }

    // Método mágico __toString para mostrar la incidencia de forma legible
    public function __toString() {
        $str = "Incidencia {$this->codigo} - Puesto: {$this->puesto} - {$this->descripcion} - {$this->estado}";
        if ($this->estado === "Resuelta") {
            $str .= " - {$this->resolucion}";
        }
        $str .= "<br>";
        return $str;
    }
}
?>
