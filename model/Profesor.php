<?php

class Profesor{
    
    private $dni_p;
    private $nombre;
    private $apellidos;
    private $pass;
    private $bloqueado;
    private $hora_bloqueo;
    private $intentos;
    
    public function __construct($dni, $nom, $apel, $pass, $bloq, $horaBloq, $inten) {
        $this->dni_p = $dni;
        $this->nombre = $nom;
        $this->apellidos = $apel;
        $this->pass = $pass;
        $this->bloqueado = $bloq;
        $this->hora_bloqueo = $horaBloq;
        $this->intentos = $inten;
    }
    
    public function __get($name) {
        return $this->$name;
    }
    
    
    public function __set($name, $value) {
        return $this->$name = $value;
    }
}

