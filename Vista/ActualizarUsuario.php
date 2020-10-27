<?php
require_once("../Controlador/LNListaCarrera.php");
require_once("../Controlador/LNListaUsuario.php");
$carreras = new LNListaCarrera();
$lista = $carreras->listaCarreras();
$usuarios = new LNListaUsuario();
$usuario = $usuarios->datosUsuario($_REQUEST['idUsuario']);
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../css/bootstrap.min.css">
        <link rel="stylesheet" href="../css/style.css">
        <title>Edicion de Usuario</title>
    </head>
    <body>
    <?php include("plantillas/navBar.php");?>
    <div class="container mt-4 mb-4">
    <div class="card card-secondary bg-dark text-center w-75 mx-auto d-block">
            <div class="card-header bg-main text-light">
                <h3>Edicion Usuario</h3>
            </div>
            <div class="card-body border-secondary bg-light">
                <form action="../Controlador/LNRegistroUsuario.php" method="POST" class="was-validated" enctype="multipart/form-data">
                    <input type="text" name="primerNombre" class="form-control mt-3 bb text" value="<?php echo $usuario['primerNombre']?>" placeholder="Primer Nombre" pattern="[A-Za-z0-9\s]{3,12}" title="Use solo letras y son requeridos 3 caracteres minimos, 12 maximo" required>
                    <input type="text" name="segundoNombre" class="form-control mt-3" value="<?php echo $usuario['segundoNombre']?>" placeholder="Segundo Nombre" pattern="[A-Za-z0-9\s]{3,12}" title="Use solo letras y son requeridos 3 caracteres minimos, 12 maximo">
                    <input type="text" name="primerApellido" class="form-control mt-3" value="<?php echo $usuario['primerApellido']?>" placeholder="Primer Apellido" required pattern="[A-Za-z0-9\s]{3,12}" title="Use solo letras y son requeridos 3 caracteres minimos, 12 maximo">
                    <input type="text" name="segundoApellido" class="form-control mt-3" value="<?php echo $usuario['segundoApellido']?>" placeholder="Segundo Apellido" required pattern="[A-Za-z0-9\s]{3,12}" title="Use solo letras y son requeridos 3 caracteres minimos, 12 maximo">
                    <input type="text" name="ci" class="form-control mt-3" value="<?php echo $usuario['ci']?>" placeholder="CI" required pattern="[0-9\s]{5,10}" title="Ingrese un numero de 5 hasta 10 caracteres">
                    <select name="rol" id="" class="custom-select mt-3" required>
                        <option value="<?php echo $usuario['idRol']?>" selected><?php if($usuario['idRol']==1)echo "Administrador"; elseif($usuario['idRol']==2)echo "Docente";?></option>
                        <option value="1">Administrador</option>
                        <option value="2">Docente</option>
                        <option value="3">Estudiante</option>
                    </select>
                    <!--<select name="carrera" id="carrera" class="custom-select mt-3" required>
                        <option value="" selected></option>
                        <?php foreach($lista as $datos){?>
                        <option value="<?php echo $datos['idCarrera']?>"><?php echo $datos['nombre']?></option>
                        <?php }?>
                    </select>-->
                    <input type="text" class="form-control mt-3" name="telefono" value="<?php echo $usuario['telefono']?>" id="" placeholder="Telefono" required pattern="[0-9\s]{6,8}" title="Ingrese un numero de 6 hasta 8 caracteres">
                    <!--<div class="custom-file mt-3">
                        <input type="file" class="custom-file-input" name="fotografia" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01" lang="es" required>
                        <label class="custom-file-label text-left" for="inputGroupFile01">Fotografia de la persona en formato png, jpg o jpeg</label>
                    </div>>-->
                    <input type="submit" value="Registrar" class="btn btn-block btn-danger mt-3">
                </form>
            </div>
    </div>
</body>
</html>