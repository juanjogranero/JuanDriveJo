<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <h1 class="text-center">Datos de <?php echo $_SESSION["usuarioEditarPorAdministrador"][0]["nombreUsuario"]?></h1>
            <hr>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-3">

        </div>

        <div class="col-sm-6">
            <form action="index.php?pagina=editarUsuarioAdministracion" method="post" class="form-horizontal" enctype="multipart/form-data">
                <label for="codUsuario">Codigo de usuario :</label>
                <div class="form-group input-group">
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-floppy-disk"></span>
                    </span>
                    <input type="text" class="form-control"
                           name="codUsuario" value="<?php echo $_SESSION["usuarioEditarPorAdministrador"][0]["codUsuario"]; ?>" disabled>
                </div>

                <label for="perfilUsuario">Tipo de cuenta :</label>
                <div class="form-group input-group">
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-barcode"></span>
                    </span>
                    <select class="form-control" name="perfilUsuario">
                        <option <?php if($_SESSION["usuarioEditarPorAdministrador"][0]["perfilUsuario"]=="usuario"){echo "selected";}?>>usuario</option>
                        <option <?php if($_SESSION["usuarioEditarPorAdministrador"][0]["perfilUsuario"]=="administrador"){echo "selected";}?>>administrador</option>
                    </select>
                </div>

                <label for="emailUsuario">Correo Electronico :</label>
                <div class="form-group input-group">
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-send"></span>
                    </span>
                    <input type="email" class="form-control"
                           name="emailUsuario" <?php if (isset($_POST['emailUsuario']) && empty($mensajeError['errorEmailUsuario'])) {
                        echo 'value="', $_POST['emailUsuario'], '"';
                    } else {
                        echo 'value="', $_SESSION["usuarioEditarPorAdministrador"][0]["emailUsuario"], '"';
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

                <label for="bloqueo">Bloqueo de usuario :</label>
                <div class="form-group input-group">
                    <input name="bloqueo" type="checkbox" <?php if($_SESSION["usuarioEditarPorAdministrador"][0]["bloqueoUsuario"]){echo'checked';}?>>
                </div>

                <label>Cambiar la imagen de perfil :</label>
                <div class="input-group">
                    <label class="input-group-btn">
                    <span class="btn btn-primary">
                            Seleccionar <input type="file" style="display: none;" name="imagenPerfilUsuario"
                                               id="imagenPerfilUsuario" size="512" onchange="return fileValidation()">
                    </span>
                    </label>
                    <input type="text" class="form-control" readonly>
                </div>
                <div id="imagePreview" class="text-center"></div>
                <?php if ($mensajeError['errorArchivo'] != "") {
                    echo "<div class=\"alert alert-danger\">" . $mensajeError['errorArchivo'] . "</div></br>";
                } ?>
                <?php if ($mensajeError['errorSubida'] != "") {
                    echo "<div class=\"alert alert-danger\">" . $mensajeError['errorSubida'] . "</div></br>";
                } ?>
                <hr>

                <div class="form-group text-center">
                    <input type="submit" class="btn btn-success" name="Aceptar" value="Modificar mis datos">
                </div>

            </form>

        </div>
        <div class="col-sm-3">
        </div>


    </div>


</div>
<!--Carga de scripts-->
<script src="webroot/js/modificacionPerfil.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/9.12.0/highlight.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-switch/3.3.4/js/bootstrap-switch.js"></script>
<script>$("[name='bloqueo']").bootstrapSwitch();</script>
