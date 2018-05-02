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
    "errorDuplicado" => '',
    "errorSubida" => '',
    "errorArchivo" => ''
);
//Variables referentes a la subida de archivos
$tiposPermitidos = array("image/jpeg");
$tamanioPermitido = 524288;

//Obtencion del navegador que esta utilizando el usuario
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

    $mensajeError["errorEmailUsuario"] = validarEmail($_POST['emailUsuario'], 50, 1, 1);
    if ($_POST['passwordUsuario'] != "") {
        $mensajeError["errorPassword"] = comprobarAlfaNumerico($_POST['passwordUsuario'], 10, 1, 1);
        //Si las dos contraseñas no son iguales se guarda un mensaje de error
        if ($_POST['passwordUsuario'] != $_POST['password2Usuario']) {
            $mensajeError["errorDuplicado"] = "Las contraseñas no coinciden";
        }
    }
    if ($_FILES["imagenPerfilUsuario"]["tmp_name"] != "") {
        $rutaImagenPerfil = PATHIMAGENESPERFIL . $_SESSION["usuario"]->getCodUsuario().".jpg";
        //Subida  de la imagen de perfil
        if (is_null($mensajeError["errorArchivo"] = validarSubidaArchivos("imagenPerfilUsuario", $tiposPermitidos, $tamanioPermitido))) {
            if (!move_uploaded_file($_FILES["imagenPerfilUsuario"]["tmp_name"], $rutaImagenPerfil)) {
                $mensajeError["errorSubida"] = "Lo sentimos, ha ocurrido un error en la subida";
            }
        }
    }

    //Bucle que recorre el array mensajeError, si hay algun mensaje la variable entradaOK cambia a false.
    foreach ($mensajeError as $valor) {
        if ($valor != null) {
            $entradaOK = false;
        }
    }

}
if (isset($_POST['Aceptar']) && $entradaOK) {

    //validacion de campos
    if ($_POST['passwordUsuario'] != "") {
        $password = hash('sha256', $_POST['passwordUsuario']);
    } else {
        $password = $_SESSION["usuario"]->getPasswordUsuario();
    }
    if (isset($rutaImagenPerfil)) {
        $imagenPerfil = $rutaImagenPerfil;

        //Conversion de tamaño de imagen
        redimensionarImagenPerfil($imagenPerfil);

    } else {
        $imagenPerfil = $_SESSION["usuario"]->getImagenPerfil();
    }

    $_SESSION["usuario"]->editarUsuario($_POST['emailUsuario'], $password, $imagenPerfil);

    header("Location: index.php?pagina=perfil");

} else {//Si no se muestra el layout.
    $_GET['pagina'] = "perfil";
    require_once 'view/layout.php';
}
?>