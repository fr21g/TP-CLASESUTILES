<?php

class Abmregistro{

    private function cargarObjeto($param){
        $obj = null;
        
        if( array_key_exists('idarchivo', $param)
        and array_key_exists('nombre',$param)
        and array_key_exists('tipo',$param)
        and array_key_exists('descripcion',$param)){
            $obj = new Registro();
            $obj->setear($param['idarchivo'],$param['nombre'],$param['tipo'],$param['descripcion'], "");
        }
        return $obj;
    }
    
    /**
     * Espera como parametro un arreglo asociativo donde las claves coinciden con los nombres
     *  de las variables instancias del objeto que son claves
     * @param array $param
     * @return Registro
     */
    private function cargarObjetoConClave($param){
        $obj = null;
        
        if( isset($param['idarchivo']) ){
            $obj = new Registro();
            $obj->setear($param['idarchivo'],null,null,null,null);
        }
        return $obj;
    }
    
    
    /**
     * Corrobora que dentro del arreglo asociativo estan seteados los campos claves
     * @param array $param
     * @return boolean
     */
    
    private function seteadosCamposClaves($param){
        $resp = false;
        if (isset($param['idarchivo']))
            $resp = true;
        return $resp;
    }
    
    /**
     * 
     * @param array $param
     */
    public function alta($param){
        $resp = false;
        $param['idarchivo'] =null;
        $elObjtTabla = $this->cargarObjeto($param);
//        verEstructura($elObjtTabla);
        if ($elObjtTabla!=null and $elObjtTabla->insertar()){
            $resp = true;
        }
        return $resp;
        
    }
    /**
     * permite eliminar un objeto 
     * @param array $param
     * @return boolean
     */
    public function baja($param){
        $resp = false;
        if ($this->seteadosCamposClaves($param)){
            $elObjtTabla = $this->cargarObjetoConClave($param);
            if ($elObjtTabla!=null and $elObjtTabla->eliminar()){
                $resp = true;
            }
        }
        
        return $resp;
    }
    
    /**
     * permite modificar un objeto
     * @param array $param
     * @return boolean
     */
    public function modificacion($param){
    
        $resp = false;
        if ($this->seteadosCamposClaves($param)){
            $elObjtTabla = $this->cargarObjeto($param);
            if($elObjtTabla!=null and $elObjtTabla->modificar()){
                $resp = true;
            }
        }
        return $resp;
    }
    
    /**
     * permite buscar un objeto
     * @param array $param
     * @return 
     */
    public function buscar($param){
        $where = " true ";
        if ($param<>NULL){
            if  (isset($param['idarchivo']))
                $where.=" and idarchivo =".$param['idarchivo'];
            if  (isset($param['nombre']))
                $where.=" and nombre ='".$param['nombre']."'";
            if  (isset($param['tipo']))
                $where.=" and tipo ='".$param['tipo']."'";
            if  (isset($param['descripcion']))
                $where.=" and descripcion ='".$param['descripcion']."'";
            if  (isset($param['fechacomprimido']))
                $where.=" and fechacomprimido ='".$param['fechacomprimido']."'";
        }
        $arreglo = Registro::listar($where);
        return $arreglo;
    }


}



?>