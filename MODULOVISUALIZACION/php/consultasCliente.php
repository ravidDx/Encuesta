<?php
// Exportar libreria
require("../vendor/autoload.php");

if($_POST){

	$_idRespuesta = $_POST["_idRespuesta"];

    /* Consumiendo servicio web con la API Guzzle */
    /* ----------------------------------------------------------------------- */
    $client = new GuzzleHttp\Client();
    $res = $client->request('GET', 'http://cobroalpasosails.herokuapp.com/Respuesta/?id='.$_idRespuesta );
    $respuesta = $res->getBody(); //recupera los datos de la solicitud

    $resp = json_decode($respuesta, true);
    $idCliente = ($resp['re_pertenececas']['cas_cliente']);

    $resp2  = $client->request('GET', 'http://cobroalpasosails.herokuapp.com/Cliente/?id='.$idCliente );
    $cliente = $resp2 ->getBody(); //recupera los datos de la solicitud
    $estado = $resp2->getStatusCode(); // "200"

    $client = json_decode($cliente, true);
    $nombre = $client['cl_nombre'];
    $apellido = $client['cl_apellido'];
    $correo = $client['cl_correo'];
	$datos = array(
		'estado' => $estado,
		'idCliente' => $idCliente, 
		'nombre' => $nombre,
		'apellido' => $apellido,  
		'correo' => $correo, 
	);

	//Devolvemos el array pasado a JSON como objeto
	echo json_encode($datos, JSON_FORCE_OBJECT);


}