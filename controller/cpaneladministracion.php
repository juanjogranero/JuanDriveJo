<?php
/**
 * Se comprueba si el usuario esta establecido en la sesion, si es
 * así, se comprueba que sea administrador, si se cumple esto,
 * se llama al layout para que muestre la vista de panel de administracion, de otra forma,
 * se redirige al index.php para que controle lo que hay que hacer
 */
if (!isset($_SESSION['usuario'])) {
    header("Location: index.php");
} else {
    if ($_SESSION['usuario']->getPerfil()=="administrador") {
        $_SESSION["datosAdministracionUsuarios"]=Usuario::obtenerDatosAdministracion();
        $_SESSION["datosAdministracionNavegadores"]=Usuario::obtenerDatosAdministracionNavegadores();
        $_SESSION["datosAdministracionFicheros"]=Fichero::obtenerDatosAdministracion();
        $_GET['pagina'] = "panelAdministracion";
        require_once 'view/layout.php';
    }
}

?>