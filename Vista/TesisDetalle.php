<?php
session_start();
if(!isset($_SESSION['idUsuario'])){
    header('Location:Salir.php');
}elseif($_SESSION['idUsuario']===1){
    include_once("plantillas/navBar.php");
}
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
<style>
    .info-card{
        height:35rem;
    }
    img{
        height:25rem;
    }
</style>
<body>
    <main>
        <div class="container">

            <div class="row mt-3">
                <div class="col-sm-6">
                    <div class="card text-white bg-dark info-card">
                        <h5 class="card-header">Datos Generales</h5>
                        <div class="card-body">
                            <h5 class="card-title"><span><?php echo $datos['titulo']?></span></h5>
                            <p class="card-text">Autor: <?php echo $datos['autor']?></p>
                            <p>Fecha y Hora: <?php echo $datos['fechaHoraRegistro']?></p>
                            <p>Tipo de Bibliografía: <?php echo $datos['tipoTesis']?></p>
                            <p>Facultad: <?php echo $datos['facultad']?></p>
                            <p>Carrera: <?php echo $datos['carrera']?></p>
                            <p>Código de la Tesis: <?php echo $datos['codigoTesis']?></p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="card text-white bg-dark info-card">
                        <h5 class="card-header">Tapa de Tesis</h5>
                        <div class="card-body">
                            <h5 class="card-title"></h5>
                            <p class="card-text"></p>
                            <img class="mx-auto d-block" src="<?php echo $datos['imagenTapaTesis']?>" alt="image">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-4 mb-4">
                <div class="col-sm-12">
                    <div class="card text-white bg-dark">
                        <h5 class="card-header">Resumen</h5>
                        <div class="card-body">
                        <p><?php echo $datos['resumen']?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>
</html>