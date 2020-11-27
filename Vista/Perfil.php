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
            
            <div class="row">
                    <div class="col-lg-6 mt-3">
                        <h5 class="bg-light text-dark rounded p-2"><strong>Primer Nombre: </strong>
                            <input type="text" class="border-0 bg-light reg-input" name="primerNombre" value="<?php echo $usuario['primerNombre']?>">
                            <small class="text-danger float-right small">
                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-pencil-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z"/>
                                </svg>
                            </small>
                        </h5>
                        <h5 class="bg-light text-dark rounded p-2"><strong>Segundo Nombre: </strong>
                            <input type="text" class="border-0 bg-light reg-input" name="segundoNombre" value="<?php echo $usuario['segundoNombre']?>">
                            <small class="text-danger float-right small">
                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-pencil-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z"/>
                                </svg>
                            </small>
                        </h5>
                        <h5 class="bg-light text-dark rounded p-2"><strong>Primer Apellido: </strong>
                            <input type="text" class="border-0 bg-light reg-input" name="primerApellido" value="<?php echo $usuario['primerApellido']?>">
                            <small class="text-danger float-right small">
                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-pencil-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z"/>
                                </svg>
                            </small>
                        </h5>
                        <h5 class="bg-light text-dark rounded p-2"><strong>Segundo Apellido: </strong>
                            <input type="text" class="border-0 bg-light reg-input" name="segundoApellido" value="<?php echo $usuario['segundoApellido']?>">
                            <small class="text-danger float-right small">
                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-pencil-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z"/>
                                </svg>
                            </small>
                        </h5>
                        <h5 class="bg-light text-dark rounded p-2"><strong>Usuario: </strong><?php echo $usuario['usuario']?></h5>
                        <h5 class="bg-light text-dark rounded p-2"><strong>CI: </strong> <input type="text" id="ci" name="ci" class="border-0 bg-light reg-input" value="<?php echo $usuario['ci']?>"> <?php //echo $usuario['ci']?>
                            <small class="text-danger float-right small">
                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-pencil-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z"/>
                                </svg>
                            </small>
                        </h5>
                        <h5 class="bg-light text-dark rounded p-2"><strong>Telefono: </strong> <input type="text" name="telefono" class="border-0 bg-light reg-input" value="<?php echo $usuario['telefono']?>"> <?php //echo $usuario['ci']?>
                            <small class="text-danger float-right small">
                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-pencil-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z"/>
                                </svg>
                            </small>
                        </h5>
                        <h5 class="bg-light text-dark rounded p-2"><strong>Rol: </strong><?php switch($usuario['idRol']){ case 1:echo "Administrador";break;case 2:echo "Docente";break;case 3:echo "Estudiante";break;}?></h5>
                        <h5 class="bg-light text-dark rounded p-2"><strong>Estado: </strong><?php if($usuario['activo']) echo "Activo"; else echo "Inactivo"?></h5>
                        <h5 class="bg-light text-dark rounded p-2"><strong>Fecha de Registro: </strong><?php echo $usuario['fechaRegistro']?></h5>
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
                    }else{
                        $('#submit').attr('disabled',false);
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
        });
    </script>
</body>
</html><h5></h5>