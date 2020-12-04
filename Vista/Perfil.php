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
    <link rel="stylesheet" href="sweetalert2.min.css">
    <!-- <link rel="stylesheet" href="../css/jquery.dataTables.min.css">-->
    <title><?php echo $usuario['nombres']?></title>
</head>
<style>
    img{
        max-height:70%;
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
    input:focus{
        border: none;
    }
    .reg-input:focus{
        border: 0px solid;
        border-color: #ffffff00;
        background: #ffffff;
        outline: none;
    }
    .small{
        font-size: 12px;
    }
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
        <form action="../Controlador/ActualizarPerfil.php" class="needs-validation" id="form">
            
            <div class="row" id="perfil">
                    <div class="col-lg-6 mt-3">
                        <h5 class="bg-light text-dark rounded p-2"><strong>Primer Nombre: </strong>
                            <input type="text" class="border-0 bg-light reg-input" name="primerNombre" value="<?php echo $usuario['primerNombre']?>">
                            <small class="text-danger float-right small">
                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-pencil-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg" pattern="[A-Za-z0-9\s]{3,12}" title="Use solo letras y son requeridos 3 caracteres minimos, 12 maximo" required>
                                <path fill-rule="evenodd" d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z"/>
                                </svg>
                            </small>
                        </h5>
                        <h5 class="bg-light text-dark rounded p-2"><strong>Segundo Nombre: </strong>
                            <input type="text" class="border-0 bg-light reg-input" name="segundoNombre" value="<?php echo $usuario['segundoNombre']?>" pattern="[A-Za-z0-9\s]{3,12}" title="Use solo letras y son requeridos 3 caracteres minimos, 12 maximo">
                            <small class="text-danger float-right small">
                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-pencil-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z"/>
                                </svg>
                            </small>
                        </h5>
                        <h5 class="bg-light text-dark rounded p-2"><strong>Primer Apellido: </strong>
                            <input type="text" class="border-0 bg-light reg-input" name="primerApellido" value="<?php echo $usuario['primerApellido']?>" pattern="[A-Za-z0-9\s]{3,12}" title="Use solo letras y son requeridos 3 caracteres minimos, 12 maximo" required>
                            <small class="text-danger float-right small">
                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-pencil-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z"/>
                                </svg>
                            </small>
                        </h5>
                        <h5 class="bg-light text-dark rounded p-2"><strong>Segundo Apellido: </strong>
                            <input type="text" class="border-0 bg-light reg-input" name="segundoApellido" value="<?php echo $usuario['segundoApellido']?>" pattern="[A-Za-z0-9\s]{3,12}" title="Use solo letras y son requeridos 3 caracteres minimos, 12 maximo" required>
                            <small class="text-danger float-right small">
                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-pencil-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z"/>
                                </svg>
                            </small>
                        </h5>
                        <h5 class="bg-light text-dark rounded p-2"><strong>Usuario: </strong><?php echo $usuario['usuario']?></h5>
                        <h5 class="bg-light text-dark rounded p-2" id="ciCont"><strong>CI: </strong> <input type="text" id="ci" name="ci" class="border-0 bg-light reg-input" required pattern="[0-9\s]{5,10}" title="Ingrese un numero de 5 hasta 10 caracteres" value="<?php echo $usuario['ci']?>"> <?php //echo $usuario['ci']?>
                            <small class="text-danger float-right small">
                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-pencil-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z"/>
                                </svg>
                            </small>
                        </h5>
                        <h5 class="bg-light text-dark rounded p-2"><strong>Telefono: </strong> <input type="text" name="telefono" class="border-0 bg-light reg-input" value="<?php echo $usuario['telefono']?>" required pattern="[0-9\s]{7,8}" title="Ingrese un numero entre 7 y 8 caracteres"> <?php //echo $usuario['ci']?>
                            <small class="text-danger float-right small">
                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-pencil-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z"/>
                                </svg>
                            </small>
                            <div class="valid-tooltip">
                                Looks good!
                            </div>
                            <div class="invalid-tooltip">
                                Please provide a valid city.
                            </div>
                        </h5>
                        <h5 class="bg-light text-dark rounded p-2" id="passCont"><strong>Password: </strong> <input type="text" id="password" name="pass" class="border-0 bg-light reg-input" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%^&*]).{8,}" title="">
                            <small class="text-danger float-right small">
                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-pencil-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z"/>
                                </svg>
                            </small>
                            <div class="message" id="message">
                                <div class="passInvalid" id="minuscula">Al menos 1 mayuscula.</div>
                                <div class="passInvalid" id="mayuscula">Al menos 1 minuscula.</div>
                                <div class="passInvalid" id="numero">Al menos 1 numero.</div>
                                <div class="passInvalid" id="especial">Al menos 1 caracter especial.</div>
                                <div class="passInvalid" id="caracteres">Al menos 8 caracteres.</div>
                            </div>
                        </h5>
                        <h5 class="bg-light text-dark rounded p-2"><strong>Rol: </strong><?php switch($usuario['idRol']){ case 1:echo "Administrador";break;case 2:echo "Docente";break;case 3:echo "Estudiante";break;}?></h5>
                        <h5 class="bg-light text-dark rounded p-2"><strong>Estado: </strong><?php if($usuario['activo']) echo "Activo"; else echo "Inactivo"?></h5>
                        <h5 class="bg-light text-dark rounded p-2"><strong>Fecha de Registro: </strong><?php echo $usuario['fechaRegistro']?></h5>
                        <?php if($usuario['fechaActualizacion']){?>
                        <h5 class="bg-light text-dark rounded p-2"><strong>Fecha de Actualizacion: </strong><?php echo $usuario['fechaActualizacion']?></h5>
                        <?php }else{?>
                        <h5 class="bg-light text-dark rounded p-2"><strong>Fecha de Actualizacion: </strong> --- </h5>
                        <?php }?>
                    </div>
                <div class="col-lg-6 mt-3">
                    <?php if($usuario['fotografia']){?>
                    <img src="<?php echo $usuario['fotografia']?>" class="mx-auto d-block img" alt="" srcset="">
                    <?php }else{?>
                    <img class="mx-auto d-block img-op" src="892795.svg" alt="">
                    <h5 class="text-center text-secondary">Sin fotografia</h5>
                    <?php }?>
                </div>
            </div>
            <input type="submit" id="submit" value="Actualizar" class="btn bg-main text-light">
            <!--<div class="bg-danger" id="datos"></div>-->
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="../js/jquery-3.5.1.min.js"></script>
    <script src="../js/popper.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script>
        $(document).ready( function () {
            
            function buscarDatos(ci){
                $.ajax({
                    url: 'CIVer.php',
                    type: 'POST',
                    dataType: 'html',
                    data: {ci: ci},
                })
                .done(function(respuesta){
                    $("#datos").html(respuesta);
                    if(respuesta == 1){
                        //alert("Ya existe un CI asi");
                        Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'El CI ya existe!',
                        })
                        $('#submit').attr('disabled',true);
                        $('#ciCont').css({
                        'box-shadow':'0px 0px 0px 3px #dc354560',
                        'border':'1.5px solid #dc3545'
                        });
                    }else{
                        $('#submit').attr('disabled',false);
                        //$('#ciCont').css('outline','1px solid green');
                    }
                    //alert("hello");
                })
                .fail(function(){
                    console.log("error");
                })
            }
            $(buscarDatos());
            $(document).on('keyup','#ci',function(){
                var ci = $('#ci').val();
                if(ci != ""){
                    buscarDatos(ci);
                }else{
                    buscarDatos("");
                }
            });
            $('#submit').hide();
            $(document).on('keyup','#perfil',function(){
                $('#submit').show();
            })
        });
        var pass = document.getElementById("password");

        var letter = document.getElementById("minuscula");
        var capital = document.getElementById("mayuscula");
        var number = document.getElementById("numero");
        var special = document.getElementById("especial");
        var eight = document.getElementById("caracteres");
        var submit = document.getElementById("submit");

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
                submit.disabled = true;
                }

                var upperCaseLetters = /[A-Z]/g;
                if(pass.value.match(upperCaseLetters)) {  
                capital.classList.remove("invalid");
                capital.classList.add("valid");
                } else {
                capital.classList.remove("valid");
                capital.classList.add("invalid");
                submit.disabled = true;
                }

                var numbers = /[0-9]/g;
                if(pass.value.match(numbers)) {  
                number.classList.remove("invalid");
                number.classList.add("valid");
                } else {
                number.classList.remove("valid");
                number.classList.add("invalid");
                submit.disabled = true;
                }

                var specials = /[!@#$%^&*()]/g;
                if(pass.value.match(specials)) {
                special.classList.remove("invalid");
                special.classList.add("valid");
                } else {
                special.classList.remove("valid");
                special.classList.add("invalid");
                submit.disabled = true;
                }

                if(pass.value.length >= 8) {
                eight.classList.remove("invalid");
                eight.classList.add("valid");
                } else {
                eight.classList.remove("valid");
                eight.classList.add("invalid");
                submit.disabled = true;
                }
            }
            pass.onblur = function() {
            document.getElementById("message").style.display = "none";
            }
        }
        var nombre = '<?php echo $usuario['primerNombre']?>';
        nombre = nombre.charAt(0);
        nombre = nombre.toLowerCase();
        //alert(nombre);
        var apellido = '<?php echo $usuario['primerApellido']?>';
        var ci = '<?php echo $usuario['ci']?>';
        ci = ci.substring(0,4);
        var suggest = nombre+apellido+'@'+ci;
        //alert(suggest);
        var pass = document.getElementById("password");
        pass.value = suggest;
    </script>
</body>
</html><h5></h5>