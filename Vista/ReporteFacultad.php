<?php
require_once("plantillas/navBar.php");
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
    <link rel="stylesheet" href="../css/style.css">
    <title>Reporte Tesis Facultad</title>
</head>
<body>
    <main>
        <div class="container">
            <h1>Reporte de Cantidad de Tesis por Facultad</h1>
            <table class="table">
                <tr>
                    <th>Facultad</th>
                    <th>Cantidad de Tesis</th>
                </tr>
                <?php foreach($datos as $dato){?>
                <tr>
                    <td><a href="TesisCarrera.php?facultad=<?php echo $dato['idFacultad']?>"><?php echo $dato['nombre']?></a></td>
                    <td><?php echo $dato['documentos']?></td>
                </tr>
                <?php }?>
            </table>
        </div>
    </main>
</body>
</html>