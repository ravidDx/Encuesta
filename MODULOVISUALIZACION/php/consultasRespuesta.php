<?php
// Exportar libreria
require("../vendor/autoload.php");

if($_POST){

	$_idPregunta = $_POST["_idPregunta"];

	/* Consumiendo servicio web con la API Guzzle */
    /* ----------------------------------------------------------------------- */
    $client = new GuzzleHttp\Client();
    $res = $client->request('GET', 'http://cobroalpasosails.herokuapp.com/Pregunta/?id='.$_idPregunta);
    
     $estado = $res->getStatusCode(); // "200"
    $pregunta = $res->getBody(); //recupera los datos de la solicitud
    $preg = json_decode($pregunta, true);
    $cantidadRespuestas = count($preg['pr_respuestas']);
    $cantidadOpciones = count($preg['pr_opciones']);
    $coleccionRespuestas = $preg['pr_respuestas']; //almacena un arreglo de respuestas 

    /* ----------------------------------------------------------------------- */
	$datos = array(
	'estado' => $estado,
	'cantidadRespuestas' => $cantidadRespuestas, 
	'cantidadOpciones' => $cantidadOpciones, 
	'coleccionRespuestas' => $coleccionRespuestas, 
	);

	//Devolvemos el array pasado a JSON como objeto
	echo json_encode($datos, JSON_FORCE_OBJECT);


}