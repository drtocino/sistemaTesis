<?php
session_start();
require_once("../Controlador/LNListaUsuario.php");
$listaUsuarios = new LNListaUsuario();
$usuario = $listaUsuarios->datosUsuario($_SESSION['idUsuario']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <!-- <link rel="stylesheet" href="../css/jquery.dataTables.min.css">-->
    <title><?php echo $usuario['nombres']?></title>
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
<?php
if($_SESSION['idUsuario']){
    if($usuario['idRol']==1){
        include_once("plantillas/navBar.php");
    }elseif($usuario['idRol']==2){
        include_once("plantillas/navBarDocente.php");
    }elseif($usuario['idRol']==3){
        include_once("plantillas/navBarEstudiante.php");
    }
}else{
    header("Location:Salir.php");
}
?>
    <div class="container mt-3 mb-3 pt-3 pb-3 bg-s-second rounded">
        <h1>Datos Personales</h1>
        <div class="row">
            <div class="col-sm-6 mt-3">
                <h5 class="bg-light text-dark rounded p-2"><strong>Nombres: </strong><?php echo $usuario['nombres']?></h5>
                <h5 class="bg-light text-dark rounded p-2"><strong>Usuario: </strong><?php echo $usuario['usuario']?></h5>
                <h5 class="bg-light text-dark rounded p-2"><strong>CI: </strong><?php echo $usuario['ci']?></h5>
                <h5 class="bg-light text-dark rounded p-2"><strong>Rol: </strong><?php switch($usuario['idRol']){ case 1:echo "Administrador";break;case 2:echo "Docente";break;case 3:echo "Estudiante";break;}?></h5>
                <h5 class="bg-light text-dark rounded p-2"><strong>Estado: </strong><?php if($usuario['activo']) echo "Activo"; else echo "Inactivo"?></h5>
                <h5 class="bg-light text-dark rounded p-2"><strong>Fecha de Registro: </strong><?php echo $usuario['fechaRegistro']?></h5>
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