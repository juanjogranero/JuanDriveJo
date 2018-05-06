<?php
/**
 * Utilidad :
 * Creado por : Juan Jose Granero Omañas
 */
require_once '../model/Fichero.php';
require_once '../model/Usuario.php';
require_once '../config/DBconfig.php';
session_start();

if (!empty($_FILES)) {
    $nombreFichero=$_FILES['file']['name'];
    $tipoFichero=$_FILES['file']['type'];
    //Conversion a KB
    $tamanioFichero=round($_FILES['file']['size'] / 1024);
    $usuarioPropietario=$_COOKIE["codUsuario"];
    $tempFile = $_FILES['file']['tmp_name'];
    $targetFile = $_COOKIE["rutaSubidaArchivos"] . $_FILES['file']['name'];
    if (move_uploaded_file($tempFile, $targetFile)){
        Fichero::subirFichero($nombreFichero,$tipoFichero,$tamanioFichero,"",0,$usuarioPropietario);
        Usuario::accionFichero($usuarioPropietario, $tamanioFichero, "subirFichero");
    }
}


?>