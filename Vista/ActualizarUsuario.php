<?php
session_start();
require_once("../Controlador/LNListaCarrera.php");
require_once("../Controlador/LNListaUsuario.php");
$carreras = new LNListaCarrera();
$lista = $carreras->listaCarreras();
$usuarios = new LNListaUsuario();
$usuario = $usuarios->datosUsuario($_REQUEST['idUsuario']);
$asignacion = $usuarios->datosAsignacion($_REQUEST['idUsuario']);
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
<style>
    .passInvalid{
        color: #dc3545;
        font-size: 13px;
    }
    #message {
        display:none;
        color: #000;
        position: relative;
        padding: 0px;
        margin-top: 10px;
        text-align:left;
        margin-left:2rem;
        }

        #message p {
        padding: 10px 35px;
        font-size: 18px;
        }

        .valid {
        color: #2cb320;
        }

        .valid:before {
        position: relative;
        left: -35px;
        content: "✔";
        }

        .invalid {
        color: #dc3545;
        }

        .invalid:before {
        position: relative;
        left: -35px;
        content: "✖";
        }
        #estado{
            color:black;
        }
</style>
<body>
<?php
if($_SESSION['idUsuario']){
    include("plantillas/navBar.php");
}else{
    header("Location:Salir.php");
}
?>
    <div class="container mt-4 mb-4">
    <div class="card card-secondary bg-dark text-center w-75 mx-auto d-block">
            <div class="card-header bg-main text-light">
                <h3>Edicion Usuario</h3>
            </div>
            <div class="card-body border-secondary bg-light text-left">
                <form action="../Controlador/LNActualizarUsuario.php" method="POST" class="was-validated" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-lg-6 mt-3">
                            <label for="primerNombre">Primer Nombre:</label>
                            <input type="text" id="primerNombre" name="primerNombre" class="form-control bb text" value="<?php echo $usuario['primerNombre']?>" placeholder="Primer Nombre" pattern="[A-Za-z0-9\s]{3,12}" title="Use solo letras y son requeridos 3 caracteres minimos, 12 maximo" required>
                            <div class="invalid-feedback text-left">
                                Primer nombre. Complete solo con letras minimamente 3.
                            </div>
                        </div>
                        <div class="col-lg-6 mt-3">
                        <label for="segundoNombre">Segundo Nombre:</label>
                            <input type="text" id="segundoNombre" name="segundoNombre" class="form-control" value="<?php echo $usuario['segundoNombre']?>" placeholder="Segundo Nombre" pattern="[A-Za-z0-9\s]{3,12}" title="Use solo letras y son requeridos 3 caracteres minimos, 12 maximo">
                            <div class="invalid-feedback text-left">
                                Segundo nombre. Complete solo con letras minimamente 3.
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 mt-3">
                            <label for="primerApellido">Primer Apellido:</label>
                            <input type="text" id="primerApellido" name="primerApellido" class="form-control" value="<?php echo $usuario['primerApellido']?>" placeholder="Primer Apellido" required pattern="[A-Za-z0-9\s]{3,12}" title="Use solo letras y son requeridos 3 caracteres minimos, 12 maximo">
                            <div class="invalid-feedback text-left">
                                Primer apellido. Complete solo con letras minimamente 3.
                            </div>
                        </div>
                        <div class="col-lg-6 mt-3">
                            <label for="segundoApellido">Segundo Apellido:</label>
                            <input type="text" id="segundoApellido" name="segundoApellido" class="form-control" value="<?php echo $usuario['segundoApellido']?>" placeholder="Segundo Apellido" required pattern="[A-Za-z0-9\s]{3,12}" title="Use solo letras y son requeridos 3 caracteres minimos, 12 maximo">
                            <div class="invalid-feedback text-left">
                                Segundo apellido. Complete solo con letras minimamente 3.
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 mt-3">
                            <label for="ci">CI:</label>
                            <input type="text" id="ci" name="ci" class="form-control" value="<?php echo $usuario['ci']?>" placeholder="CI" required pattern="[0-9\s]{5,10}" title="Ingrese un numero de 5 hasta 10 caracteres">
                            <div class="invalid-feedback">CI. Use solo numeros. Entre 5 y 10 caracteres por favor.</div>
                        </div>
                        <div class="col-lg-6 mt-3">
                            <label for="rol">Rol:</label>
                            <select name="rol" id="rol" class="custom-select" required>
                                <option value="<?php echo $usuario['idRol']?>" selected disabled><?php if($usuario['idRol']==1)echo "Administrador"; elseif($usuario['idRol']==2)echo "Docente";elseif($usuario['idRol']==3)echo "Estudiante";?></option>
                                <option value="1">Administrador</option>
                                <option value="2">Docente</option>
                                <option value="3">Estudiante</option>
                            </select>
                            <div class="invalid-feedback">Rol. Seleccione un rol de la lista por favor.</div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 mt-3">
                            <label for="contacto">Telefono:</label>
                            <input type="text" id="contacto" class="form-control" name="telefono" value="<?php echo $usuario['telefono']?>" placeholder="Telefono" required pattern="[0-9\s]{6,8}" title="Ingrese un numero de 6 hasta 8 caracteres">
                            <div class="invalid-feedback">Telefono. Use solo numeros. Entre 7 y 8 numeros por favor.</div>
                        </div>
                        <div class="col-lg-6 mt-3">
                            <label for="estado">Estado:</label>
                            <div id="estado">
                                <?php if($usuario['activo']){?>
                                <div class="custom-control custom-switch">
                                    <input type="radio" class="custom-control-input" id="customSwitch1" name="activo" value="1" checked>
                                    <label class="custom-control-label" for="customSwitch1">Activo</label>
                                </div>
                                <div class="custom-control custom-switch">
                                    <input type="radio" class="custom-control-input" id="customSwitch2" name="activo" value="0">
                                    <label class="custom-control-label" for="customSwitch2">Inactivo</label>
                                </div>
                                <?php }else{?>
                                <div class="custom-control custom-switch">
                                    <input type="radio" class="custom-control-input" id="customSwitch1" name="activo" value="1">
                                    <label class="custom-control-label" for="customSwitch1">Activo</label>
                                </div>
                                <div class="custom-control custom-switch">
                                    <input type="radio" class="custom-control-input" id="customSwitch2" name="activo" value="0" checked>
                                    <label class="custom-control-label" for="customSwitch2">Inactivo</label>
                                </div>
                                <?php }?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 mt-3">
                            <label for="usuario">Usuario</label>
                            <input type="text" name="usuario" id="usuario" placeholder="Usuario" class="form-control" value="<?php echo $usuario['usuario']?>" pattern="[A-Za-z0-9].{5,}" title="Ingrese el formato requerido por favor" required>
                            <div class="invalid-feedback">Usuario. Use letras, numero y caracteres. Minimamente 5 por favor.</div>
                        </div>
                        <div class="col-lg-6 mt-3">
                            <label for="password">Password:</label>
                            <input type="text" id="password" placeholder="Password" name="pass" class="form-control" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%^&*]).{8,}" title="Ingrese el formato requerido por favor+" required>
                            <div id="message">
                                <div class="passInvalid" id="mayuscula">Se requiere una mayuscula.</div>
                                <div class="passInvalid" id="minuscula">Se requiere una minuscula.</div>
                                <div class="passInvalid" id="especial">Se requiere un caracter especial.</div>
                                <div class="passInvalid" id="numero">Se requiere un numero.</div>
                                <div class="passInvalid" id="caracteres">Se requiere 8 caracteres minimamente.</div>
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-lg-12 mt-3">
                            <label for="inputGroupFile01">Fotografia:</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="fotografia" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01" lang="es" required>
                                <label class="custom-file-label text-left" for="inputGroupFile01">Fotografia en formato png, jpg o jpeg</label>
                            </div>
                            <div class="invalid-feedback">Fotografia. Elija una fotografia en formato png, jpg o jpeg</div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 mt-3">
                            <label for="carrera">Carrera:</label>
                            <select name="carrera" id="carrera" class="custom-select" required>
                                <option value="<?php echo $asignacion['idAsignacionCarrera']?>" disabled selected><?php echo $asignacion['carrera']?></option>
                                <?php foreach($lista as $datos){?>
                                <option value="<?php echo $datos['idCarrera']?>"><?php echo $datos['nombre']?></option>
                                <?php }?>
                            </select>
                            <div class="invalid-feedback">Carrera. Escoja una de la lista por favor</div>
                        </div>
                    </div>
                    <input type="hidden" name="idUsuario" value="<?php echo $_REQUEST['idUsuario']?>">
                    <div class="row">
                        <div class="col-lg-6 mt-3">
                            <a href="ListaUsuarios.php" class="btn btn-block btn-dark">Cancelar</a>
                        </div>
                        <!--<div class="col-lg-4 mt-3">
                            <input type="reset" value="Limpiar" class="btn btn-block bg-s-second">
                        </div>-->
                        <div class="col-lg-6 mt-3">
                            <input type="submit" value="Registrar" class="btn btn-block btn-danger">
                        </div>
                    </div>
                </form>
            </div>
    </div>
