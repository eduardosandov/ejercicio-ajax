<?php
include_once 'conexion.php';
class laboratorio{
    var $laboratorios;
    public function __construct(){
        $this->acceso = conexion::conectar();
    }
    function mostrar(){
        $sql="SELECT * FROM laboratorio";
        $resultado = $this->acceso->query($sql);
        $this->laboratorios = $resultado->fetch_all(MYSQLI_ASSOC);
        return $this->laboratorios;
    }
}
?>