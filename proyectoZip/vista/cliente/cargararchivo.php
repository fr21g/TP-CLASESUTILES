<?php
include_once("../../configuracion.php");
include_once('../estructura/cabecera.php');
?>

<!-- Google Recaptcha -->
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<div class="">
    <form  method="POST" class="needs-validation" action="../accion/accioncomprimir.php" enctype="multipart/form-data" novalidate>
        <div class="row">
            <div class="col">
                <input type="file" class ="form-control" name="miArchivo" id="miArchivo"  required>
                <div class="invalid-feedback">Seleccione un archivo por favor</div>
            </div>
            <!-- Google Recaptcha -->
            <div class="">
                <br><div class="g-recaptcha" data-sitekey="6LfBw_ccAAAAAAciXkMGPaHKD4oJDaQSFG0W3hsE"></div>
            </div>
            <div>
            <?php
            $datos = data_submitted();
            if(isset($datos['false'])){
                echo "Oops eres un robot 😡";
            }
            ?>
            </div><br>
            <div class="col-md-2">
                <input type="submit" name="submit" class="btn btn-success " value="Enviar">
            </div>
            <div class="col-md-1">
                <input type="reset" class="btn btn-danger " value="Limpiar">
            </div>
        </div>
    </form>
</div>

<?php
include_once('../estructura/pie.php');
?>
