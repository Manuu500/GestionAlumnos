<?php

require_once 'Conexion.php';
require_once '../model/Profesor.php';

class controllerProfesor {

    public static function login($usu, $clave) {
        try {
            $conex = new Conexion();
            $result = $conex->query("select * from profesores where dni_p = '$usu' and pass = '$clave'");
            if ($result->num_rows) {
                $reg = $result->fetch_object();
                $p = new Profesor($reg->dni_p, $reg->nombre, $reg->apellidos, $reg->pass, $reg->bloqueado, $reg->hora_bloqueo, $reg->intentos);
                return $p;
            }
        } catch (Exception $ex) {
            die($ex->getMessage());
        }
    }

    public static function getTeacher($usu) {
        try {
            $conex = new Conexion();
            $result = $conex->query("select * from profesores where dni_p = '$usu'");
            if($result->num_rows){
                $reg = $result->fetch_object();
                $p = new Profesor($reg->dni_p, $reg->nombre, $reg->apellidos, $reg->pass, $reg->bloqueado, $reg->hora_bloqueo, $reg->intentos);
                return $p;
            }
        } catch (Exception $ex) {
            die($ex->getMessage());
        }
    }
    
    public static function bloqueado($usu){
        try{
            $conex = new Conexion();
            $conex->query("UPDATE profesores SET bloqueado = 1 WHERE dni_p = '$usu'");
        } catch (Exception $ex) {
            die($ex->getMessage());
        }
    }
    
    public static function updateIntentosResta($usu){
        try{
            $conex = new Conexion();
            $conex->query("UPDATE profesores SET intentos = intentos - 1 WHERE dni_p = '$usu'");
        } catch (Exception $ex) {
            die($ex->getMessage());
        }
    }
    
     public static function updateIntentos($usu){
        try{
            $conex = new Conexion();
            $conex->query("UPDATE profesores SET intentos = 3 WHERE dni_p = '$usu'");
        } catch (Exception $ex) {
            die($ex->getMessage());
        }
    }
}
