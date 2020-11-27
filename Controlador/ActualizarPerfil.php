<?php
session_start();
require_once("../Modelo/DBUsuario.php");
$objetoUsuario = new DBUsuario();
$fechaHoraActualizacion = date('Y-m-d h:i:s');
if(false){
    header("Location:../Vista/CiDuplicado.php");
}else{
    $exitoRegistro = $objetoUsuario->actualizarPerfil(
        $_SESSION['idUsuario'],
        ucwords(strtolower($_REQUEST['primerNombre'])),
        ucwords(strtolower($_REQUEST['segundoNombre'])),
        ucwords(strtolower($_REQUEST['primerApellido'])),
        ucwords(strtolower($_REQUEST['segundoApellido'])),
        $_REQUEST['ci'],
        //$_REQUEST['rol'],
        $_REQUEST['telefono'],
        $archivo,
        $fechaHoraActualizacion
        //$usuario,
        //$hash,
        //$activo
    );
    if($exitoRegistro){
        echo "exito";
        /*$persona = $objetoUsuario->datosUsuarioUser($usuario);
        $asignacion = $objetoUsuario->datosAsignacion($_REQUEST['idUsuario']);
        
        $registro = $objetoUsuario->actualizarAsignacionCarrera($asignacion['idAsignacionCarrera'],$_REQUEST['carrera'],$persona['idPersona']);*/
        header("Location:../Vista/Exito.php?password=".$contrasenia);
    }else{
        echo "Error";
        //header("Location:../Vista/Error.php");
    }
}
?>