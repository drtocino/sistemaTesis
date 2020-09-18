<?php
include_once("plantillas/navBar.php");
include_once("../Controlador/LNListaTesis.php");
$objListaTesis = new LNListaTesis();
$datos = $objListaTesis->detalleTesis($_REQUEST['idTesis']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <title>Tesis Detalle</title>
</head>
<body>
    <main>
        <div class="container">
            <h1><?php echo $datos['titulo']?></h1>
            <span>Autor: <?php echo $datos['autor']?></span><br>
            <span>Titulo: <?php echo $datos['titulo']?></span><br>
            <span>Fecha: <?php echo $datos['fechaHoraRegistro']?></span><br>
            <span>Tipo de Bibliografía: <?php echo $datos['tipoTesis']?></span><br>
            <span>Facultad: <?php echo $datos['facultad']?></span><br>
            <span>Carrera: <?php echo $datos['carrera']?></span><br>
            <span>Resumen: <?php echo $datos['resumen']?></span><br>
            <span>Código de la Tesis: <?php echo $datos['codigoTesis']?></span><br>
            <span>Tapa de la Tesis: <?php echo $datos['imagenTapaTesis']?></span><br>
        </div>
    </main>
</body>
</html>