<?php
session_start();
include_once("plantillas/navBar.php");
require_once("../Controlador/LNListaParticipante.php");
$participante = new LNListaParticipante();
$datosParticipante = $participante->datosParticipante($_REQUEST['idParticipante']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
        <link rel="stylesheet" href="../css/style.css">
    <title>Document</title>
</head>
<body>
    <div class="container mt-3 mb-3 rounded pt-3 pb-3">
    <div class="card card-secondary bg-dark text-center w-75 mx-auto d-block">
            <div class="card-header bg-main text-light">
                <h3>Edicion Usuario</h3>
            </div>
            <div class="card-body border-secondary bg-light text-left">
                <form action="../Controlador/LNActualizarParticipante.php" method="POST" class="was-validated" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-lg-6 mt-3">
                            <label for="primerNombre">Primer Nombre:</label>
                            <input type="text" id="primerNombre" name="primerNombre" class="form-control bb text" value="<?php echo $datosParticipante['primerNombre']?>" placeholder="Primer Nombre" pattern="[A-Za-z0-9\s]{3,12}" title="Use solo letras y son requeridos 3 caracteres minimos, 12 maximo" required>
                            <div class="invalid-feedback text-left">
                                Primer nombre. Complete solo con letras minimamente 3.
                            </div>
                        </div>
                        <div class="col-lg-6 mt-3">
                        <label for="segundoNombre">Segundo Nombre:</label>
                            <input type="text" id="segundoNombre" name="segundoNombre" class="form-control" value="<?php echo $datosParticipante['segundoNombre']?>" placeholder="Segundo Nombre" pattern="[A-Za-z0-9\s]{3,12}" title="Use solo letras y son requeridos 3 caracteres minimos, 12 maximo">
                            <div class="invalid-feedback text-left">
                                Segundo nombre. Complete solo con letras minimamente 3.
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 mt-3">
                            <label for="primerApellido">Primer Apellido:</label>
                            <input type="text" id="primerApellido" name="primerApellido" class="form-control" value="<?php echo $datosParticipante['primerApellido']?>" placeholder="Primer Apellido" required pattern="[A-Za-z0-9\s]{3,12}" title="Use solo letras y son requeridos 3 caracteres minimos, 12 maximo">
                            <div class="invalid-feedback text-left">
                                Primer apellido. Complete solo con letras minimamente 3.
                            </div>
                        </div>
                        <div class="col-lg-6 mt-3">
                            <label for="segundoApellido">Segundo Apellido:</label>
                            <input type="text" id="segundoApellido" name="segundoApellido" class="form-control" value="<?php echo $datosParticipante['segundoApellido']?>" placeholder="Segundo Apellido" required pattern="[A-Za-z0-9\s]{3,12}" title="Use solo letras y son requeridos 3 caracteres minimos, 12 maximo">
                            <div class="invalid-feedback text-left">
                                Segundo apellido. Complete solo con letras minimamente 3.
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 mt-3">
                            <label for="ci">CI:</label>
                            <input type="text" id="ci" name="ci" class="form-control" value="<?php echo $datosParticipante['ci']?>" placeholder="CI" required pattern="[0-9\s]{6,8}-[A-Z]{3,4}" title="Ingrese un numero de 5 hasta 10 caracteres">
                            <div class="invalid-feedback">CI. Use solo numeros. Entre 5 y 10 caracteres por favor.</div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 mt-3">
                            <label for="inputGroupFile01">Fotografia:</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="fotografia" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01" lang="es" required>
                                <label class="custom-file-label text-left" for="inputGroupFile01">Fotografia en formato png, jpg o jpeg</label>
                                <div class="invalid-feedback">Fotografia. Elija una fotografia en formato png, jpg o jpeg</div>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="idParticipante" value="<?php echo $_REQUEST['idParticipante']?>">
                    <div class="row">
                        <div class="col-lg-6 mt-4">
                            <a href="ListaUsuarios.php" class="btn btn-block btn-dark">Cancelar</a>
                        </div>
                        <!--<div class="col-lg-4 mt-3">
                            <input type="reset" value="Limpiar" class="btn btn-block bg-s-second">
                        </div>-->
                        <div class="col-lg-6 mt-4">
                            <input type="submit" value="Registrar" class="btn btn-block btn-danger">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>