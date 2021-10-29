<?php
include_once("../estructura/cabecera.php");
include_once("../../configuracion.php");


$objRegistro = new ABMregistro();
$registro=$objRegistro->buscar(null);

?>
 
    <h2>REGISTRO DE ARCHIVOS</h2>
    <p class="lead">
    <table border=1>
                <?php	
        
        if(count($registro)>0){
            echo 
            '<tr>
                <th>id</th><th>Nombre</th><th>Tipo</th><th>Descripcion</th><th>Fecha Comprimido</th><th>Eliminar</th>
            </tr>'; 
            
            foreach($registro as $objR){
                $id = $objR->getIdarchivo();
                $nombre = $objR->getNombre();
                $tipo = $objR->getTipo();
                $descripcion = $objR->getDescripcion();
                $fecha = $objR->getFechacomprimido();
                
                echo 
                '<tr>
                    <td>'.$id.'</td>
                    <td>'.$nombre.'</td>
                    <td>'.$tipo.'</td>
                    <td>'.$descripcion.'</td>
                    <td>'.$fecha.'</td>
                    <td> <a href="../accion/eliminarregistro.php?id='.$id.'"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path fill-rule="evenodd" d="M16 1.75V3h5.25a.75.75 0 010 1.5H2.75a.75.75 0 010-1.5H8V1.75C8 .784 8.784 0 9.75 0h4.5C15.216 0 16 .784 16 1.75zm-6.5 0a.25.25 0 01.25-.25h4.5a.25.25 0 01.25.25V3h-5V1.75z"></path><path d="M4.997 6.178a.75.75 0 10-1.493.144L4.916 20.92a1.75 1.75 0 001.742 1.58h10.684a1.75 1.75 0 001.742-1.581l1.413-14.597a.75.75 0 00-1.494-.144l-1.412 14.596a.25.25 0 01-.249.226H6.658a.25.25 0 01-.249-.226L4.997 6.178z"></path><path d="M9.206 7.501a.75.75 0 01.793.705l.5 8.5A.75.75 0 119 16.794l-.5-8.5a.75.75 0 01.705-.793zm6.293.793A.75.75 0 1014 8.206l-.5 8.5a.75.75 0 001.498.088l.5-8.5z"></path></svg></a></td>
                    <td><ion-icon name="close-circle-outline"></ion-icon></td>
                </tr>';
            }
        }else{
            echo 'No hay usuarios activos';
        }
        ?>
        </table>
    </p>

    
<?php


include_once("../estructura/pie.php");?>