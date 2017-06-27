<?php


if($_POST){
    $idActividad = $_POST['idActividad'];

    echo "idActividad: ".$idActividad."<br>";
 
    // Get cURL resource
    $curl = curl_init();
    // Set some options - we are passing in a useragent too here
    curl_setopt_array($curl, array(
        CURLOPT_RETURNTRANSFER => 1,
        CURLOPT_URL => 'http://cobroalpasosails.herokuapp.com/Actividad/?id='.$idActividad,
        CURLOPT_USERAGENT => 'Codular Sample cURL Request'
    ));
    // Send the request & save response to $resp
    $actividad = curl_exec($curl);
    // Close request to clear up some resources
    curl_close($curl);

    //print_r(gettype($resp));
    //var_dump($actividad);
    $act = json_decode($actividad, true);
    $preguntas = $act['ac_preguntas'];


    echo "# preguntas: ".count($preguntas)."<br>";

    foreach($preguntas as $key => $value)
    {
        echo "Pregunta  -->".$value['pr_pregunta']."<br>"; // Su valor      
        echo "Tipo Pregunta -->".$value['pr_tipoPregunta']."<br>"; // Su valor      
        echo "id -->".$value['id']."<br>"; // Su valor        
        //echo "--->>>".$value[]."<br>"; // Su valor

        searchRespuestas($value['id']);
    }








  




    //print_r($preguntas->pr_pregunta);

    //var_dump($preguntas);
    print_r("//");
    //var_dump($preguntas->pr_pregunta);

    //print_r($act['ac_preguntas']);

    // Get cURL resource
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_RETURNTRANSFER => 1,
        CURLOPT_URL => 'http://cobroalpasosails.herokuapp.com/ActividadSitio/?as_tieneactividad='.$idActividad,
        CURLOPT_USERAGENT => 'Codular Sample cURL Request'
    ));
    $resp = curl_exec($curl);
    curl_close($curl);

    $actSitio = json_decode($resp, true);

    foreach ($actSitio as $ac){

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => 'http://cobroalpasosails.herokuapp.com/ClienteActividadSitio/?cas_actividadsitio='.$ac['id'],
            CURLOPT_USERAGENT => 'Codular Sample cURL Request'
        ));
        //        $cas = curl_exec($curl) or die(curl_error($curl)); ;

        if( ! $cas = curl_exec($curl)) 
        { 
            trigger_error(curl_error($curl)); 
        }

        // Close request to clear up some resources
        curl_close($curl);

        //    echo 'ESto es un ARRAY';
        //    echo ($cas);
        //    echo '<br>';

        //        echo $cas.'<br>';


        if($cas === "[]"){
            echo 'asd';
        }else{
            asd($cas, $preguntas);
        }

    }

}



function searchActividad(){

}




function searchRespuestas($idPregunta){
    // Crea un nuevo recurso cURL
    $curl = curl_init();
    // Set some options - we are passing in a useragent too here
    curl_setopt_array($curl, array(
        CURLOPT_RETURNTRANSFER => 1,
        CURLOPT_URL => 'http://cobroalpasosails.herokuapp.com/Pregunta/?id='.$idPregunta,
        CURLOPT_USERAGENT => 'Codular Sample cURL Request'
    ));
    
    // Envia la peticiont & guarda la respuesta en $pregunta
    $pregunta = curl_exec($curl);

    // Cierra la peticion y limpia up some resources
    curl_close($curl);

     $preg = json_decode($pregunta, true);
     $cantidadRespuestas = count($preg['pr_respuestas']);
     $cantidadOpciones = count($preg['pr_opciones']);

     $colecionRespuestas = $preg['pr_respuestas'];

     echo("Cantidad de respuesta: ");
     echo($cantidadRespuestas.'<br>');
     echo("Cantidad de opciones: ");
     echo($cantidadOpciones.'<br>'.'<br>');

     if($cantidadRespuestas != 0){
        echo "entro";
        searchClienteRespuesta($colecionRespuestas);
     }

     

}


function searchClienteRespuesta($colecionRespuestas){

    echo "REPUESTAS"."<br>";

    foreach($colecionRespuestas as $key => $value)
    {
        echo "id Respuesta  -->".$value['id']."<br>"; // Su valor      

         // Crea un nuevo recurso cURL
        $curl = curl_init();
        // Set some options - we are passing in a useragent too here
        curl_setopt_array($curl, array(
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => 'http://cobroalpasosails.herokuapp.com/Respuesta/?id='.$value['id'],
            CURLOPT_USERAGENT => 'Codular Sample cURL Request'
        ));
        
        // Envia la peticiont & guarda la respuesta en $pregunta
        $cliente = curl_exec($curl);

        // Cierra la peticion y limpia up some resources
        curl_close($curl);

         $clien = json_decode($cliente, true);
         $idCliente = ($clien['re_pertenececas']['cas_cliente']);
         echo "id Cliente  -->".$idCliente."<br>"; // Su valor   


        $curl = curl_init();
        // Set some options - we are passing in a useragent too here
        curl_setopt_array($curl, array(
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => 'http://cobroalpasosails.herokuapp.com/Cliente/?id='.$idCliente,
            CURLOPT_USERAGENT => 'Codular Sample cURL Request'
        ));
        
        // Envia la peticiont & guarda la respuesta en $pregunta
        $cliente = curl_exec($curl);

        // Cierra la peticion y limpia up some resources
        curl_close($curl);


         $client = json_decode($cliente, true);
         $nombre = $client['cl_nombre'];
          $apellido = $client['cl_apellido'];
             $correo = $client['cl_correo'];
         echo " nombre  -->".$nombre." " .$apellido ."<br>"; // Su valor   
         echo " correo  -->".$correo."<br>"; // Su valor   






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








