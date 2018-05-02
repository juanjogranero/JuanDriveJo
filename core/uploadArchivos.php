<?php
/**
 * Utilidad :
 * Creado por : Juan Jose Granero Omañas
 */

if (!empty($_FILES)) {
    $tempFile = $_FILES['file']['tmp_name'];
    $targetFile = $_COOKIE["rutaSubidaArchivos"] . $_FILES['file']['name'];
    move_uploaded_file($tempFile, $targetFile);
}


?>