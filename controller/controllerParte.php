<?php
require_once '../model/Partes.php';
require_once 'Conexion.php';

class controllerParte{
    
    public static function insertParte($dniP, $motivo, $dniA){
       try{
           $conex = new Conexion();
           $result = $conex->query("INSERT INTO partes (dni_p, dni_a, motivo, time) VALUES ('$dniP','$dniA','$motivo','".time()."')");
           return $result;
       } catch (Exception $ex) {
           die($ex->getMessage());
       } 
    }
    
    public static function getPartes($idUsu, $dniP){
        try{
            $conex = new Conexion();
            $result = $conex->query("SELECT * FROM alumnos a, partes p, profesores pr WHERE pr.dni_p = p.dni_p AND a.dni_a = p.dni_a AND a.dni_a = '$idUsu'");
            if($result->num_rows){
                $p = array();
                while($reg = $result->fetch_object()){
                    $p[] = new Partes($reg->id, $reg->dni_p, $reg->dni_a, $reg->motivo, $reg->time, $reg->nombre, $reg->apellidos);
                }
                return $p;
            }
        } catch (Exception $ex) {
            die($ex->getMessage());
        }
    }
    
    public static function deleteParte($id){
        try{
            $conex = new Conexion();
            $conex->query("DELETE FROM partes WHERE id = '$id'");
        } catch (Exception $ex) {
            die($ex->getMessage());
        }
    }
}
