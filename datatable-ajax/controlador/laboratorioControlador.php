<?php
include '../modelo/laboratorio.php';
$laboratorio = new laboratorio();

if($_POST['funcion']=="listar"){
    $laboratorio->mostrar();
    $json = array();
    foreach ($laboratorio->laboratorios as $data){
        $json['data'][]=$data;
    }
    $jsonstring = json_encode($json);
    echo $jsonstring;
}


if($_POST['funcion']=="editar"){
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $laboratorio->editar($id,$nombre);
}