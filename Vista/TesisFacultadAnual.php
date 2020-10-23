<?php
require_once("plantillas/navBar.php");
require_once("../Controlador/LNListaFacultad.php");
$objDatosFacultad = new LNListaFacultad();
$datos = $objDatosFacultad->reporteAnualFacultad($_REQUEST['facultad']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <title>Reporte Anual por Facultad</title>
</head>
<body>
    <main>
        <div class="container mt-3 mb-3 pt-3 pb-3 bg-light rounded">
            <h1>Reporte Anual de <?php echo $datos[0]['nombre']?></h1>
            <table class="table">
                <tr>
                    <th>Año</th>
                    <th class="text-center">Tesis</th>
                </tr>
                <?php foreach($datos as $dato){?>
                    <tr>
                        <td><?php echo $dato['anio']?></td>
                        <td class="text-center"><?php echo $dato['documentos']?></td>
                    </tr>
                <?php }?>
            </table>
            <div class="grafico">
                <canvas id="chart1"></canvas>
            </div>
        </div>
    </main>
    <script src="../js/jquery-3.5.1.min.js"></script>
    <script type="text/javascript" src="../js/busqueda.js"></script>
    <script src="../js/jquery.dataTables.min.js"></script>
    <script src="../js/Chart.js"></script>
    <script>
        var ctx= document.getElementById("chart1").getContext("2d");
        var Torta= new Chart(ctx,{
            type:"pie",
            data:{
                labels:[
                    <?php foreach($datos as $datoN){?>
                        '<?php echo $datoN['anio']?>',
                    <?php }?>
                ],
                datasets:[{
                    label:"Datos",
                    data:[
                        <?php foreach($datos as $datoD){?>
                            <?php echo $datoD['documentos']?>,
                        <?php }?>
                    ],
                    backgroundColor:[
                        'rgb(0, 106, 113)',
                        'rgb(203, 234, 237)',
                        'rgb(211, 222, 50)',
                        'rgb(74, 74, 74)',
                    ]
                }]
            }
        });
    </script>
</body>
</html>