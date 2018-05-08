<div class="container">
    <?php
    print_r($_SESSION["datosAdministracionUsuarios"][0]["tamanioOcupado"]);
    echo "<br/>";
    print_r($_SESSION["datosAdministracionUsuarios"][0]["tamanioTotalPermitido"]);
    echo "<br/>";
    foreach ($_SESSION["datosAdministracionNavegadores"] as $valor){
        print_r($valor);
        echo "<br/>";
    }


    ?>


<!--Primera fila-->
    <div class="row">
        <!--Cantidad de clientes-->
        <div class="col-md-3">
            <div class="card p-30">
                <div class="media">
                    <div class="media-left meida media-middle">
                        <span class="glyphicon glyphicon-user iconoPanelAdministracion"></span>
                    </div>
                    <div class="media-body media-text-right">
                        <h2><?php
                            echo $_SESSION["datosAdministracionUsuarios"][0]["numUsuarios"];
                            ?></h2>
                        <p class="m-b-0">Clientes</p>
                    </div>
                </div>
            </div>
        </div>

        <!--Espacio de la web-->
        <div class="col-md-3">
            <div id='espacioUsuario' style="height: 150px;">
                <script>
                    new Morris.Donut({
                        element: 'espacioUsuario',
                        data: [
                            {
                                label: "Espacio Usado",
                                value: <?php if ($_SESSION["datosAdministracionUsuarios"][0]["tamanioOcupado"] != 0) {
                                    echo round($_SESSION["datosAdministracionUsuarios"][0]["tamanioOcupado"] / 1024,2);
                                } else {
                                    echo "0";
                                } ?>},
                            {
                                label: "Espacio Libre",
                                value: <?php if($_SESSION["datosAdministracionUsuarios"][0]["tamanioOcupado"]){
                                    echo round($_SESSION["datosAdministracionUsuarios"][0]["tamanioTotalPermitido"] - $_SESSION["datosAdministracionUsuarios"][0]["tamanioOcupado"] / 1024,2);
                                }else{
                                    echo $_SESSION["datosAdministracionUsuarios"][0]["tamanioTotalPermitido"];
                                }  ?>}
                        ],
                        formatter: function (value, data) {
                            return value + 'Mb';
                        }
                    });
                </script>
            </div>
        </div>

        <!--Espacio de la web-->
        <div class="col-md-3">
            <div id='espacioUsuario' style="height: 150px;">
                <script>
                    new Morris.Donut({
                        element: 'espacioUsuario',
                        data: [
                            {
                                label: "Espacio Usado",
                                value: <?php if ($_SESSION["datosAdministracionUsuarios"][0]["tamanioOcupado"] != 0) {
                                    echo round($_SESSION["datosAdministracionUsuarios"][0]["tamanioOcupado"] / 1024,2);
                                } else {
                                    echo "0";
                                } ?>},
                            {
                                label: "Espacio Libre",
                                value: <?php if($_SESSION["datosAdministracionUsuarios"][0]["tamanioOcupado"]){
                                    echo round($_SESSION["datosAdministracionUsuarios"][0]["tamanioTotalPermitido"] - $_SESSION["datosAdministracionUsuarios"][0]["tamanioOcupado"] / 1024,2);
                                }else{
                                    echo $_SESSION["datosAdministracionUsuarios"][0]["tamanioTotalPermitido"];
                                }  ?>}
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
