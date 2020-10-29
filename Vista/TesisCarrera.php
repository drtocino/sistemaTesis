<?php
session_start();
require_once("../Controlador/LNListaCarrera.php");
$objDatosCarrera = new LNListaCarrera();
$datos = $objDatosCarrera->tesisCarrera($_REQUEST['facultad']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <title>Tesis por Carrera</title>
</head>
<body>
<?php
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
?>
    <main>
        <div class="container mt-3 mb-3 pt-3 pb-3 bg-light rounded">
            <h1>Tesis por Carrera de <?php echo $datos[0]['fnombre']?></h1>
            <table class="table">
                <tr>
                    <th>Carrera</th>
                    <th class="text-center">Tesis</th>
                    <th></th>
                </tr>
                <?php foreach($datos as $dato){?>
                    <tr>
                        <td><?php echo $dato['nombre']?></td>
                        <td class="text-center"><?php echo $dato['documentos']?></td>
                        <td><a href="TesisCarreraModalidad.php?carrera=<?php echo $dato['idCarrera']?>" class="btn btn-dark">Por Modalidad</a></td>
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