 <?php
 
 
 session_start();
 
 if($_POST){
    $idActividad = $_POST['idactividadSeleccionada'];
     
    //Consulta 1
    $curl1 = curl_init();

    curl_setopt_array($curl1, array(
        CURLOPT_RETURNTRANSFER => 1,
             CURLOPT_URL => 'http://cobroalpasosails.herokuapp.com/ActividadSitio/?as_tieneactividad='.$idActividad,	
        CURLOPT_USERAGENT => 'Codular Sample cURL Request'
    ));
    
    //Consulta 2
    $curl2 = curl_init();

    curl_setopt_array($curl2, array(
        CURLOPT_RETURNTRANSFER => 1,
             CURLOPT_URL => 'http://cobroalpasosails.herokuapp.com/Actividad/'.$idActividad,	
        CURLOPT_USERAGENT => 'Codular Sample cURL Request'
    ));
    
    $mh = curl_multi_init();
    curl_multi_add_handle($mh,$curl1);
    curl_multi_add_handle($mh,$curl2);
    
    $running = null;
    do {
      curl_multi_exec($mh, $running);
    } while ($running);
    
    curl_multi_remove_handle($mh, $curl1);
    curl_multi_remove_handle($mh, $curl2);
    curl_multi_close($mh);
    
    //Respuestas
    $resp = curl_multi_getcontent($curl1);
    $respact = curl_multi_getcontent($curl2);
    
    
    $actSitio = count(json_decode($resp, true));
    $actValorpaquete = json_decode($respact, true);
    
    $arrayResp = (object) array('numactsitio' => $actSitio, 'valorPaquete' => $actValorpaquete['ac_valorpaquete']);
    echo json_encode($arrayResp,true);
     
 }
 
?>