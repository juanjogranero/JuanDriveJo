<?php
// Funciones de Validación
// Blibioteca con funciones de validación
// Función para comprobar si es un campo solo texto
// Return null es correcto, si no muestra el mensaje de error
// Si es un 1 es obligatorio, si es un 0 no lo es
function comprobarTexto($cadena,$maxTamanio,$minTamanio,$obligatorio){
    // Patrón para campos de solo texto
    $patron_texto = "/^[a-zA-ZáéíóúÁÉÍÓÚäëïöüÄËÏÖÜàèìòùÀÈÌÒÙ\s]+$/";
    $cadena=htmlspecialchars(strip_tags(trim((string)$cadena)));
    $correcto=null;

    if( preg_match($patron_texto, $cadena) && comprobarNoVacio((string)$cadena) && comprobarMaxTamanio((string)$cadena,$maxTamanio) && comprobarMinTamanio((string)$cadena,$minTamanio) )
    {
        $correcto = null;
    }else{
        $correcto="Error </br>";
    }
    if(!preg_match($patron_texto, $cadena)){
        $correcto.="Tiene que ser una cadena</br>";
    }
    if (comprobarNoVacio((string)$cadena)==false){
        $correcto.= "Campo Vacio</br>";
    }
    if (comprobarMaxTamanio((string)$cadena,$maxTamanio)==false){
        $correcto .="El tamaño maximo es ".$maxTamanio."</br>"  ;
    }
    if (comprobarMinTamanio((string)$cadena,$minTamanio)==false){
        $correcto.="El tamaño minimo es ".$minTamanio."</br>" ;
    }
    if (empty($cadena) && $obligatorio==0){
        $correcto=null;
    }
    return $correcto;
}
function comprobarCodigo($cadena,$maxTamanio,$minTamanio,$obligatorio){
    // Patrón para campos de solo texto
    $patron_texto = "/^[a-zA-Z]+$/";
    $cadena=htmlspecialchars(strip_tags(trim((string)$cadena)));
    $correcto=null;

    if( preg_match($patron_texto, $cadena) && comprobarNoVacio((string)$cadena) && comprobarMaxTamanio((string)$cadena,$maxTamanio) && comprobarMinTamanio((string)$cadena,$minTamanio) )
    {
        $correcto = null;
    }else{
        $correcto="Error ";
    }
    if(!preg_match($patron_texto, $cadena)){
        $correcto.=" Solo pueden ser letras";
    }
    if (comprobarNoVacio((string)$cadena)==false){
        $correcto.= " campo Vacio";
    }
    if (comprobarMaxTamanio((string)$cadena,$maxTamanio)==false){
        $correcto .=" El tamaño maximo es ".$maxTamanio ;
    }
    if (comprobarMinTamanio((string)$cadena,$minTamanio)==false){
        $correcto.=" El tamaño minimo es ".$minTamanio;
    }
    if (empty($cadena) && $obligatorio==0){
        $correcto=null;
    }
    return $correcto;
}
// Función para comprobar un campo AlfaNumerico
// Return null es correcto, si no muestra el mensaje de error
// Si es un 1 es obligatorio, si es un 0 no lo es
function comprobarAlfaNumerico($cadena,$maxTamanio,$minTamanio,$obligatorio){
    $cadena=htmlspecialchars(strip_tags(trim((string)$cadena)));
    $correcto =null;

    if (comprobarNoVacio((string)$cadena) && comprobarMaxTamanio((string)$cadena,$maxTamanio) && comprobarMinTamanio((string)$cadena,$minTamanio)){
        $correcto =null;
    }else{
        $correcto="Error ";
    }
    if (comprobarNoVacio((string)$cadena)==false){
        $correcto.= "campo Vacio";
    }
    if (comprobarMaxTamanio((string)$cadena,$maxTamanio)==false)  {
        $correcto .=" El tamaño maximo es ".$maxTamanio ;
    }
    if (comprobarMinTamanio((string)$cadena,$minTamanio)==false){
        $correcto.=" El tamaño minimo es ".$minTamanio;
    }
    if (empty($cadena) && $obligatorio==0){
        $correcto=null;
    }
    return $correcto;
}
// Función para comprobar si es un campo entero
// Return null es correcto, si no muestra el mensaje de error
// Si es un 1 es obligatorio, si es un 0 no lo es
function comprobarEntero($integer,$obligatorio){
    $correcto = null;

    if( filter_var($integer, FILTER_VALIDATE_INT) && comprobarNoVacio($integer)){
        $correcto = null;
    }else{
        $correcto="Error ";
    }
    if (!filter_var($integer, FILTER_VALIDATE_INT)){
        $correcto.= "no es un entero";
    }
    if (!comprobarNoVacio($integer)){
        $correcto.= " campo vacio";
    }
    if (empty($integer) && $obligatorio==0){
        $correcto=null;
    }
    return $correcto;
}
// Función para comprobar si es un campo float
// Return null es correcto, si no muestra el mensaje de error
// Si es un 1 es obligatorio, si es un 0 no lo es
function comprobarFloat($float,$obligatorio){
    $correcto = null;

    if (filter_var($float, FILTER_VALIDATE_FLOAT) && comprobarNoVacio($float)){
        $correcto= null;
    }else{
        $correcto="Error ";
    }
    if (!filter_var($float, FILTER_VALIDATE_FLOAT)){
        $correcto.=" float no valido";
    }
    if (!comprobarNoVacio($float)){
        $correcto.= "campo vacio";
    }
    if (empty($float) && $obligatorio==0){
        $correcto=null;
    }
    return $correcto;
}
// Función para comprobar si es un correo electronico
// Return null es correcto, si no muestra el mensaje de error
// Si es un 1 es obligatorio, si es un 0 no lo es
function validarEmail ($email,$maxTamanio,$minTamanio,$obligatorio){
    $correcto = null;

    if (filter_var($email, FILTER_VALIDATE_EMAIL) && comprobarNoVacio($email) && comprobarMaxTamanio($email,$maxTamanio) && comprobarMinTamanio($email,$minTamanio)){
        $correcto = null;
    }else{
        $correcto = "Error </br>";
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $correcto .= " correo no valido</br>";
    }
    if (!comprobarNoVacio($email)){
        $correcto.= " campo Vacio</br>";
    }
    if (!comprobarMaxTamanio($email,$maxTamanio)){
        $correcto .=" El tamaño maximo es ".$maxTamanio."</br>" ;
    }
    if (!comprobarMinTamanio($email,$minTamanio)){
        $correcto.=" El tamaño minimo es ".$minTamanio."</br>" ;
    }
    if (empty(htmlspecialchars(strip_tags(trim($email)))) && $obligatorio==0){
        $correcto=null;
    }
    return $correcto;
}
// Función para comprobar si es una url
// Return null es correcto, si no muestra el mensaje de error
// Si es un 1 es obligatorio, si es un 0 no lo es
function validarURL ($url,$obligatorio){
    $correcto = null;

    if (filter_var ($url, FILTER_VALIDATE_URL)  && comprobarNoVacio($url)){
        $correcto = null;
    }else {
        $correcto = "Error ";
    }
    if (!filter_var ($url, FILTER_VALIDATE_URL)){
        $correcto .= " formato incorrecto de url";
    }
    if (!comprobarNoVacio($url)){
        $correcto.= " campo Vacio";
    }
    if (empty(htmlspecialchars(strip_tags(trim($url)))) && $obligatorio==0){
        $correcto=null;
    }
    return $correcto;
}



