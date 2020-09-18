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
                    <th>Tesis</th>
                </tr>
                <?php foreach($datos as $dato){?>
                <tr>
                    <td><?php echo $dato['nombre']?></td>
                    <td><?php echo $dato['documentos']?></td>
                </tr>
                <?php }?>
            </table>
        </div>
    </main>
</body>
</html>