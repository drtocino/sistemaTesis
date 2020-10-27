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
    <div class="container mt-3 mb-3 pt-3 pb-3 bg-light rounded">
        <h1>Detalle de Usuario</h1>
        <div class="row">
            <div class="col-sm-6 mt-3">
                <div class="card border-0 rounded bg-s-main">
                    <div class="card-header bg-main border-0 text-light">
                        <h5>Datos Generales</h5>
                    </div>
                    <div class="card-body bg-s-main">
                        <strong>Nombres: </strong><?php echo $usuario['nombres']?><br>
                        <strong>Usuario: </strong><?php echo $usuario['usuario']?><br>
                        <strong>CI: </strong><?php echo $usuario['ci']?><br>
                        <strong>Rol: </strong><?php switch($usuario['idRol']){ case 1:echo "Administrador";break;case 2:echo "Docente";break;case 3:echo "Estudiante";break;}?><br>
                        <strong>Estado: </strong><?php if($usuario['activo']) echo "Activo"; else echo "Inactivo"?><br>
                        <strong>Fecha de Registro: </strong><?php echo $usuario['fechaRegistro']?><br>
                        
                    </div>
                </div>
            </div>
            <div class="col-sm-6 mt-3">
                <div class="card border-0">
                    <div class="card-header bg-main text-light">
                        <h5>Fotografia</h5>
                    </div>
                    <div class="card-body bg-s-main">
                        <img src="<?php echo $usuario['fotografia']?>" class="mx-auto d-block img" alt="" srcset="">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="../js/jquery-3.5.1.min.js"></script>
    <script src="../js/popper.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
</body>
</html>