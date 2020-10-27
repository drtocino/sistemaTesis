<?php
$user = $_REQUEST["user"];
$pass = $_REQUEST["pass"];
require_once("../Modelo/DBUsuario.php");
$objUsuario = new DBUsuario();
$success = $objUsuario->autentificacion($user);
echo $pass;
var_dump($success);
if(!$pass){
    session_start();
    $_SESSION['idUsuario']=0;
    header('Location:../Vista/ListaTesis.php');
}
if($success){
    $datos = $objUsuario->datosUsuarioUser($user);
    if(password_verify($pass,$datos['contrasenia'])){
        echo "exito";
        session_start();
        $_SESSION["idUsuario"] = $datos["idPersona"];
        $_SESSION['idRol'] = $datos['idRol'];
        echo $datos['idPersona'];
        //$_SESSION["last_action_timestamp"] = time();
        header('Location:../Vista/Home.php');
    }else{
        echo "Error en contrasenia";
        header("Location:../Vista/ErrorPassword.php");
    }
}elseif(!$pass){
    session_start();
    $_SESSION['idUsuario']=0;
    header('Location:../Vista/ListaTesis.php');
}else{
    header('Location:..');
}


?>