<?php
$entradaOK = true;
$mensajeError = array(
    "errorNombreUsuario" => '',
    "errorPassword" => '',
    "errorCoincidencia" => ''
);
if (isset($_POST['Aceptar'])) {//Si se pulsa el boton de Aceptar se valida el usuario.
    $mensajeError["errorNombreUsuario"] = comprobarTexto($_POST['nombreUsuario'], 10, 1, 1);
    $mensajeError["errorPassword"] = comprobarAlfaNumerico($_POST['passwordUsuario'], 10, 1, 1);
    $nombreUsuario = $_POST['nombreUsuario'];
    $password = hash('sha256', $_POST['passwordUsuario']);
    $usuario = Usuario::validarUsuario($nombreUsuario, $password);

    if (is_null($usuario)) {//Si el usuario devuelto es null se muestra un mensaje por pantalla.
        $mensajeError["errorCoincidencia"] = 'El nombre o la contraseña son incorrectos';
    }
    //Bucle que recorre el array mensajeError, si hay algun mensaje la variable entradaOK cambia a false.
    foreach ($mensajeError as $valor) {
        if ($valor != null) {
            $entradaOK = false;
        }
    }
}
if (isset($_POST['Aceptar']) && $entradaOK) {
    $_SESSION['usuario'] = $usuario;
    header("Location: index.php");
} else {
    $_GET['pagina'] = 'login';
    require_once('view/layout.php');
}

?>