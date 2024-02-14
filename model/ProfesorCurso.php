<?php

class ProfesorCurso{
    
    private $dni_p;
    private $id_curso;
    
    public function __construct($id, $id_curso) {
        $this->dni_p = $id;
        $this->id_curso = $id_curso;
    }
    
    public function __set($name, $value) {
        $this->$name = $value;
    }
    
    public function __get($name) {
        return $this->$name;
    }
}