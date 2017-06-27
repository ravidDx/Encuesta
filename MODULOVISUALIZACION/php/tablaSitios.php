<?php

if($_POST){

    $table= "";
    $sitios = $_POST['sitios'];
    $table .= '<div id="dvData" class="table-responsive">';
    $table .= '<table id="tablesitios" class="table table-striped table-bordered">';
    $table .= "<thead>";
    $table .= "<tr>";
    $table .= "<th>Identificación</th>";
    $table .= "<th>Nombre Comercial</th>";
    $table .= "<th>Calle Principal</th>";
    $table .= "<th>Calle Secundaria</th>";
    $table .= "<th>Número de Lote</th>";
    $table .= "<th>Razón Social</th>";
    $table .= "<th>ID Vendedor</th>";
    $table .= "<th class='select-filter'>Nombre Vendedor</th>";
    $table .= "<th class='select-filter'>Código Ruta</th>";
    $table .= "<th class='select-filter'>Zona Supervisor</th>";
    $table .= "<th class='select-filter'>Zona Regional</th>";
    $table .= "<th class='select-filter'>Canal</th>";
    $table .= "<th class='select-filter'>Zona Nacional</th>";
    $table .= "<th>Latitud</th>";
    $table .= "<th>Longitud</th>";
    $table .= "<th>Estado</th>";
    $table .= "<th>Editar</th>";
    $table .= "</tr>";
    $table .= "</thead>";
    $table .= "<tbody>";

    foreach ($sitios as $sitio)
    {
        $table .= "<tr>";
        $table .= "<td>".$sitio['st_numeroID']."</td>";
        $table .= "<td>".$sitio['st_nombreComercial']."</td>";
        $table .= "<td>".$sitio['st_callePrincipal']."</td>";
        $table .= "<td>".$sitio['st_calleSecundaria']."</td>";
        $table .= '<td>'.$sitio['st_numeroLote']."</td>";
        $table .= "<td>".$sitio['st_razonSocial']."</td>";
        $table .= "<td>".$sitio['st_IdVendedor']."</td>";
        $table .= "<td>".$sitio['st_nombreVendedor']."</td>";
        $table .= "<td>".$sitio['st_codigoRuta']."</td>";
        $table .= "<td>".$sitio['st_zonaSupervisor']."</td>";
        $table .= "<td>".$sitio['st_zonaRegional']."</td>";
        $table .= "<td>".$sitio['st_canal']."</td>";
        $table .= "<td>".$sitio['st_zonaNacional']."</td>";
        $table .= "<td>".$sitio['st_latitud']."</td>";
        $table .= "<td>".$sitio['st_longitud']."</td>";
        $table .= "<td>".$sitio['st_estadoSitio']."</td>";
        $table .= "<td>";
        $table .= "<button type='button' class='btn btn-default' aria-label='Left Align' value='".$sitio['st_numeroID']."'>";
        $table .= "<span class='glyphicon glyphicon-pencil' aria-hidden='true'></span>";
        $table .= "</button>";
        $table .= "</td>";
        $table .= "</tr>";
    }
    $table .= "</tbody>";
    $table .= "</table>";
    $table .= '</div>';


    echo $table;
    //echo json_encode($actividades);
}
