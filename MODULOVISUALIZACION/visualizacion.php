<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Visualización</title>
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/estilos.css" rel="stylesheet">
        <link href="css/d3.css" rel="stylesheet">

        <style>
        .chart div {font: 10px sans-serif; background-color: steelblue; text-align: right; padding: 3px; margin: 1px; color: white;}
        </style>

        <style>

            .rect {
              fill: steelblue;
            }

            .bar:hover {
              fill: brown;
            }

            .axis--x path {
              display: none;
            }

        </style>



    </head>
    <body>
        <script src="http://d3js.org/d3.v3.min.js"></script>
        <script src="http://labratrevenge.com/d3-tip/javascripts/d3.tip.v0.6.3.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <?php include('php/menu.php');?>

        

        <div class="container-fluid">
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
				<a href="sitios.php">Sitios</a>
                    <h2>Visualización</h2>
                    <div class="select-Actividad col-md-10">
                        
                        <label for="sel_actividades" class="control-label">Elige una Actividad</label>
                        <select id="sel_actividades" class="form-group">
                            <option value="">Seleccione...</option>
                        </select>
                        <button type="button" id="btnGenerar" class="btn btn-default">Generar</button>
                    </div>
                </div>
            </div>

        </div>

        <div class="chart"></div>

        <div class="container">
            <div class="row">
                <svg width="315" height="400"></svg>
            </div>
        </div>

        

        <script src="js/bootstrap.min.js"></script>
        <script src="main/visualizacion.js"></script>
    </body>
</html>
