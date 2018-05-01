<div class="container">
    <div class="row">
        <div class="col-sm-3">
        </div>
        <div class="col-sm-4">
            <img src="webroot/media/img/logo.png" class="img-logo-login text-center" alt="logo">

            <h1>Todos tus archivos estés donde estés</h1>
        </div>
        <div class="col-sm-4">

            <h1 style="padding-left: 20%;">REGISTRATE GRATUITAMENTE</h1>

            <form action="index.php?pagina=registrar" method="post" class="form-horizontal" style="margin-left: 25%;">
                <label for="nombreUsuario">Nombre de usuario :</label>
                <div class="form-group input-group">
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-user"></span>
                    </span>
                    <input type="text" class="form-control"
                           name="nombreUsuario" <?php if (isset($_POST['nombreUsuario']) && empty($mensajeError['errorNombreUsuario'])) {
                        echo 'value="', $_POST['nombreUsuario'], '"';
                    } ?> placeholder="Nombre de usuario ">
                </div>
                <?php if ($mensajeError['errorNombreUsuario'] != "") {
                    echo "<div class=\"alert alert-danger\">" . $mensajeError['errorNombreUsuario'] . "</div></br>";
                } ?>

                <label for="emailUsuario">Correo Electronico :</label>
                <div class="form-group input-group">
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-send"></span>
                    </span>
                    <input type="email" class="form-control"
                           name="emailUsuario" <?php if (isset($_POST['emailUsuario']) && empty($mensajeError['errorEmailUsuario'])) {
                        echo 'value="', $_POST['emailUsuario'], '"';
                    } ?> placeholder="Correo electronico ">
                </div>
                <?php if ($mensajeError['errorEmailUsuario'] != "") {
                    echo "<div class=\"alert alert-danger\">" . $mensajeError['errorEmailUsuario'] . "</div></br>";
                } ?>

                <label for="passwordUsuario">Contraseña :</label>
                <div class="form-group input-group">
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-lock"></span>
                    </span>
                    <input type="password" class="form-control" name="passwordUsuario" placeholder="Contraseña">
                </div>
                <?php if ($mensajeError['errorPassword'] != "") {
                    echo "<div class=\"alert alert-danger\">" . $mensajeError['errorPassword'] . "</div></br>";
                } ?>

                <label for="password2Usuario">Repite la contraseña :</label>
                <div class="form-group input-group">
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-lock"></span>
                    </span>
                    <input type="password" class="form-control" name="password2Usuario"
                           placeholder="Repetir contraseña">
                </div>
                <?php if ($mensajeError['errorDuplicado'] != "") {
                    echo "<div class=\"alert alert-danger\">" . $mensajeError['errorDuplicado'] . "</div></br>";
                } ?>

                <div class="form-group">
                    <input type="submit" class="btn btn-success" name="Aceptar" value="Registrarme!">
                </div>

            </form>
        </div>
    </div>
</div>