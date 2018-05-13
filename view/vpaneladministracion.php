<div class="container">

    <!--Primera fila-->
    <div class="row colorTextoPanel">
        <!--Cantidad de clientes-->
        <div class="col-md-3">
            <div class="card text-center" style="width: 18rem;">
                <div class="card-body">
                    <span class="glyphicon glyphicon-user iconoPanelAdministracion"></span>
                    <h1 class="card-text "><?php
                        echo $_SESSION["datosAdministracionUsuarios"][0]["numUsuarios"];
                        ?></h1>
                    <h3 class="card-text">Clientes</h3>
                    <a href="?pagina=administrarUsuarios" class="btn botonAdministracion">Modificar</a>
                </div>
            </div>
        </div>

        <!--Navegadores utilizado-->
        <div class="col-md-3">
            <div class="card text-center" style="width: 18rem;">
                <div class="card-body">
                    <span class="glyphicon glyphicon glyphicon-globe iconoPanelAdministracion"></span>
                    <h1 class="card-text">
                        <div id='navegadoresUtilizados' style="height: 150px;">
                            <script>
                                new Morris.Donut({
                                    element: 'navegadoresUtilizados',
                                    data: [
                                            <?php foreach ($_SESSION["datosAdministracionNavegadores"] as $valor) {
                                                echo '{label: "'.$valor["nombreNavegador"].'",';
                                                echo 'value: '.$valor["cantidad"].'},';
                                            }

                                            ?>

                                    ],
                                    colors: [
                                        '#2790c4',
                                        '#c4a034',
                                        '#c30300',
                                        '#0cc4b2',
                                        '#48c1c5',
                                        '#b2c5b8'

                                    ]
                                });
                            </script>
                        </div>
                    </h1>
                    <h3 class="card-text">Navegadores</h3>
                </div>
            </div>
        </div>

        <!--Espacio de la web-->
        <div class="col-md-3">
            <div class="card text-center" style="width: 18rem;">
                <div class="card-body">
                    <span class="glyphicon glyphicon-hdd iconoPanelAdministracion"></span>
                    <h1 class="card-text">
                        <div id='espacioUsuario' style="height: 150px;">
                            <script>
                                new Morris.Donut({
                                    element: 'espacioUsuario',
                                    data: [
                                        {
                                            label: "Espacio Usado",
                                            value: <?php if ($_SESSION["datosAdministracionUsuarios"][0]["tamanioOcupado"] != 0) {
                                                echo round($_SESSION["datosAdministracionUsuarios"][0]["tamanioOcupado"] / 1024, 2);
                                            } else {
                                                echo "0";
                                            } ?>},
                                        {
                                            label: "Espacio Libre",
                                            value: <?php if ($_SESSION["datosAdministracionUsuarios"][0]["tamanioOcupado"]) {
                                                echo round($_SESSION["datosAdministracionUsuarios"][0]["tamanioTotalPermitido"] - $_SESSION["datosAdministracionUsuarios"][0]["tamanioOcupado"] / 1024, 2);
                                            } else {
                                                echo $_SESSION["datosAdministracionUsuarios"][0]["tamanioTotalPermitido"];
                                            }  ?>}
                                    ],
                                    formatter: function (value, data) {
                                        return value + 'Mb';
                                    },
                                    colors: [
                                        '#3a7fc5',
                                        '#2dc54b'
                                    ]
                                });
                            </script>
                        </div>
                    </h1>
                    <h3 class="card-text">Espacio</h3>
                </div>
            </div>
        </div>

        <!--Cantidad de clientes-->
        <div class="col-md-3">
            <div class="card text-center" style="width: 18rem;">
                <div class="card-body">
                    <span class="glyphicon glyphicon-folder-open iconoPanelAdministracion"></span>
                    <h1 class="card-text"><?php
                        echo $_SESSION["datosAdministracionFicheros"][0]["cantidadFicheros"];
                        ?></h1>
                    <h3 class="card-text">Archivos</h3>
                </div>
            </div>
        </div>

    </div>
</div>
