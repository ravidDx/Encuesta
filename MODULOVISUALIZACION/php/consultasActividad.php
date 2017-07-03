<?php
// Exportar libreria
require("../vendor/autoload.php");

if($_POST){

	$idActividad = $_POST["_idActividad"];

	/* Consumiendo servicio web con la API Guzzle */
    $client = new GuzzleHttp\Client();
    $res = $client->request('GET', 'http://cobroalpasosails.herokuapp.com/Actividad/?id='.$idActividad);
    $estado = $res->getStatusCode(); // "200"
	$actividad = $res->getBody();
	$act = json_decode($actividad, true);

	$datos = array(
	'estado' => $estado,
	'descripcionActividad' => $act['ac_descripcionActividad'], 
	'preguntas' => $act['ac_preguntas'], 
	'sitios' => $act['ac_sitios'], 
	);

	//Devolvemos el array pasado a JSON como objeto
	echo json_encode($datos, JSON_FORCE_OBJECT);

}