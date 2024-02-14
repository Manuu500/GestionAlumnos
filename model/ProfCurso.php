<?php

class ProfCurso {

    private $dni_p;
    private $id_curso;
    private $nombre;
    private $apellidos;
    private $pass;
    private $bloqueado;
    private $hora_bloqueo;
    private $intentos;
    private $descripcion;
    private $totalpartes;
    
    public function __construct($dni, $id, $nom, $apel, $pass, $bloq, $hora, $inten, $desc, $totalp) {
        $this->dni_p = $dni;
        $this->id_curso = $id;
        $this->nombre = $nom;
        $this->apellidos = $apel;
        $this->pass = $pass;
        $this->bloqueado = $bloq;
        $this->hora_bloqueo = $hora;
        $this->intentos = $inten;
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
