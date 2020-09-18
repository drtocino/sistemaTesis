<?php
require_once("plantillas/navBar.php");
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
    <main>
        <div class="container">
            <h1>Tesis por Carrera de <?php echo $datos[0]['fnombre']?></h1>
            <table class="table">
                <tr>
                    <th>Carrera</th>
                    <th>Tesis</th>
                    <th></th>
                </tr>
                <?php foreach($datos as $dato){?>
                    <tr>
                        <td><?php echo $dato['nombre']?></td>
                        <td><?php echo $dato['documentos']?></td>
                        <td><a href="TesisCarreraModalidad.php?carrera=<?php echo $dato['idCarrera']?>" class="btn btn-dark">Por Modalidad</a></td>
                    </tr>
                <?php }?>
            </table>
        </div>
    </main>
</body>
</html>