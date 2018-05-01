<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <h1 class="text-center">Datos de tu perfil</h1>
            <hr>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-2">
            <?php
            echo "<img src='" . $_SESSION['usuario']->getImagenPerfil() . "' alt='foto de perfil' class='img-circle' style='width:100%; margin-top:10%;box-shadow: 0px 0px 18px 2px rgba(0,0,0,0.3);'>";
            ?>
            <hr>
            <h4 class="text-center" style="margin-bottom:10%;">
                <?php
                echo $_SESSION['usuario']->getNombreUsuario();
                ?>
            </h4>

        </div>

        <div class="col-sm-1">

        </div>
        <div class="col-sm-6">
            <form action="index.php?pagina=perfil" method="post" class="form-horizontal" enctype="multipart/form-data">
                <label for="codUsuario">Codigo de usuario :</label>
                <div class="form-group input-group">
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-floppy-disk"></span>
                    </span>
                    <input type="text" class="form-control"
                           name="codUsuario" value="<?php echo $_SESSION['usuario']->getCodUsuario(); ?>" disabled>
                </div>

                <label for="codUsuario">Tipo de cuenta :</label>
                <div class="form-group input-group">
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-barcode"></span>
                    </span>
                    <input type="text" class="form-control"
                           name="codUsuario" value="<?php echo $_SESSION['usuario']->getPerfil(); ?>" disabled>
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
                        echo 'value="', $_SESSION['usuario']->getEmail(), '"';
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

                <label>Cambiar la imagen de perfil :</label>
                <div class="input-group">
                    <label class="input-group-btn">
                    <span class="btn btn-primary">
                            Seleccionar <input type="file" style="display: none;" name="imagenPerfilUsuario" id="imagenPerfilUsuario">
                    </span>
                    </label>

                    <input type="text" class="form-control" readonly>
                </div>
                <hr>

                <div class="form-group text-center">
                    <input type="submit" class="btn btn-success" name="Aceptar" value="Modificar mis datos">
                </div>

            </form>

        </div>
        <div class="col-sm-1">
        </div>

        <div class="col-sm-2">

            <img src="<?php echo $navegadorUtilizado; ?>" class='img-circle' alt="Navegador usado"
                 style='width:100%; margin-top:10%;box-shadow: 0px 0px 18px 2px rgba(0,0,0,0.3);'>
            <hr>
            <h4 class="text-center" style="margin-bottom:10%;">
                <?php
                echo $navegadorUtilizadoNombre;
                ?>
            </h4>
        </div>

    </div>


    <div class="row">
        <div class="col-sm-12">
            <!--            Grafica generada con morris.js-->
            <div id='espacioUsuario' style="height: 200px;">
                <script>
                    new Morris.Donut({
                        element: 'espacioUsuario',
                        data: [
                            {label: "Espacio Usado", value: <?php echo $_SESSION['usuario']->getTamanioOcupado(); ?>},
                            {
                                label: "Espacio Libre",
                                value: <?php echo $_SESSION['usuario']->getTamanioPermitido() - $_SESSION['usuario']->getTamanioOcupado(); ?>}
                        ],
                        formatter: function (value, data) {
                            return value + 'Mb';
                        }
                    });
                </script>
            </div>

        </div>
    </div>

</div>

<script>
    $(function() {

        // We can attach the `fileselect` event to all file inputs on the page
        $(document).on('change', ':file', function() {
            var input = $(this),
                numFiles = input.get(0).files ? input.get(0).files.length : 1,
                label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
            input.trigger('fileselect', [numFiles, label]);
        });

        // We can watch for our custom `fileselect` event like this
        $(document).ready( function() {
            $(':file').on('fileselect', function(event, numFiles, label) {

                var input = $(this).parents('.input-group').find(':text'),
                    log = numFiles > 1 ? numFiles + ' files selected' : label;

                if( input.length ) {
                    input.val(log);
                } else {
                    if( log ) alert(log);
                }

            });
        });

    });
</script>