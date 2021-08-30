<?php
include '../modelo/almacen-modelo.php';
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
    $idbien = $_POST['idbien'];
    $codbieninv = $_POST['codbieninv'];
    $nombien = $_POST['nombien'];
    $codmarca = $_POST['codmarca'];
    $codmodelo = $_POST['codmodelo'];
    $accesorios = $_POST['accesorios'];
    $observaciones = $_POST['observaciones'];
    $lugar = $_POST['lugar'];
    $laboratorio->editar($idbien,$accesorios,$observaciones,$lugar);
}