<script>
var pass = document.getElementById("password");

var letter = document.getElementById("minuscula");
var capital = document.getElementById("mayuscula");
var number = document.getElementById("numero");
var special = document.getElementById("especial");
var eight = document.getElementById("caracteres");

    pass.onfocus = function() {
    document.getElementById("message").style.display = "block";
    pass.onkeyup = function() {
        var lowerCaseLetters = /[a-z]/g;
        if(pass.value.match(lowerCaseLetters)) {  
        letter.classList.remove("invalid");
        letter.classList.add("valid");
        } else {
        letter.classList.remove("valid");
        letter.classList.add("invalid");
        }

        var upperCaseLetters = /[A-Z]/g;
        if(pass.value.match(upperCaseLetters)) {  
        capital.classList.remove("invalid");
        capital.classList.add("valid");
        } else {
        capital.classList.remove("valid");
        capital.classList.add("invalid");
        }

        var numbers = /[0-9]/g;
        if(pass.value.match(numbers)) {  
        number.classList.remove("invalid");
        number.classList.add("valid");
        } else {
        number.classList.remove("valid");
        number.classList.add("invalid");
        }

        var specials = /[!@#$%^&*()]/g;
        if(pass.value.match(specials)) {
        special.classList.remove("invalid");
        special.classList.add("valid");
        } else {
        special.classList.remove("valid");
        special.classList.add("invalid");
        }

        if(pass.value.length >= 8) {
        eight.classList.remove("invalid");
        eight.classList.add("valid");
        } else {
        eight.classList.remove("valid");
        eight.classList.add("invalid");
        }
    }
    pass.onblur = function() {
    document.getElementById("message").style.display = "none";
    }
}
</script>
</body>
</html>