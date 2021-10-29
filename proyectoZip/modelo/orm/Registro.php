<?php
class Registro{

    private $idarchivo;
    private $nombre;
    private $tipo;
    private $descripcion;
    private $fechacomprimido;
    private $mensajeoperacion;

    public function __construct(){
        $this->idarchivo="";
        $this->nombre="";
        $this->tipo="";
        $this->descripcion="";
        $this->fechacomprimido="";
        $this->mensajeoperacion="";        
    }

    public function getIdarchivo(){
        return $this->idarchivo;
    }
    public function setIdarchivo($idarchivo){
        $this->idarchivo = $idarchivo;
    }

    public function getNombre(){
        return $this->nombre;
    }
    public function setNombre($nombre){
        $this->nombre = $nombre;
    }

    public function getTipo(){
        return $this->tipo;
    }
    public function setTipo($tipo){
        $this->tipo = $tipo;
    }

    public function getDescripcion(){
        return $this->descripcion;
    }
    public function setDescripcion($descripcion){
        $this->descripcion = $descripcion;
    }

    public function getFechacomprimido(){
        return $this->fechacomprimido;
    }
    public function setFechacomprimido($fechacomprimido){
        $this->fechacomprimido = $fechacomprimido;
    }

    public function getMensajeoperacion(){
        return $this->mensajeoperacion;
    }
    public function setMensajeoperacion($mensajeoperacion){
        $this->mensajeoperacion = $mensajeoperacion;

    }

    public function setear($idarchivo,$nombre,$tipo,$descripcion,$fechacomprimido){
        $this->setIdarchivo($idarchivo);
        $this->setNombre($nombre);
        $this->setTipo($tipo);
        $this->setDescripcion($descripcion);
        $this->setFechacomprimido($fechacomprimido);

    }


    public function cargar(){
        $resp = false;
        $base=new BaseDatos();
        $sql="SELECT * FROM registo WHERE idarchivo = ".$this->getIdarchivo();
        if ($base->Iniciar()) {
            $res = $base->Ejecutar($sql);
            if($res>-1){
                if($res>0){
                    $row = $base->Registro();
                    $this->setear($row['idarchivo'], $row['nombre'], $row['tipo'], $row['descripcion'], $row['fechacomprimido']);
                    $resp=true;
                }
            }
        } else {
            $this->setmensajeoperacion("registro->listar: ".$base->getError());
        }
        return $resp;
    }

    public function insertar(){
        $resp = false;
        $base=new BaseDatos();
        $sql="INSERT INTO registro(idarchivo,nombre,tipo,descripcion)
            VALUES('".$this->getIdarchivo()."','".$this->getNombre()."','".$this->getTipo()."','".$this->getDescripcion()."' )";
            if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
            
                $resp = true;
            } else {
                $this->setmensajeoperacion("registro->insertar: ".$base->getError());
            }
        } else {
            $this->setmensajeoperacion("registro->insertar: ".$base->getError());
        }
        return $resp;
    }
    
    public function modificar(){
        $resp = false;
        $base=new BaseDatos();
        $sql="UPDATE registro SET idarchivo='".$this->getIdarchivo()."',nombre='".$this->getNombre().
        "',tipo='".$this->getTipo()."',descripcion='".$this->getDescripcion()."',fechacomprimido='".$this->getFechacomprimido()."'
        WHERE idarchivo='".$this->getIdarchivo()."'";
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                $resp = true;
            } else {
                $this->setmensajeoperacion("registro->modificar: ".$base->getError());
            }
        } else {
            $this->setmensajeoperacion("registro->modificar: ".$base->getError());
        }
        return $resp;
    }
    
    
    public function eliminar(){
        $resp = false;
        $base=new BaseDatos();
        $sql="DELETE FROM registro WHERE idarchivo=".$this->getIdarchivo();
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                return true;
            } else {
                $this->setmensajeoperacion("registro->eliminar: ".$base->getError());
            }
        } else {
            $this->setmensajeoperacion("registro->eliminar: ".$base->getError());
        }
        return $resp;
    }
    
    public static function listar($parametro){
        $arreglo = array();
        $base=new BaseDatos();
        $sql="SELECT * FROM registro ";
        
        if ($parametro!="") {
            $sql.='WHERE '.$parametro;
        }
        $res = $base->Ejecutar($sql);
        if($res>-1){
            if($res>0){
                
                while ($row = $base->Registro()){
                    $obj= new Registro();
                    $obj->setear($row['idarchivo'], $row['nombre'], $row['tipo'],$row['descripcion'], $row['fechacomprimido']);
                    array_push($arreglo, $obj);
                }
    
            }
            
        } else {
            $this->setmensajeoperacion("registro->listar: ".$base->getError());
        }
    
        return $arreglo;
    }


}


?>