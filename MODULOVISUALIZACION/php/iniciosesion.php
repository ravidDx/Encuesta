<?php

session_start();

if($_POST){
	
    $_SESSION['proveedor'] = $_POST['proveedor'];
}

 print json_encode($_SESSION['proveedor']);
?>