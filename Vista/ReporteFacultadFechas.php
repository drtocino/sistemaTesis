<?php
date_default_timezone_set('UTC');
session_start();
if(!$_SESSION['idUsuario']){
    header('Location:Salir.php');
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
    <?php require_once("plantillas/navBar.php");?>
    <main>
        <div class="container pt-3 pb-3 mb-3 mt-3 bg-light rounded">
            <h1>Reporte de Cantidad de Tesis por Facultad</h1>
            <div class="input-group mt-3 mb-3">
                <input type="date" class="form-control" placeholder="Busqueda" title="Escriba solo una palabra por favor" name="buscar" id="fechaInicio">
                <input type="date" class="form-control" placeholder="Busqueda" title="Escriba solo una palabra por favor" value="<?php echo date('Y-m-d');?>" name="buscar" id="fechaFin">
            </div>
            <div class="" id="datos"></div>
            
            <!--<table class="table">
                <tr>
                    <th>Facultad</th>
                    <th>Tesis</th>
                    <th></th>
                    <th></th>
                </tr>
                <?php/* foreach($datos as $dato){?>
                <tr>
                    <td><a><?php echo $dato['nombre']?></a></td>
                    <td><?php echo $dato['documentos']?></td>
                    <td><a href="TesisCarrera.php?facultad=<?php echo $dato['idFacultad']?>" class="btn btn-dark">Por Carrera</a></td>
                    <td><a href="TesisFacultadAnual.php?facultad=<?php echo $dato['idFacultad']?>" class="btn btn-success">Reporte Anual</a></td>
                </tr>
                <?php //}*/?>
            </table>-->
            
        </div>
    </main>
    <script src="../js/jquery-3.5.1.min.js"></script>
    <script type="text/javascript" src="../js/buscadorFechas.js"></script>
    <script src="../js/jquery.dataTables.min.js"></script>
    <script src="../js/Chart.js"></script>
    <script>
        /*$(document).ready( function () {
            $('#group').DataTable();
        } );*/
    </script>
    <script>
        /*var ctx= document.getElementById("chart1").getContext("2d");
        var Torta= new Chart(ctx,{
            type:"pie",
            data:{
                labels:['Ingenieros','Empresarios','Maestros'],
                datasets:[{
                    label:"Num Datos",
                    data:[20,10,30],
                    backgroundColor:[
                        'rgb(207, 117, 0)',
                        'rgb(51, 51, 51)',
                        'rgb(230, 230, 230)'
                    ]
                }]
            }
        });*/
    </script>
    <script>
        $(document).ready()
    </script>
</body>
</html>