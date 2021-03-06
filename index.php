<?php
require_once 'model/Usuario.php';
require_once 'model/Fichero.php';
require_once 'config/DBconfig.php';
require_once 'core/LibreriaValidacion.php';
require_once 'config/configuracion.php';
require_once 'core/libreriaArchivos.php';
session_start();//Se inicia la sesion o si existe se recupera

if (isset($_SESSION['usuario'])) {
    if ($_SESSION['usuario']->getBloqueo()) {
        echo "<script>alert('Lo sentimos, esta cuenta esta bloqueada y no puede acceder a ella ')</script>";
    } else {
        setcookie("rutaSubidaArchivos", PATHAPACHE . PATHDIRECTORIOFICHEROSUSUARIOS . $_SESSION["usuario"]->getCodUsuario() . "/archivos/", time() + (86400 * 30), "/");
        setcookie("codUsuario", $_SESSION["usuario"]->getCodUsuario(), time() + (86400 * 30), "/");
        include_once $controladores["inicio"];
    }
} else {
    if (isset($_GET['pagina']) && isset($controladores[$_GET["pagina"]])) {
        include_once $controladores[$_GET["pagina"]];
    } else {
        include_once $controladores["registrar"];
    }
}
?>