function validarFecha ($fecha,$obligatorio){
    $correcto = null;
    $fechaMinima="1900-01-01";
    $fechaMaxima=date("Y-m-d");

    if (validateDate($fecha) && comprobarNoVacio($fecha) && ($fecha>$fechaMinima) && ($fecha<$fechaMaxima)){
        $correcto = null;
    }else {
        $correcto = "Error ";
    }
    if (!validateDate($fecha, 'Y-m-d')){
        $correcto .= " formato incorrecto de fecha (Año-Mes-dia)";
    }
    if ($fecha < $fechaMinima){
        $correcto .= " la fecha tiene que ser superior a $fechaMinima";
    }
    if ($fecha > $fechaMaxima){
        $correcto .= " la fecha tiene que ser inferior a $fechaMaxima";
    }
    if (empty(htmlspecialchars(strip_tags(trim($fecha)))) && $obligatorio==0){
        $correcto=null;
    }
    return $correcto;
}
// Función para validar si no esta vacio
// Return false esta vacio, true no esta vacio
function comprobarNoVacio($cadena){
    $correcto = false;
    $cadena=htmlspecialchars(strip_tags(trim($cadena)));
    if (!empty($cadena)){
        $correcto=true;
    }
    return $correcto;
}
// Función para tamaño maximo
// Si tamaño es 0 significa que no tiene limite
// Return false no es correcto, true es correcta
function comprobarMaxTamanio ($cadena,$tamanio){
    $correcto= false;
    if ((strlen($cadena))<=$tamanio || $tamanio==0){
        $correcto=true;
    }
    return $correcto;
}
// Función para tamaño minimo
// Si el tamaño es 0 significa que no tiene limite
// Return false no es correcto, true es correcta
function comprobarMinTamanio ($cadena,$tamanio){
    $correcto= false;
    if (strlen($cadena)>=$tamanio || $tamanio==0){
        $correcto=true;
    }
    return $correcto;
}
// Función para validar la fecha
// Recibe una fecha y un formato el por defecto es año-mes-dia
// Devuelve True si es una fecha valida y un false si no la es
function validateDate($date, $format = 'Y-m-d'){
    $d = DateTime::createFromFormat($format, $date);
    return $d && $d->format($format) == $date;
}
?>