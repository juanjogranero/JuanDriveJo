<?php
//Definicion constantes con las rutas referentes al servidor
define('PATHSERVIDOR','http://192.168.1.5/');
define('PATHAPACHE','/var/www/html/');
define('PATHIMAGENES','webroot/media/img/');
define('PATHIMAGENESPERFIL','webroot/media/img/perfilUsuario/');
define('PATHDIRECTORIOFICHEROSUSUARIOS','webroot/media/files/');
//Vistas disponibles
$vistas=[
    'inicio'=>'view/vinicio.php',
    'login'=>'view/vlogin.php',
    'registrar'=>'view/vregistrar.php',
    'perfil'=>'view/vperfil.php'
];
//Controladores disponibles
$controladores=[
    'inicio'=>'controller/cinicio.php',
    'login'=>'controller/clogin.php',
    'registrar'=>'controller/cregistrar.php',
    'perfil'=>'controller/cperfil.php'
];
?>