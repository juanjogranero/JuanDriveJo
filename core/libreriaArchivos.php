<?php
/**
 * Utilidad :
 * Creado por : Juan Jose Granero Omañas
 */

function redimensionarImagenPerfil($rutaImagen)
{
//Creamos una variable imagen a partir de la imagen original
    $img_original = imagecreatefromjpeg($rutaImagen);

//Ancho y alto de la imagen original
    list($ancho, $alto) = getimagesize($rutaImagen);

//Creamos una imagen en blanco de tama�o $ancho_final  por $alto_final .
    $tmp = imagecreatetruecolor(256, 256);

//Copiamos $img_original sobre la imagen que acabamos de crear en blanco ($tmp)
    imagecopyresampled($tmp, $img_original, 0, 0, 0, 0, 256, 256, $ancho, $alto);

//Se destruye variable $img_original para liberar memoria
    imagedestroy($img_original);

//Definimos la calidad de la imagen final
    $calidad = 95;

//Se crea la imagen final en el directorio indicado
    imagejpeg($tmp, $rutaImagen, $calidad);
}

?>