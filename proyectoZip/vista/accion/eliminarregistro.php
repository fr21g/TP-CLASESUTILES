<?php
include_once('../../configuracion.php');
include_once("../estructura/cabecera.php");

$datos = data_submitted();

$registro = new ABMregistro();

$filtro = [];
$filtro['idarchivo'] = $datos['id'];
$objRegistro = $registro->buscar($filtro);
$existeRegistro = false;
if(count($objRegistro)>0){
    $existeRegistro = true;
    $datos = [];
    $datos['idarchivo'] = $filtro['idarchivo'];
}
if($existeRegistro){
    if($registro->baja($datos)){
        echo "se elimino el archivo";
    }else{
        echo "no se pudo eliminar el archivo";
    }
}else{
    echo "El archivo no existe!";
}
echo "<div><a href=../cliente/verregistro.php>VOLVER</a></div>";


include_once("../estructura/pie.php");
?>