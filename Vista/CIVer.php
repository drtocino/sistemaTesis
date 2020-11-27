<?php
session_start();
require_once("../Modelo/DBUsuario.php");
$usuario = new DBUsuario();
$datosUsuario = $usuario->datosUsuario($_SESSION['idUsuario']);
if(isset($_REQUEST['ci'])){
    $ciExiste = $usuario->ciExiste($_REQUEST['ci']);
    if($_REQUEST['ci'] == $datosUsuario['ci']){
        echo 0;
        return 0;
    }elseif($ciExiste){
        echo 1;
        return 1;
    }
    /*if($ciExiste){
        echo 1;
        return 1;
    }elseif($_REQUEST['ci'] == $datosUsuario['ci']){
        echo $datosUsuario['ci'];
        echo 0;
    }*/
}else{
    echo  0;
}
?>