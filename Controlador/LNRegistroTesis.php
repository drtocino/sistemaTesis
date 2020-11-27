<?php
session_start();
require_once("LNListaUsuario.php");
$usuario = new LNListaUsuario();
//echo $_FILES["imagenTapa"]["name"]."\n";
$directorio = "../img/";
$archivo = $directorio . basename($_FILES["imagenTapa"]["name"]);
$tipoArchivo = strtolower(pathinfo($archivo,PATHINFO_EXTENSION));
$size = getimagesize($_FILES["imagenTapa"]["tmp_name"]);
//echo $archivo ;
//var_dump($_FILES["imagenTapa"]);
require_once("../Modelo/DBTesis.php");
$objetoTesis = new DBTesis();
$fechaHoraRegistro = date('Y-m-d h:i:s');
$esImagen = getimagesize($_FILES['imagenTapa']['tmp_name']);
if($esImagen){
    $size = $_FILES['imagenTapa']['size'];
    if($size > 30000000){
        echo "El Documento debe ser menor a 30 mb";
    }else{
        if($tipoArchivo == 'jpg' || $tipoArchivo == 'jpeg' || $tipoArchivo == 'png'){
            if(move_uploaded_file($_FILES['imagenTapa']['tmp_name'], $archivo)){
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
$directorioDoc = "../documentos/";
$archivoDoc = $directorioDoc . basename($_FILES["documento"]["name"]);
$tipoArchivo = strtolower(pathinfo($archivoDoc,PATHINFO_EXTENSION));
echo $tipoArchivo;
//$size = getimagesize($_FILES["imagenTapa"]["tmp_name"]);
//echo $archivoDoc;
//var_dump($_FILES["imagenTapa"]);
//$esImagen = getimagesize($_FILES['imagenTapa']['tmp_name']);
$size = $_FILES['documento']['size'];
if($size > 30000000){
    echo "El Documento debe ser menor a 30 mb";
    }else{
        if($tipoArchivo == 'pdf'){
            if(move_uploaded_file($_FILES['documento']['tmp_name'], $archivoDoc)){
                echo "Documento Registrado correctamente";
            }else{
                echo "Ocurrio un error";
            }
        }
        else{
            echo "Solo se admiten archivos pdf";
        }
    }
    $idAsignacionCarrera = 126;
$codigoTesis = "TES";
switch($_REQUEST['facultad']){
    case 1:
        $codigoTesis .= "-FING";
        switch ($_REQUEST['carrer']) {
            case 1:
                $codigoTesis .= "-INSI";
                break;
            case 2:
                $codigoTesis .= "-RETE";
            break;
            case 3:
                $codigoTesis .= "-INAN";
            break;
            default:
                # code...
                break;
        }
    break;
    case 2:
        $codigoTesis .= "-FSAL";
        switch($_REQUEST['carrera']){
            case 7:
                $codigoTesis .= "-CANU";
            break;
            case 8:
                $codigoTesis .= "-FIKI";
            break;
            case 9:
                $codigoTesis .= "-CENF";
            break;
            case 10:
                $codigoTesis .= "-FARM";
            break;
        }
    break;
    case 3:
        $codigoTesis .= "-FHUM";
        switch($_REQUEST['carrera']){
            case 4:
                $codigoTesis .= "-PSIC";
            break;
            case 5:
                $codigoTesis .= "-PEDA";
            break;
            case 6:
                $codigoTesis .= "-CILI";
            break;
        }
    break;
    case 4:
        $codigoTesis .= "-FCEA";
        switch($_REQUEST['carrera']){
            case 11:
                $codigoTesis .= "-ADMI";
            break;
            case 12:
                $codigoTesis .= "-COPU";
            break;
            case 13:
                $codigoTesis .= "-INCO";
            break;
        }
    break;
}

echo $codigoTesis;
/*
$asignacion = $usuario->datosAsignacionCarrera($_REQUEST['persona'],$_REQUEST['carrera']);
$idAsignacionCarrera = $asignacion['idAsignacionCarrera'];*/
$asignacionUsuario = $usuario->datosAsignacion($_REQUEST['persona']);
$idAsignacionCarrera = $asignacionUsuario['idAsignacionCarrera'];

$exitoRegistro = $objetoTesis->registrarTesis(
$idAsignacionCarrera,
$_REQUEST['titulo'],
$_REQUEST['tipoBibliografia'],
$codigoTesis,
$fechaHoraRegistro,
$_REQUEST['resumen'],
$_REQUEST["introduccion"],
$_REQUEST['palabrasClave'],
$archivo);
var_dump($asignacionUsuario);
if($exitoRegistro){
    $idDocumentoTesis = $objetoTesis->ultimoIdTesis();
    $registroParticipantes = $objetoTesis->registrarParticipantesTesis($idDocumentoTesis['id'],$_REQUEST['persona'],$_REQUEST['asesor'],1);
    //header("Location:../Vista/Exito.php");
    echo "Success";
}else{
    //header("Location:../Vista/Error.php");
    $idDocumentoTesis = $objetoTesis->ultimoIdTesis();
    echo $idDocumentoTesis['id'];
    $registroParticipantes = $objetoTesis->registrarParticipantesTesis($idDocumentoTesis['id'],$_REQUEST['persona'],$_REQUEST['asesor'],1);
    echo "Error";
}
?>