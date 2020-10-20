<?php
$directorio = "../perfil/";
$archivo = $directorio . basename($_FILES["fotografia"]["name"]);
$tipoArchivo = strtolower(pathinfo($archivo,PATHINFO_EXTENSION));
$size = getimagesize($_FILES["fotografia"]["tmp_name"]);
//echo $archivo ;
//var_dump($_FILES["imagenTapa"]);
require_once("../Modelo/DBUsuario.php");
$objetoUsuario = new DBUsuario();
$fechaHoraRegistro = date('Y-m-d h:i:s');
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
function generateRandomString($length = 8) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

$letra1 = substr($_REQUEST['primerNombre'], 0, 1);
$usuario = strtolower($letra1).strtolower($_REQUEST['primerApellido']);
$persona = $objetoUsuario->datosUsuarioUser($usuario);
if($persona){
    $usuario .= "1";
}
$contrasenia = generateRandomString();
//echo $contrasenia;
$hash = password_hash($contrasenia,PASSWORD_DEFAULT,['cost' => 10]);

$persona = $objetoUsuario->datosUsuarioUser($usuario);
//echo $persona['idPersona'];
$registro = $objetoUsuario->registrarAsignacionCarrera($_REQUEST['carrera'],$persona['idPersona']);

$exitoRegistro = $objetoUsuario->registrarUsuario(
    ucwords(strtolower($_REQUEST['primerNombre'])),
    ucwords(strtolower($_REQUEST['segundoNombre'])),
    ucwords(strtolower($_REQUEST['primerApellido'])),
    ucwords(strtolower($_REQUEST['segundoApellido'])),
    $_REQUEST['ci'],
    $_REQUEST['rol'],
    $_REQUEST['telefono'],
    $archivo,
    $fechaHoraRegistro,
    $usuario,
    $hash
);
if($exitoRegistro){
    echo "exito";
    header("Location:../Vista/Exito.php?password=".$contrasenia);
}else{
    echo "Error";
    header("Location:../Vista/Error.php");
}
?>