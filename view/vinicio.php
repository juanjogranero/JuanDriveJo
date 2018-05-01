<div class="container">
    <div class="col-sm-12" >
        <div class="jumbotron" style="box-shadow: 0px 0px 5px 2px rgba(0,0,0,0.75)" ;>

            <form action="<?PHP echo $_SERVER['PHP_SELF']; ?>" method="post" class="form-horizontal"
                  style="text-align: center">
                <?php
                var_dump($_SESSION['usuario']);
                echo "<Hr/>";
                var_dump($_GET);
                ?>

            </form>
        </div>
    </div>
</div>