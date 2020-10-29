<?php
session_start();
require_once("../Controlador/LNListaUsuario.php");
$usuario = new LNListaUsuario();
$datosUsuario = $usuario->datosUsuario($_SESSION['idUsuario']);
if(!$_SESSION['idUsuario']){
    header('Location:Salir.php');
}
if($datosUsuario['idRol']==1){
    include_once("plantillas/navBar.php");
}elseif($datosUsuario['idRol']==2){
    include_once("plantillas/navBarDocente.php");
}elseif($datosUsuario['idRol']==3){
    header('Location:Home.php');
}
require_once("../Controlador/LNListaFacultad.php");
$objDatosFacultad = new LNListaFacultad();
$datos = $objDatosFacultad->reporteFacultad();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <title>Reporte Tesis Facultad</title>
</head>
<style>
    select{
        /*display:;*/
        width:100%;
        height:calc(1.5em + .75rem + 2px);
        padding:.375rem .75rem;
        font-size:1rem;
        font-weight:400;
        line-height:1.5;
        color:#495057;
        background-color:#fff;
        background-clip:padding-box;
        border:1px solid #ced4da;
        border-radius:.25rem;
        transition:border-color .15s ease-in-out,box-shadow .15s ease-in-out
    }
</style>
<body>
    <main>
        <div class="container mt-3 bg-white">
            <h1>Reporte de Cantidad de Tesis por Facultad</h1>
            <a href="ReporteFacultadFechas.php" class="btn btn-dark">Por Fecha</a>
            <div class="" id="datos"></div>
        </div>
    </main>
    <script src="../js/jquery-3.5.1.min.js"></script>
    <script type="text/javascript" src="../js/busqueda.js"></script>
    <script src="../js/jquery.dataTables.min.js"></script>
    <script src="../js/Chart.js"></script>
    <script>
        $(document).ready( function () {
            $('#group').DataTable();
        } );
    </script>
    <script>
        $(document).ready()
    </script>
</body>
</html>