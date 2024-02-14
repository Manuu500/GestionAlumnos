<?php

class Partes{
    
    private $id;
    private $dni_p;
    private $dni_a;
    private $motivo;
    private $time;
    private $nombre;
    private $apellidos;
    
    public function __construct($id = 0, $dniP, $dniA, $mot, $time, $nom, $apel) {
        $this->id = $id;
        $this->dni_p = $dniP;
        $this->dni_a = $dniA;
        $this->motivo = $mot;
        $this->time = $time;
        $this->nombre = $nom;
        $this->apellidos = $apel;
    }
    
    public function __get($name) {
        return $this->$name;
    }
    
    public function __set($name, $value) {
        return $this->$name = $value;
    }
}

