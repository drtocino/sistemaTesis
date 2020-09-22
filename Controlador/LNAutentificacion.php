<?php
$user = $_REQUEST["user"];
$pass = $_REQUEST["pass"];
require_once("../Modelo/DBUsuario.php");
$objUsuario = new DBUsuario();
$success = $objUsuario->autentificacion($user,$pass);
echo $pass;
if(!$pass){
    ?>
    
    <?php
    session_start();
    $_SESSION['idUsuario']=0;
    header('Location:../Vista/ListaTesis.php');
}
if($success){
    $datos = $objUsuario->datosUsuarioUser($user);
    session_start();
    $_SESSION["idUsuario"] = $datos["idPersona"];
    echo $datos['idPersona'];
    //$_SESSION["last_action_timestamp"] = time();
    header('Location:../Vista/Home.php');
}elseif(!$pass){
    session_start();
    $_SESSION['idUsuario']=0;
    header('Location:../Vista/ListaTesis.php');
}else{
        header('Location:..');
}


?>