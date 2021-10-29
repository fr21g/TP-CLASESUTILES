<?php 
function data_submitted() {
    $_AAux= array();
    if (!empty($_POST))
        $_AAux =$_POST;
        else
            if(!empty($_GET)) {
                $_AAux =$_GET;
            }
        if (count($_AAux)){
            foreach ($_AAux as $indice => $valor) {
                if ($valor=="")
                    $_AAux[$indice] = 'null' ;
            }
        }
        return $_AAux;
        
}

function verEstructura($e){
    echo "<pre>";
    print_r($e);
    echo "</pre>"; 
}
// Creamos las cabezeras que forzaran la descarga del archivo como archivo zip.
/*function download_file($archivo, $downloadfilename = null){

    if (file_exists($archivo)) {
        $downloadfilename = $downloadfilename !== null ? $downloadfilename : basename($archivo);
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename=' . $downloadfilename);
        header('Content-Transfer-Encoding: binary');
        header('Expires: 0');
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Pragma: public');
        header('Content-Length: ' . filesize($archivo));

        ob_clean();
        flush();
        readfile($archivo);
        unlink($archivo);//Destruye el archivo temporal
        exit;
    }
 
}*/

spl_autoload_register(function ($class_name){
    //echo "class ".$class_name ;
    $directorys = array(
        $GLOBALS['ROOT'].'Modelo/',
        $GLOBALS['ROOT'].'Modelo/conector/',
        $GLOBALS['ROOT'].'Modelo/orm/',
        $GLOBALS['ROOT'].'Control/',
        $GLOBALS['ROOT'].'util/',
      //  $GLOBALS['ROOT'].'util/class/',
    );
    //print_object($directorys) ;
    foreach($directorys as $directory){
        if(file_exists($directory.$class_name . '.php')){
            // echo "se incluyo".$directory.$class_name . '.php';
            require_once($directory.$class_name . '.php');
            return;
        }
    }


})







?>