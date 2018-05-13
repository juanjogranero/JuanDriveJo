<div class="container colorTextoPanel">
    <?php
    foreach ($_SESSION["DatosUsuarios"] as $valor) {
        echo '<a href="?pagina=editarUsuarioAdministracion&nombreUsuarioEditarAdmin='.$valor["nombreUsuario"].'" style="color: #c58b4a;">';
        echo '<div class="row text-center" style="background-color: #fff; margin-bottom: 2%; padding: 2%;word-wrap: break-word; -webkit-box-shadow: 0px 0px 18px -1px rgba(0,0,0,0.75);
        -moz-box-shadow: 0px 0px 18px -1px rgba(0,0,0,0.75);
        box-shadow: 0px 0px 18px -1px rgba(0,0,0,0.75);border: 1px solid #c6c6c6;
        ">';
        //imagen de perfil
        echo '<div class="col-md-2">';
        echo '<img src="' . $valor["imagenPerfilUsuario"] . '" alt="foto de perfil" class="img-circle" style="width:50%; margin-top:10%;box-shadow: 0px 0px 18px 2px rgba(0,0,0,0.3);">';
        echo '</div>';
        //nombre de usuario y codigo
        echo '<div class="col-md-2">';
        echo '<span class="glyphicon glyphicon-list-alt"></span> <h4>' . $valor["nombreUsuario"] . ' : ' . $valor["codUsuario"] . '</h4>';
        echo '</div>';
        //email
        echo '<div class="col-md-2">';
        echo '<span class="glyphicon glyphicon-send"></span><h4>' . $valor["emailUsuario"] . '</h4>';
        echo '</div>';
        //perfil usuario
        echo '<div class="col-md-2">';
        echo '<span class="glyphicon glyphicon-dashboard"></span><h4>' . $valor["perfilUsuario"] . '</h4>';
        echo '</div>';
        //navegador utilizado
        echo '<div class="col-md-2">';
        echo '<span class="glyphicon glyphicon-globe"></span><h4>' . $valor["navegadorUtilizado"] . '</h4>';
        echo '</div>';
        //bloqueo de usuario
        echo '<div class="col-md-2">';
        echo '<span class="glyphicon glyphicon-alert"></span>';
        if ($valor["bloqueoUsuario"]) {
            echo '<h4><span class="glyphicon glyphicon-asterisk" style="color:red;"></span></h4>';
        } else {
            echo '<h4><span class="glyphicon glyphicon-asterisk" style="color:green;"></span></h4>';
        }
        echo '</div>';
        echo '</div>';
        echo '</a>';

    }
    ?>
</div>
