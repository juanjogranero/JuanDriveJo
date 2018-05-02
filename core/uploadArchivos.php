<?php
/**
 * Utilidad :
 * Creado por : Juan Jose Granero Omañas
 */

//$storeFolder = PATHDIRECTORIOFICHEROSUSUARIOS . $_SESSION["usuario"]->getCodUsuario() . '/archivos/';
//
//if (!empty($_FILES)) {
//
//    $tempFile = $_FILES['file']['tmp_name'];
//
//    $targetFile = $storeFolder . $_SESSION["usuario"]->getCodUsuario().".jpg";
//
//    move_uploaded_file($tempFile, $targetFile);
//}

$ds          = "/";  //1

$storeFolder =  $_SESSION["usuario"]->getCodUsuario() . '/archivos';   //2

if (!empty($_FILES)) {

    $tempFile = $_FILES['file']['tmp_name'];          //3

    $targetPath = dirname( __FILE__ ) . $ds. $storeFolder . $ds;  //4

    $targetFile =  $targetPath. $_FILES['file']['name'];  //5

    move_uploaded_file($tempFile,$targetFile); //6

}
?>