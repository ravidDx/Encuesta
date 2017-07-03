
<?php
// Exportar libreria
require("../vendor/autoload.php");

//Variable que se usara como Global
$coleccionClientes = [];

if($_POST){

    $idPregunta = $_POST['_idPregunta']; 
    echo 'Pregunta id '.$idPregunta.'<br>';
    searchRespuestas($idPregunta); //Metodo que busca las respuestas de cada pregunta

    //Guardamos los datos en un array

    //Devolvemos el array pasado a JSON como objeto
    //echo json_encode($coleccionClientes, JSON_FORCE_OBJECT);

    var_dump($coleccionClientes);

}






//Metodo para buscar las respuestas de la pregunta escogida
function searchRespuestas($idPregunta ){

    /* Consumiendo servicio web con la API Guzzle */
    /* ----------------------------------------------------------------------- */
    $client = new GuzzleHttp\Client();
    $res = $client->request('GET', 'http://cobroalpasosails.herokuapp.com/Pregunta/?id='.$idPregunta);
    $pregunta = $res->getBody(); //recupera los datos de la solicitud
    $preg = json_decode($pregunta, true);
    $cantidadRespuestas = count($preg['pr_respuestas']);
    $cantidadOpciones = count($preg['pr_opciones']);

    $colecionRespuestas = $preg['pr_respuestas']; //almacena un arreglo de respuestas 
    echo("Cantidad de respuesta: ");
    echo($cantidadRespuestas.'<br>');
    echo("Cantidad de opciones: ");
    echo($cantidadOpciones.'<br>'.'<br>');
    /* ----------------------------------------------------------------------- */
    
    if($cantidadRespuestas != 0){
        echo "Buscar clientes de cada respuesta".'<br>';
        searchClienteRespuesta($colecionRespuestas); //Metodo para buscar clientes de cada respuesta
        echo '<br>';
    }
     
}


//Metodo para buscar clientes de las respuestas de la pregunta escogida
function searchClienteRespuesta($colecionRespuestas){

    $calificaciones = [];
    foreach($colecionRespuestas as $key => $value)
    {
        echo "id Respuesta  ----->".$value['id']."<br>"; // Su valor

        /* Consumiendo servicio web con la API Guzzle */
        /* ----------------------------------------------------------------------- */
        $client = new GuzzleHttp\Client();
        $res = $client->request('GET', 'http://cobroalpasosails.herokuapp.com/Respuesta/?id='.$value['id'] );
        $respuesta = $res->getBody(); //recupera los datos de la solicitud

        $resp = json_decode($respuesta, true);
        $idCliente = ($resp['re_pertenececas']['cas_cliente']);
        echo "id Cliente: ".$idCliente."<br>"; // Su valor

        $request  = $client->request('GET', 'http://cobroalpasosails.herokuapp.com/Cliente/?id='.$idCliente );
        $cliente = $request ->getBody(); //recupera los datos de la solicitud

        $client = json_decode($cliente, true);
        $nombre = $client['cl_nombre'];
        $apellido = $client['cl_apellido'];
        $correo = $client['cl_correo'];
        echo " nombre: ".$nombre." " .$apellido ."<br>"; // Su valor   
        echo " correo: ".$correo."<br>"; // Su valor     

        /* ----------------------------------------------------------------------- */
        global $coleccionClientes;
        array_push ( $coleccionClientes,  $correo );
    }

}






