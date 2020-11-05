<?php
$directorio = "../perfil/";
$archivo = $directorio . basename($_FILES["fotografia"]["name"]);
$tipoArchivo = strtolower(pathinfo($archivo,PATHINFO_EXTENSION));
$size = getimagesize($_FILES["fotografia"]["tmp_name"]);
//echo $archivo ;
//var_dump($_FILES["imagenTapa"]);
require_once("../Modelo/DBUsuario.php");
$objetoUsuario = new DBUsuario();
$fechaHoraActualizacion = date('Y-m-d h:i:s');
$esImagen = getimagesize($_FILES['fotografia']['tmp_name']);
if($esImagen){
    $size = $_FILES['fotografia']['size'];
    if($size > 30000000){
        echo "El Documento debe ser menor a 30 mb";
    }else{
        if($tipoArchivo == 'jpg' || $tipoArchivo == 'jpeg' || $tipoArchivo == 'png'){
            if(move_uploaded_file($_FILES['fotografia']['tmp_name'], $archivo)){
                echo "Imagen Registrada correctamente";
            }else{
                echo "Ocurrio un error";
            }
        }
        else{
            header("Location:../Vista/ErrorImagen.php");
        }
    }
}else{
    header("Location:../Vista/ErrorImagen.php");
}


$datosUsuario = $objetoUsuario->datosUsuario($_REQUEST['idUsuario']);
/*$letra1 = substr($_REQUEST['primerNombre'], 0, 1);
$usuario = strtolower($letra1).strtolower($_REQUEST['primerApellido']);*/
$usuario = $_REQUEST['usuario'];
/*$persona = $objetoUsuario->datosUsuarioUser($usuario);
if($persona){
    $usuario .= "1";
}
/*if(){

}*/
$contrasenia = $_REQUEST['pass'];
$hash = password_hash($contrasenia,PASSWORD_DEFAULT,['cost' => 10]);
echo $ciExiste = $objetoUsuario->ciExiste($_REQUEST['ci']);
if($datosUsuario['ci'] == $_REQUEST['ci']){
    $ciExiste = 0;
}
$activo = $_REQUEST['activo'];

if($ciExiste){
    header("Location:../Vista/CiDuplicado.php");
}else{
    $exitoRegistro = $objetoUsuario->actualizarUsuario(
        $_REQUEST['idUsuario'],
        ucwords(strtolower($_REQUEST['primerNombre'])),
        ucwords(strtolower($_REQUEST['segundoNombre'])),
        ucwords(strtolower($_REQUEST['primerApellido'])),
        ucwords(strtolower($_REQUEST['segundoApellido'])),
        $_REQUEST['ci'],
        $_REQUEST['rol'],
        $_REQUEST['telefono'],
        $archivo,
        $fechaHoraActualizacion,
        $usuario,
        $hash,
        $activo
    );
    if($exitoRegistro){
        echo "exito";
        $persona = $objetoUsuario->datosUsuarioUser($usuario);
        $asignacion = $objetoUsuario->datosAsignacion($_REQUEST['idUsuario']);
        
        $registro = $objetoUsuario->actualizarAsignacionCarrera($asignacion['idAsignacionCarrera'],$_REQUEST['carrera'],$persona['idPersona']);
        header("Location:../Vista/Exito.php?password=".$contrasenia);
    }else{
        echo "Error";
        //header("Location:../Vista/Error.php");
    }
}
?>