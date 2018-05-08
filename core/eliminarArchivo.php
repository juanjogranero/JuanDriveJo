<?php
/**
 * Utilidad :
 * Creado por : Juan Jose Granero Omañas
 */
require_once '../model/Fichero.php';
require_once '../model/Usuario.php';
require_once '../config/DBconfig.php';
session_start();

if (isset($_GET["tamanioFicheroEliminar"]) && isset($_GET["codigoFicheroEliminar"])){
    Fichero::eliminarFichero($_SESSION["usuario"]->getCodUsuario(),$_GET["codigoFicheroEliminar"]);
    Usuario::accionFichero($_SESSION["usuario"]->getCodUsuario(), $_GET["tamanioFicheroEliminar"], "eliminarFichero");
    header("Location: ../index.php");
}

?>