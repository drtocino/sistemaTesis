<?php
require_once("../Modelo/DBParticipante.php");
$objetoParticipante= new DBParticipante();
$fechaHoraActualizacion = date('Y-m-d h:i:s');

$directorio = "../perfil/";
$archivo = $directorio . basename($_FILES["fotografia"]["name"]);
$tipoArchivo = strtolower(pathinfo($archivo,PATHINFO_EXTENSION));
$size = getimagesize($_FILES["fotografia"]["tmp_name"]);
//echo $archivo ;
//var_dump($_FILES["imagenTapa"]);
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

if(false){
    header("Location:../Vista/CiDuplicado.php");
}else{
    $exitoRegistro = $objetoParticipante->actualizarParticipante(
        $_REQUEST['idParticipante'],
        ucwords(strtolower($_REQUEST['primerNombre'])),
        ucwords(strtolower($_REQUEST['segundoNombre'])),
        ucwords(strtolower($_REQUEST['primerApellido'])),
        ucwords(strtolower($_REQUEST['segundoApellido'])),
        $_REQUEST['ci'],
        $archivo
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
?>