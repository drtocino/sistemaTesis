<?php
require_once("plantillas/navBar.php");
require_once("../Controlador/LNListaCarrera.php");
$objDatosCarrera = new LNListaCarrera();
$datos = $objDatosCarrera->tesisCarreraModalidad($_REQUEST['carrera']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <title>Tesis de Carrera por Modalidad</title>
</head>
<body>
    <main>
        <div class="container">
            <h1>Tesis por Modalidad de <?php echo $datos[0]['carrera']?></h1>
            <table class="table">
                <tr>
                    <th>Modalidad</th>
                    <th class="text-center">Tesis</th>
                </tr>
                <?php foreach($datos as $dato){?>
                <tr>
                    <td><a href="ListaTesisCarrera.php"><?php echo $dato['nombre']?></a></td>
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
                        '<?php echo $datoN['nombre']?>',
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
                        'rgb(240, 165, 0)',
                        'rgb(51, 51, 51)',
                        'rgb(200, 200, 200)'
                    ]
                }]
            }
        });
    </script>
</body>
</html>