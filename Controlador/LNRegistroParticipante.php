<?php
require_once("../Modelo/DBParticipante.php");
$participante = new DBParticipante();
$imagen="hola";
$exitoRegistro = $participante->registroParticipante(
    ucwords(strtolower($_REQUEST['primerNombre'])),
    ucwords(strtolower($_REQUEST['segundoNombre'])),
    ucwords(strtolower($_REQUEST['primerApellido'])),
    ucwords(strtolower($_REQUEST['segundoApellido'])),
    $_REQUEST['ci'],
    $imagen
);
if($exitoRegistro){
    echo "Exito";
    header("Location:../Vista/Exito.php");
}else{
    echo "Error";
    header("Location:../Vista/Error.php");
}

?>