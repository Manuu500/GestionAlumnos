<?php
require_once 'Conexion.php';
require_once '../model/Alumno.php';

class controllerAlumno{
    
    public static function getAlumnos($curso){
        try{
            $conex = new Conexion();
            $result = $conex->query("SELECT * FROM alumnos a, curso c where a.id_curso = c.id_curso and c.descripcion = '$curso'");
            if($result->num_rows){
                $a = array();
                while($reg = $result->fetch_object()){
                    $a[] = new Alumno($reg->dni_a, $reg->nombre, $reg->apellidos, $reg->direccion, $reg->telf, $reg->id_curso, $reg->descripcion, $reg->totalpartes);
                }
                return $a;
            }
        } catch (Exception $ex) {
            die($ex->getMessage());
        }
    }
    
    
    public static function getAlumno($dni){
        try{
            $conex = new Conexion();
            $result = $conex->query("SELECT * FROM alumnos a, curso c WHERE c.id_curso = a.id_curso AND dni_a = '$dni'");
            if($result->num_rows){
                $reg = $result->fetch_object();
                $a = new Alumno($reg->dni_a, $reg->nombre, $reg->apellidos, $reg->direccion, $reg->telf, $reg->id_curso, $reg->descripcion, $reg->totalpartes);
                return $a;
            }
        } catch (Exception $ex) {
            die($ex->getMessage());
        }
    }
}

