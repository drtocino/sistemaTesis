<?php
session_start();
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
            echo "Solo se admiten archivos jpg o jpeg o png";
        }
    }
}else{
    echo "El documento no esta en una imagen"; 
}
$directorioDoc = "../documentos/";
$archivo = $directorioDoc . basename($_FILES["imagenTapa"]["name"]);
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
            echo "Solo se admiten archivos jpg o jpeg o png";
        }
    }
}else{
    echo "El documento no esta en una imagen"; 
}
$idAsignacionCarrera = 126;
$exitoRegistro = $objetoTesis->registrarTesis(  $idAsignacionCarrera,
                                                $_REQUEST['titulo'],
                                                $_REQUEST['tipoBibliografia'],
                                                $fechaHoraRegistro,
                                                $_REQUEST['resumen'],
                                                $_REQUEST["introduccion"],
                                                $directorio);
if($exitoRegistro){
    //header("Location:../Vista/Exito.php");
    echo "Success";
}else{
    //header("Location:../Vista/Error.php");
    echo "Error";
}
?>