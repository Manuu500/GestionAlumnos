<?php

class Alumno {

    private $dni_a;
    private $nombre;
    private $apellidos;
    private $direccion;
    private $telf;
    private $id_curso;
    private $descripcion;
    private $totalpartes;
    
    public function __construct($dni, $nom, $apel, $direc, $telf, $id, $desc, $totalp) {
        $this->dni_a = $dni;
        $this->nombre = $nom;
        $this->apellidos = $apel;
        $this->direccion = $direc;
        $this->telf = $telf;
        $this->id_curso = $id;
        $this->descripcion = $desc;
        $this->totalpartes = $totalp;
        
    }
    
    public function __set($name, $value) {
        return $this->$name = $value;
    }
    
    public function __get($name) {
        return $this->$name;
    }
}
