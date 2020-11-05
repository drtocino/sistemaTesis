<?php
session_start();
require_once("../Controlador/LNListaUsuario.php");
$listaUsuarios = new LNListaUsuario();
$usuario = $listaUsuarios->datosUsuario($_REQUEST['idUsuario']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <!-- <link rel="stylesheet" href="../css/jquery.dataTables.min.css">-->
    <title>Detalle de Usuario</title>
</head>
<style>
    img{
        max-height:90%;
        max-width:70%;
        min-height:70%;
    }
    .img-op{
        max-height:90%;
        max-width:70%;
        min-height:70%;
        opacity:0.6;
    }
    .card{
        height:100%;
    }
</style>
<body>
    <?php if($_SESSION['idUsuario']){?>
            <?php include("plantillas/navBar.php");?>
    <?php }else{?>
            <?php header('Location:Salir.php');?>
    <?php }?>
    <div class="container mt-3 mb-3 pt-3 pb-3 bg-s-second rounded">
        <h1>Detalle de Usuario</h1>
        <div class="row">
            <div class="col-sm-6 mt-3">
                <h5 class="bg-light p-2 rounded"><strong>Nombres: </strong><?php echo $usuario['nombres']?></h5>
                <h5 class="bg-light p-2 rounded"><strong>Usuario: </strong><?php echo $usuario['usuario']?></h5>
                <h5 class="bg-light p-2 rounded"><strong>CI: </strong><?php echo $usuario['ci']?></h5>
                <h5 class="bg-light p-2 rounded"><strong>Rol: </strong><?php switch($usuario['idRol']){ case 1:echo "Administrador";break;case 2:echo "Docente";break;case 3:echo "Estudiante";break;}?></h5>
                <h5 class="bg-light p-2 rounded"><strong>Estado: </strong><?php if($usuario['activo']) echo "Activo"; else echo "Inactivo"?></h5>
                <h5 class="bg-light p-2 rounded"><strong>Fecha de Registro: </strong><?php echo $usuario['fechaRegistro']?></h5>
                <?php if($usuario['fechaActualizacion']!="0000-00-00 00:00:00"){?>
                <h5 class="bg-light p-2 rounded"><strong>Fecha de Actualizacion: </strong><?php echo $usuario['fechaActualizacion']?></h5>
                <?php }else{?>
                    <h5 class="bg-light p-2 rounded"><strong>Fecha de Actualizacion: </strong>----</h5>
                <?php }?>
            </div>
            <div class="col-sm-6 mt-3">
                <?php if($usuario['fotografia']){?>
                <img src="<?php echo $usuario['fotografia']?>" class="mx-auto d-block img" alt="" srcset="">
                <?php }else{?>
                <img class="mx-auto d-block img-op" src="892795.svg" alt="">
                <h5 class="text-center text-secondary">Sin fotografia</h5>
                <?php }?>
            </div>
        </div>
    </div>
    <script src="../js/jquery-3.5.1.min.js"></script>
    <script src="../js/popper.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
</body>
</html>