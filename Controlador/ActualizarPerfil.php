<?php
session_start();
require_once("../Modelo/DBUsuario.php");
$objetoUsuario = new DBUsuario();
echo $fechaHoraActualizacion = date('Y-m-d h:i:s');
$letra1 = substr($_REQUEST['primerNombre'], 0, 1);
$usuario = strtolower($letra1).strtolower($_REQUEST['primerApellido']);
$persona = $objetoUsuario->datosUsuarioUser($usuario);
$perfil = $objetoUsuario->datosUsuario($_SESSION['idUsuario']);
if($perfil['usuario'] != $usuario){
    if($persona){
        $usuario .= "1";
    }
    $exitoRegistro = $objetoUsuario->actualizarPerfil(
        $_SESSION['idUsuario'],
        ucwords(strtolower($_REQUEST['primerNombre'])),
        ucwords(strtolower($_REQUEST['segundoNombre'])),
        ucwords(strtolower($_REQUEST['primerApellido'])),
        ucwords(strtolower($_REQUEST['segundoApellido'])),
        $_REQUEST['ci'],
        $_REQUEST['telefono'],
        $usuario,
        $fechaHoraActualizacion
        //$hash,
    );
}else{
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
            $_REQUEST['telefono'],
            $usuario,
            $fechaHoraActualizacion
            //$hash,
        );
        if($exitoRegistro){
            echo "exito";
            /*$persona = $objetoUsuario->datosUsuarioUser($usuario);
            $asignacion = $objetoUsuario->datosAsignacion($_REQUEST['idUsuario']);
            
            $registro = $objetoUsuario->actualizarAsignacionCarrera($asignacion['idAsignacionCarrera'],$_REQUEST['carrera'],$persona['idPersona']);*/
            header("Location:../Vista/Exito.php");
        }else{
            echo "Error";
            header("Location:../Vista/Error.php");
        }
    }
}
?>