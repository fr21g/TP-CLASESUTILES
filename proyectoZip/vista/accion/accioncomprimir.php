    
<?php
include_once ('../../configuracion.php');
include_once('../estructura/cabecera.php');
?>
<?php

if (isset($_POST['submit'])) {
    $secret = "6LfBw_ccAAAAAJTjRoBtewy4eV1kMifEG1T3Zc7K";
    $response = $_POST['g-recaptcha-response'];
    $remoteip = $_SERVER['REMOTE_ADDR'];
    $url = "https://www.google.com/recaptcha/api/siteverify?secret=$secret&response=$response&remoteip=$remoteip";
    $data = file_get_contents($url);
    $row = json_decode($data, true);

    if ($row['success'] == 'true') {
        echo "Wow no eres un robot! 😲<br>";
        
        $file=$_FILES['miArchivo'];
        $name=$file['name'];
        $directorio = "../../uploads/";
        copy($file['tmp_name'], $directorio.$name);
        $archivo=$directorio.$name;
       
        // Creamos y abrimos un archivo zip temporal
        $zip= new ClaseZip();
        if($zip->crearZip($directorio."miarchivo.zip")){
  
        // Añadimos un archivo en la raid del zip.
            $zip->agregarAzip($archivo,$name);
          
        // Una vez añadido los archivos deseados cerramos el zip.
            $zip->cerrarZip();
            $descargar="miarchivo.zip";
            if(isset($descargar)){
                echo "El archivo ".$name." se a comprimido con exito!";
                echo "<b><a href='../../control/descargar.php?file=$descargar'>Descargar Archivo</a></b>";
            }else{
                echo "error";
            }
        }else{
            echo "Se ha presentado un error al crear el archivo ".$archivo;
        }

        $datos=array();
        $datos['nombre']=$name;
        $datos['tipo']=$file['type'];
        $datos['descripcion']=$file['tmp_name'];

        $registronuevo= new Abmregistro();
        if($registronuevo->alta($datos)){
            echo "Nuevo archivo registrado<br>";
        }else{
            echo "No se pudo registrar el nuevo comprimido";
        }
    } else {
        header('location:../cliente/cargararchivo.php?false');
        //echo "Oops eres un robot 😡";
    }
}else{
    header('location:../cliente/cargararchivo.php');
}



echo "<br><div><a href='#' onClick='history.go(-1)'>Volver</a></div>";
?>
<?php
include_once('../estructura/pie.php');
?>
