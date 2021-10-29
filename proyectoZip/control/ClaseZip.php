<?php

class ClaseZip{

/*

metodos para comprimir archivos zip con la clase ZipArchive

*/
private $zip;

public function __construct()
{
    $this->zip= new ZipArchive;
}
public function getZip(){
    return $this->zip;
}


public function crearZip($nombre){

    $crearzip=$this->getZip()->open($nombre,$this->getZip()::CREATE);

return $crearzip;

}

public function agregarAzip($archivo,$nombre2){
$agregar=$this->getZip();
$agregar->addFile($archivo,$nombre2);
return $agregar;

}

public function cerrarZip(){
$zip=$this->getZip();
return $zip->close();

}




}




?>