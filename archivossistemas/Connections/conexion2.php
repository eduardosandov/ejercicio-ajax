<?php
class Conexion{
    public static function conectar(){
        $conexion = new mysqli('localhost','root','','bdteso2021');
        $conexion->set_charset('utf8');
        return $conexion;
    }
}
?>