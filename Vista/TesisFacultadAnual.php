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
        <div class="container">
            <h1>Reporte Anual de <?php echo $datos[0]['nombre']?></h1>
            <table class="table">
                <tr>
                    <th>Año</th>
                    <th>Tesis</th>
                </tr>
                <?php foreach($datos as $dato){?>
                    <tr>
                        <td><?php echo $dato['anio']?></td>
                        <td><?php echo $dato['documentos']?></td>
                    </tr>
                <?php }?>
            </table>
        </div>
    </main>
</body>
</html>