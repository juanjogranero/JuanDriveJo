<?php
/**
 * Si el usuario le da al botón de salir,
 * se cierra la sesion y se redirige al controlador
 * principal
 */
if (isset($_GET["opcion"]) && $_GET["opcion"] == "salir") {
    unset($_SESSION['usuario']);
    unset($_SESSION["ficherosUsuario"]);
    session_destroy();
    header("Location: index.php");
}
/**
 * Se comprueba si el usuario esta establecido en la sesion, si es
 * así, se llama al layout para que muestre la vista de inicio, de otra forma,
 * se redirige al index.php para que controle lo que hay que hacer
 */
if (!isset($_SESSION['usuario'])) {
    header("Location: index.php");
} else {
    if (isset($_GET["pagina"]) && $_GET["pagina"] != "inicio") {
        include_once $controladores[$_GET["pagina"]];
    } else {
        //carga de ficheros del usuario
        $_SESSION["ficherosUsuario"] = Fichero::mostrarFichero($_SESSION["usuario"]->getCodUsuario());
        //si se busca un fichero empieza esta secuencia
        if (isset($_POST["busqueda"])) {
            $_SESSION["ficherosUsuario"] = Fichero::mostrarFicheroBusqueda($_SESSION["usuario"]->getCodUsuario(), $_POST["textoBusqueda"]);
        }
        $_GET["pagina"] = "inicio";
        include_once 'view/layout.php';
    }
}

?>