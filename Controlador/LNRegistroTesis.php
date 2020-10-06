<?php
session_start();
require_once("../Modelo/DBUsuario.php");
$objetoUsuario = new DBUsuario();
$exitoRegistro = $objetoUsuario->registrarInforme($_SESSION['titulo'],
                                                    $_REQUEST['tipoBibliografia'],
                                                    $_REQUEST['fechaHoraRegistro'],
                                                    $_REQUEST['resumen'],
                                                    $_REQUEST["introduccion"],
                                                    $_REQUEST["imagenTapa"],
                                                    $_REQUEST['grupoPequenio'],
                                                    $_REQUEST['recepcionSabado']);
if($exitoRegistro){
    include("../Vista/Exito.php");
}else{
    include("../Vista/Error.php");
}
?>