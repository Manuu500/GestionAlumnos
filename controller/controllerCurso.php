<?php
require_once 'Conexion.php';
require_once '../model/ProfCurso.php';

class controllerCurso{
    
    public static function getTeacherCurso($dni) {
        try{
            $conex = new Conexion();
            $result = $conex->query("SELECT * FROM curso c, profesores p, prof_curso pp WHERE p.dni_p = pp.dni_p AND c.id_curso = pp.id_curso AND p.dni_p = '$dni'");
            if($result->num_rows){
                $c = array();
                while($reg = $result->fetch_object()){
                    $c[] = new ProfCurso($reg->dni_p, $reg->id_curso, $reg->nombre, $reg->apellidos, $reg->pass, $reg->bloqueado, $reg->hora_bloqueo, $reg->intentos, $reg->descripcion, $reg->totalpartes);
                }
                return $c;
            }
        } catch (Exception $ex) {
            die($ex->getMessage());
        }
    }
    
    public static function checkPartes($curso){
        try{
            $conex = new Conexion();
            $result = $conex->query("SELECT * FROM curso c, profesores p, prof_curso pp WHERE p.dni_p = pp.dni_p AND c.id_curso = pp.id_curso AND  c.descripcion = '$curso'");
            if($result->num_rows){
                $reg = $result->fetch_object();
                if($reg->totalpartes == 0){
                    return true;
                } else {
                    return false;
                }
            }
        } catch (Exception $ex) {
            die($ex->getMessage());
        }
    }
}