function asd($datos, $preguntas){

    $aux = json_decode($datos, true);
    $ar = array();

    foreach ($aux as $a){
        //        echo "ID";
        //        echo $a['id']."<br>";
        foreach ($a['cas_respuestas'] as $r){
            //            echo "Res <br>";
            //            print_r($r);

            if (isset($r['re_tieneOpcion'])){
                $curl = curl_init();
                curl_setopt_array($curl, array(
                    CURLOPT_RETURNTRANSFER => 1,
                    CURLOPT_URL => 'http://cobroalpasosails.herokuapp.com/Pregunta/?id='.$r['re_tienePregunta'],
                    CURLOPT_USERAGENT => 'Codular Sample cURL Request'
                ));
                $op = curl_exec($curl);
                curl_close($curl);
                $obj = (object) array('cas' => $a, 'res' => $r, 'op' => $op);

                array_push($ar, $obj);

            }else{

                $curl = curl_init();
                curl_setopt_array($curl, array(
                    CURLOPT_RETURNTRANSFER => 1,
                    CURLOPT_URL => 'http://cobroalpasosails.herokuapp.com/Pregunta/?id='.$r['re_tienePregunta'],
                    CURLOPT_USERAGENT => 'Codular Sample cURL Request'
                ));
                $pr = curl_exec($curl);
                curl_close($curl);

                $obj = (object) array('cas' => $a, 'res' => $r, 'pre' => $pr);

                array_push($ar, $obj);
            }
        }

    }

    $suma = array();

    foreach($preguntas as $pr){
        //        echo "<br>".$pr['id']."id pregunta<br>";
        $preg = array();
        $cont = 0;
        $sum = 0;
        $calif = 0;
        $ops = array();
        foreach ($ar as $c){

            if (isset($c->pre)){

//                $aux1 = json_decode($c->pre, true);
//
//                if($pr['id'] == $c->res['re_tienePregunta']){
//
//                    if($aux1['pr_tipoPregunta'] === 'rating'){
//                        echo $c->res['re_respuesta']; 
//                        $sum = $sum + (int)$c->res['re_respuesta'];
//                        $cont = $cont + 1;
//                        $preg = (object) array('id' => $pr['id'], 'pregunta' => $pr['pr_pregunta'], 'valor' => $sum/$cont, 'tipo' => $aux1['pr_tipoPregunta']);
//                    }else{
//                        if (isset($c->res['re_calificacion'])){
//                            echo $c->res['re_calificacion']; 
//                            $sum = $sum + (int)$c->res['re_calificacion'];
//                            $cont = $cont + 1;
//                        }else{
//                            echo '0';
//                            $cont = $cont + 1;
//                            $calif = $calif + 1;
//                        }
//                        $preg = (object) array('id' => $pr['id'], 'pregunta' => $pr['pr_pregunta'], 'valor' => $sum/$cont, 'calif' => $calif, 'tipo' => $aux1['pr_tipoPregunta']);
//                    }
//                }

            }else{
                
                if($pr['id'] == $c->res['re_tienePregunta']){
                    print_r($c->res);
                    
                    
                    $aux1 = json_decode($c->op, true);
//                    print_r($aux1['pr_opciones']);
                    $opcont = 0;
                    foreach ($aux1['pr_opciones'] as $op){
//                        print_r($op);
                        
                        if($op['id'] === $c->res['re_tieneOpcion']){
                            $option = (object) array('id' => $op['id'], 'participacion' => $op['op_participacion']);
                            array_push($ops, $option);
                        }
                        
                    }
                    
//                    $preg = (object) array('id' => $pr['id'], 'pregunta' => $pr['pr_pregunta'], 'tipo' => $aux1['pr_tipoPregunta'], 'optins' => $option);
                    
                    
                }
//                
                
            }


        }
//        $asd = ordena($ops);
        print_r($ops);
//        print_r(ordena($asd));
//        array_push($suma, $preg);
//        print_r($suma);
    }

}

function ordena($array){
    echo '<br>';
    echo 'function';
    echo '<br>';
    print_r($array);
    $contar=array();
 
	foreach($array as $v){
//        print_r($v);
        $id = $v->id;
		echo $v->id;
        $cont=0;
        
        foreach($array as $a){
            if($id === $a->id){
                $cont=$cont+1;
            }
        }
        $obj = (object) array('id' => $id, 'participacion' => $v->participacion, 'veces' => $cont);
        array_push($contar, $obj);
	}
    
//    print_r($contar);
    
//	return $contar;
}








