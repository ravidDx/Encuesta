<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title></title>
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/dataTables.css" rel="stylesheet">
        <link href="https://cdn.datatables.net/buttons/1.2.4/css/buttons.dataTables.min.css" rel="stylesheet">
        <link href="css/estilos.css" rel="stylesheet">

    </head>
    <body>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <?php include('php/menu.php');?>
        <div class="container-fluid">
            <div class="alert alert-success mensajeRegistroSitios" style="display: none;">
                <strong>Warning!</strong> Indicates a warning that might need attention.
            </div>
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <h2>Sitios</h2>
                    <div class="sitioLoading" style="display: none;">
                        <center><img src="img/loading.gif"></center>
                        <center><label>Cargando sitios</label></center>
                    </div>
                    <div id="actividades">

                    </div>
                    <div id="notificaciones">

                    </div>
                    <center>
                        <button type="button" class="btn btn-default btn-lg" data-toggle="modal" data-target="#RegistroSitios">Subir Sitios</button>
                    </center>
                    <center>
                        <button type="button" class="btn btn-default btn-lg" data-toggle="modal" data-target="#Filtros">Filtros</button>
                    </center>
                </div>
            </div>

        </div>

        <!-- Modal Sitios -->
        <div class="modal fade" id="RegistroSitios" tabindex="-1" role="dialog" aria-labelledby="RegistroSitios">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Seleccione los sitios que desee guardar </h4>
                    </div>
                    <div class="modal-body">
                        <form id="excel">
                            <input type="file" id="files" name="files"/>
                        </form>
                    </div>
                    <div class="sitiosLoading" style="display: none;">
                        <center><img src="img/loading.gif"></center>
                        <center><label>Cargando Sitios </label></center>
                    </div>
                    <div class="alert alert-danger msgErrorSitios" style="display:none;">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                        <button type="button" id="btnRegistroSitios" class="btn btn-primary">Guardar Sitios</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Actualizar Sitios -->
        <div class="modal fade" id="ActualizarSitios" tabindex="-1" role="dialog" aria-labelledby="ActualizarSitios">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Seleccione los sitios que desee actualizar </h4>
                    </div>
                    <div class="modal-body">
                        <form id="excel">
                            <input type="file" id="files" name="files"/>
                        </form>
                    </div>
                    <div class="sitiosLoading" style="display: none;">
                        <center><img src="img/loading.gif"></center>
                        <center><label>Cargando Sitios</label></center>
                    </div>
                    <div class="alert alert-danger msgErrorSitios" style="display:none;">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                        <button type="button" id="btnActualizarSitios" class="btn btn-primary">Actualizar Sitios</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Filtros -->
        <div class="modal fade" id="Filtros" tabindex="-1" role="dialog" aria-labelledby="Filtros">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Filtros Tabla Sitios</h4>
                    </div>
                    <div class="modal-body">
                        <table id="filterTable" class="table">
                            <thead>
                                <tr>
                                    <th>Campo</th>
                                    <th>Valor a buscar</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr id="filter_col1" data-column="0">
                                    <td>Identificacion</td>
                                    <td align="center"><input type="text" class="column_filter form-control" id="col0_filter"></td>
                                </tr>
                                <tr id="filter_col2" data-column="1">
                                    <td>Nombre Comercial</td>
                                    <td align="center"><input type="text" class="column_filter form-control" id="col1_filter"></td>
                                </tr>
                                <tr id="filter_col3" data-column="2">
                                    <td>Calle Principal</td>
                                    <td align="center"><input type="text" class="column_filter form-control" id="col2_filter"></td>
                                </tr>
                                <tr id="filter_col4" data-column="3">
                                    <td>Calle Secundaria</td>
                                    <td align="center"><input type="text" class="column_filter form-control" id="col3_filter"></td>
                                </tr>
                                <tr id="filter_col5" data-column="4">
                                    <td>Número de Lote</td>
                                    <td align="center"><input type="text" class="column_filter form-control" id="col4_filter"></td>
                                </tr>
                                <tr id="filter_col6" data-column="5">
                                    <td>Razon Social</td>
                                    <td align="center"><input type="text" class="column_filter form-control" id="col5_filter"></td>
                                </tr>
                                <tr id="filter_col7" data-column="6">
                                    <td>ID Vendedor</td>
                                    <td align="center"><input type="text" class="column_filter form-control" id="col6_filter"></td>
                                </tr>
                                <tr id="filter_col8" data-column="7">
                                    <td class="select-filter" >Nombre Vendedor</td>
                                </tr>
                                <tr id="filter_col9" data-column="8">
                                    <td class="select-filter">Codigo Ruta</td>
                                </tr>
                                <tr id="filter_col10" data-column="9">
                                    <td class="select-filter">Zona Supervisor</td>
                                </tr>
                                <tr id="filter_col11" data-column="10">
                                    <td class="select-filter">Zona Regional</td>
                                </tr>
                                <tr id="filter_col12" data-column="11">
                                    <td class="select-filter">Canal</td>
                                </tr>
                                <tr id="filter_col13" data-column="12">
                                    <td class="select-filter">Zona Nacional</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                        <button type="button" id="btnActualizarSitios" class="btn btn-primary">Actualizar Sitios</button>
                    </div>
                </div>
            </div>
        </div>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.7.7/xlsx.core.min.js"></script>
        <script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
        <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.15.0/jquery.validate.js"></script>
        <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.15.0/additional-methods.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/dataTables.min.js"></script>
        <script src="main/sitios.js"></script>
        <script src="https://cdn.datatables.net/buttons/1.2.4/js/dataTables.buttons.min.js"></script>
        <script src="//cdn.datatables.net/buttons/1.2.4/js/buttons.flash.min.js"></script>
<!--        <script src="//cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>-->
        <script src="//cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
        <script src="//cdn.datatables.net/buttons/1.2.4/js/buttons.html5.min.js"></script>
        
    </body>
</html>
