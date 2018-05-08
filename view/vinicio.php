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
        <form action="core/uploadArchivos.php" id="formSubida" class="dropzone"></form>
    </div>';
        }
    } else {
        echo '<div class="col-sm-12">
        <form action="core/uploadArchivos.php" id="formSubida" class="dropzone"></form>
    </div>';
    } ?>
</div>
<div class="container">
    <?php
    //Mostrar archivos
    if (isset($_SESSION["ficherosUsuario"])) {
        foreach ($_SESSION["ficherosUsuario"] as &$valor) {

            echo '<a href="' . PATHDIRECTORIOFICHEROSUSUARIOS . $_SESSION["usuario"]->getCodUsuario() . "/archivos/" . $valor["nombreFichero"] . '" download>';
            echo '<div class="col-sm-2 mostrarFicherosEnlace" style="text-align: center;height: 150px; margin-top: 2%;">';
            if (substr($valor["tipoDeArchivo"], 0, 5) == "image") {
                echo "<img src='" . PATHDIRECTORIOFICHEROSUSUARIOS . $_SESSION["usuario"]->getCodUsuario() . "/archivos/" . $valor["nombreFichero"] . "' class='muestraFichero img-rounded'>";
            } else {
                echo "<img src='" . PATHIMAGENES . "logo.png' class='muestraFichero img-rounded'>";
            }
            echo '<p style="word-wrap: break-word;">' . $valor["nombreFichero"] . '</p>';
            echo '<p style="word-wrap: break-word;">' . $valor["tamanioFichero"] . ' Kb</p>';
            echo '</div>';
            echo '</a>';
            echo '<div class="col-sm-1" style="text-align: left;">';
            echo '<a href="#">
                     <span class="glyphicon glyphicon-remove" onclick="eliminarArchivo('.$valor["codFichero"].','.$valor["tamanioFichero"].')"></span>
                   </a>';
            echo '</div>';
        };
    } elseif (isset($_POST["busqueda"])) {//Si se busca un archivo y no se encuentra entra aqui
        echo '<div class="col-sm-12" style="text-align: center;">';
        echo '<span class="glyphicon glyphicon-floppy-remove iconoNoEncontrado"></span><br>';
        echo '<h1>No hemos encontrado ningun resultado </h1>';
        echo '</div>';
    } else {//Si no se ha subido ningun archivo sale este mensaje
        echo '<div class="col-sm-12" style="text-align: left; margin-top: 2%;">';
        echo '<span class="glyphicon glyphicon-arrow-up fechaSubida"></span><br>';
        echo '</div>';
        echo '<div class="col-sm-12" style="text-align: center;">';
        echo '<h1>Todavía no has subido ningun archivo, prueba a arrastrar un archivo</h1>';
        echo '</div>';
    } ?>
</div>

<!--Este parrafo sirve para comprobar desde la libreria de dropzone el tamaño restante permitido para el usuario-->
<p style="visibility: hidden;" id="tamanioPermitido">
    <?php
    if ($_SESSION["usuario"]->getTamanioOcupado() > 0) {
        echo $_SESSION["usuario"]->getTamanioPermitido() * 1024 - $_SESSION["usuario"]->getTamanioOcupado();
    } else {
        echo $_SESSION["usuario"]->getTamanioPermitido() * 1024;
    }
    ?>
</p>
<script src="webroot/js/subidaArchivosInicio.js"></script>