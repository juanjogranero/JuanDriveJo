<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">

    <?php
    //Si se van a mostrar graficos, se cargan estas librerias de JS
    if (isset($_GET["pagina"]) && $_GET["pagina"] == "perfil") {
        echo '
            <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
            <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>

        ';
    }

    //Si se van a subir archivos a la pagina principal, se cargan los scripts de la dropzone y de JQueryUI
    if (isset($_GET["pagina"]) && $_GET["pagina"] == "inicio") {
        echo '
            <link href="/webroot/css/dropzone.min.css" type="text/css" rel="stylesheet" />
            <script src="/webroot/js/dropzone.js"></script>
            <script
			  src="https://code.jquery.com/ui/1.12.0/jquery-ui.min.js"
			  crossorigin="anonymous"></script>
        ';
    }


    ?>

    <link rel="stylesheet" href="webroot/css/style.css" type="text/css">

</head>
<body>
<nav class="navbar navbar-default nav-personalizada">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="index.php">JuanDriveJo</a>
        </div>
        <?php
        //Si esta logueado el usuario, aparece el menu de "Mis archivos"
        if (isset($_SESSION["usuario"])) {
            echo "<ul class=\"nav navbar-nav\">
            <li class=\"active\"><a href=\"?pagina=inicio\">Mis archivos</a></li>
            </ul>";
        }
        ?>

        <?php
        //Si se encuentra en la pestaña de registro, aparece el menu de login
        if ($_GET['pagina'] == "registrar") {
            echo "<ul class=\"nav navbar-nav navbar-right\">
                <li><a href=\"?pagina=login\"><span class=\"glyphicon glyphicon-floppy-save\"></span> Login</a></li>
                </ul>";
            //Si se encuentra en la pestaña de login, aparece el menu de registro
        } elseif ($_GET['pagina'] == "login") {
            echo "<ul class=\"nav navbar-nav navbar-right\">
                <li><a href=\"?pagina=registrar\"><span class=\"glyphicon glyphicon-floppy-open\"></span> Registro</a></li>
                </ul>";
        } elseif (isset($_SESSION['usuario'])) {
            //Boton de salir para cerrar la sesion
            echo "<ul class=\"nav navbar-nav navbar-right\">
                <li><a href=\"?pagina=inicio&opcion=salir\"><span class=\"glyphicon glyphicon-off\"></span> Salir</a></li>
                </ul>
                ";
            //Barra de busqueda
                echo'<form class="navbar-form navbar-left" action="?pagina=inicio"  method="post">
                    <div class="form-group">
                    <input type="text" class="form-control" placeholder="Buscar en tus archivos" name="textoBusqueda">
                    </div>
                  <button type="submit" name="busqueda" class="btn btn-default"><span class="glyphicon glyphicon-search"></span></button>
                </form>';

            if ($_GET['pagina'] != "perfil") {
                // Icono apra acceder al perfil del usuario
                echo "<ul class=\"nav navbar-nav navbar-right\">
                <li><a href=\"?pagina=perfil\"><img src='" . $_SESSION['usuario']->getImagenPerfil() . "' alt='foto de perfil' class='img-circle' style='width:20px;'> " . $_SESSION['usuario']->getNombreUsuario() . "</a></li>
                </ul>";
            }
        }
        ?>

    </div>
</nav>
<?php require_once $vistas[$_GET['pagina']]; ?>

</body>
</html>