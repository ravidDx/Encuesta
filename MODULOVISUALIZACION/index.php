<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Página</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="css/proveedor.css">
    </head>
    <body>

        <nav class="navbar navbar-default navbar-fixed-top">
            <div class="container-fluid">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav navbar-right contenedorprincipal border">

                        <li>
                            <a href="#" class="dropdown-toggle proveedor" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"></a>
                            <ul class="dropdown-menu">
                                <li ><a href="php/cerrarsesion.php">Cerrar Sesion</a></li>
                            </ul>

                        </li>
                    </ul>
                </div><!-- /.navbar-collapse -->
            </div><!-- /.container-fluid -->
        </nav>

        <div class="container-fluid">

            <div class="row">
                <div class="col-md-4 col-md-offset-4">
                    <form id="inicio_sesion" class="form-signin">
                        <center><h2>Inicie sesión</h2></center>
                        <button type="button" id="btnIniciarSesion" class="btn btn-primary">Iniciar sesion</button>
                    </form>
                    
                </div>
            </div>



        </div> <!-- /container -->

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/jquery.validate.js"></script>
        <script src="js/md5.js"></script>
        <script src="main/registro.js"></script>
        <script type="text/javascript">    
            $.ajax({
                url: "php/iniciosesion.php", 
                dataType: "JSON", 
                success: function(proveedor){
                    $('.proveedor').html('Bienvenido, '+ proveedor.pr_nombre +' <span class="caret"></span>');
                }
            });
        </script>
    </body>
</html>
