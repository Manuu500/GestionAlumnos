<?php

class Curso {

    private $id_curso;
    private $descripcion;
    private $totalpartes;
    
    public function __construct($id = 0, $desc, $total) {
        $this->id_curso = $id;
        $this->descripcion = $desc;
        $this->totalpartes = $total;
    }
    
    public function __get($name) {
        return $this->$name;
    }
    
    public function __set($name, $value) {
        return $this->name = $value;
    }
}
