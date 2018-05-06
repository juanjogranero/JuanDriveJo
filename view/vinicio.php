<div class="container">

    <div class="col-sm-12">
        <button id="subidaArchivosBoton" <?php if ($_SESSION["usuario"]->getTamanioOcupado() > 0) {
            if ($_SESSION["usuario"]->getTamanioOcupado() / 1024 > $_SESSION["usuario"]->getTamanioPermitido()) {
                echo 'class="btn btn-danger" disabled';
            } else {
                echo 'class="btn btn-primary"';
            }
        } else {
            echo 'class="btn btn-primary"';
        } ?>>Subida de archivos
        </button>
    </div>

    <?php if ($_SESSION["usuario"]->getTamanioOcupado() > 0) {
        if ($_SESSION["usuario"]->getTamanioOcupado() / 1024 > $_SESSION["usuario"]->getTamanioPermitido()) {
            echo '<div class="col-sm-12"><div class="alert alert-danger">Tamaño maximo permitido excedido, por favor borra archivos si quieres subir nuevos.
</div></div>';
        } else {
            echo '<div class="col-sm-12">
        <form action="core/uploadArchivos.php" class="dropzone"></form>
    </div>';
        }
    } else {
        echo '<div class="col-sm-12">
        <form action="core/uploadArchivos.php" class="dropzone"></form>
    </div>';
    } ?>


    <div class="col-sm-12">

    </div>

</div>

<p style="visibility: hidden;" id="tamanioPermitido">
<?php
if ($_SESSION["usuario"]->getTamanioOcupado() > 0) {
        echo $_SESSION["usuario"]->getTamanioPermitido()*1024-$_SESSION["usuario"]->getTamanioOcupado();
}else{
    echo $_SESSION["usuario"]->getTamanioPermitido()*1024;
}
?>
</p>
<script src="webroot/js/subidaArchivosInicio.js"></script>