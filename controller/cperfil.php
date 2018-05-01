<?php
/**
 * Utilidad :
 * Creado por : Juan Jose Granero Omañas
 */
$entradaOK = true;
$navegadorUtilizado = '';
$navegadorUtilizadoNombre = '';
$mensajeError = array(
    "errorNombreUsuario" => '',
    "errorEmailUsuario" => '',
    "errorPassword" => '',
    "errorDuplicado" => ''
);
$user_agent = $_SERVER['HTTP_USER_AGENT'];
//Se guarda el navegador desde el que accede
if (strpos($user_agent, 'MSIE') !== FALSE) {
    $navegadorUtilizado = '/webroot/media/img/perfil/navegadorIE.png';
    $navegadorUtilizadoNombre = 'Internet Explorer';
} elseif (strpos($user_agent, 'Edge') !== FALSE) {
    $navegadorUtilizado = '/webroot/media/img/perfil/navegadorME.png';
    $navegadorUtilizadoNombre = 'Microsoft Edge';
} elseif (strpos($user_agent, 'Trident') !== FALSE) {
    $navegadorUtilizado = '/webroot/media/img/perfil/navegadorIE.png';
    $navegadorUtilizadoNombre = 'Internet Explorer';
} elseif (strpos($user_agent, 'Opera Mini') !== FALSE) {
    $navegadorUtilizado = '/webroot/media/img/perfil/navegadorOpera.png';
    $navegadorUtilizadoNombre = 'Opera Mini';
} elseif (strpos($user_agent, 'Opera') || strpos($user_agent, 'OPR') !== FALSE) {
    $navegadorUtilizado = '/webroot/media/img/perfil/navegadorOpera.png';
    $navegadorUtilizadoNombre = 'Opera';
} elseif (strpos($user_agent, 'Firefox') !== FALSE) {
    $navegadorUtilizado = '/webroot/media/img/perfil/navegadorFirefox.png';
    $navegadorUtilizadoNombre = 'Mozilla Firefox';
} elseif (strpos($user_agent, 'Chrome') !== FALSE) {
    $navegadorUtilizado = '/webroot/media/img/perfil/navegadorChrome.png';
    $navegadorUtilizadoNombre = 'Google Chrome';
} elseif (strpos($user_agent, 'Safari') !== FALSE) {
    $navegadorUtilizado = '/webroot/media/img/perfil/navegadorSafari.png';
    $navegadorUtilizadoNombre = 'Safari';
} else {
    $navegadorUtilizado = '/webroot/media/img/perfil/navegadorNE.png';
    $navegadorUtilizadoNombre = 'No Encontrado';
}
//Si se pulsa el boton de aceptar se procede a validar los datos del formulario.
if (isset($_POST['Aceptar'])) {
    //Si el metodo obtenerUsuarioDuplicado devuelve true es porque ya existe el usuario.
    if (Usuario::obtenerUsuarioDuplicado($_POST['nombreUsuario'])) {
        $mensajeError['errorNombreUsuario'] = 'Este usuario ya existe';
        //Si no se comprueban los requisitos del nombreusuario.
    } else {
        $mensajeError["errorNombreUsuario"] = comprobarTexto($_POST['nombreUsuario'], 10, 1, 1);
    }
    $mensajeError["errorEmailUsuario"] = validarEmail($_POST['emailUsuario'], 50, 1, 1);
    $mensajeError["errorPassword"] = comprobarAlfaNumerico($_POST['passwordUsuario'], 10, 1, 1);
    //Si las dos contraseñas no son iguales se guarda un mensaje de error
    if ($_POST['passwordUsuario'] != $_POST['password2Usuario']) {
        $mensajeError["errorDuplicado"] = "Las contraseñas no coinciden";
    }
    //Bucle que recorre el array mensajeError, si hay algun mensaje la variable entradaOK cambia a false.
    foreach ($mensajeError as $valor) {
        if ($valor != null) {
            $entradaOK = false;
        }
    }

}
if (isset($_POST['Aceptar']) && $entradaOK) {

    $password = hash('sha256', $_POST['passwordUsuario']);
    //Se llama al metodo que lo inserta en la base de datos.
    $usuario = Usuario::registrarUsuario($nombreUsuario, $password, $_POST['emailUsuario'], $navegadorUtilizado);
    //Si el usuario es null es porque ha habido errores.
    if (is_null($usuario)) {
        header("Location: index.php?pagina=registrar");
        //Si no es null es que se ha insertado, se guarda en la sesión y se redirige al index
    } else {
        $_SESSION['usuario'] = $usuario;
        header("Location: index.php");
    }
} else {//Si no se muestra el layout.
    $_GET['pagina'] = "perfil";
    require_once 'view/layout.php';
}
?>