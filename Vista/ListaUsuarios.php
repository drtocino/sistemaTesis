<?php
session_start();
require_once("../Controlador/LNListaUsuario.php");
$Usuario = new LNListaUsuario();
$ListaUsuarios = $Usuario->listaUsuario();
require_once("../Controlador/LNListaCarrera.php");
$carreras = new LNListaCarrera();
$listaCarrera = $carreras->listaCarreras();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../css/bootstrap.min.css">
        <link rel="stylesheet" href="../css/style.css">
        <link rel="stylesheet" href="../css/jquery.dataTables.min.css">
        <title>Lista de Usuarios</title>
    </head>
    <style>
        table{
            border-radius:10rem;
        }
        thead{
            border-radius:10rem;
        }
        .tab-content{
            min-width:26rem;
        }
        /*.custom-control-input{
            color: #2cb320;
            background: #2cb320;
        }*/
        select{
        /*display:;*/
        width:100%;
        height:calc(1.5em + .75rem + 2px);
        padding:.375rem .75rem;
        font-size:1rem;
        font-weight:400;
        line-height:1.5;
        color:#495057;
        background-color:#fff;
        background-clip:padding-box;
        border:1px solid #ced4da;
        border-radius:.25rem;
        transition:border-color .15s ease-in-out,box-shadow .15s ease-in-out
    }
        </style>
<body>
    <?php if(!$_SESSION['idRol']){
        header("Location:Salir.php");
    }else{
        if($_SESSION['idRol']==1){
            include("plantillas/navBar.php");?>
            <button type="button" class="bg-s-second btn-plus text-dark" data-toggle="modal" data-target="#exampleModal">+</button>
<?php
        }elseif($_SESSION['idRol']==3 || $_SESSION['idRol']==2){
            echo $_SESSION['idRol'];
            header('Location:Home.php');
        }
        //<!--<a href="RegistrarTesis.php" class="bg-s-second btn-plus text-dark">+</a>-->
    }?>
    <div class="container rounded bg-light mt-3 mb-3 pt-3 pb-3">
        <h1>Lista de Usuarios</h1>
        <div class="row" id="filters">
            <div class="col-sm-6">
                <select name="estado" id="estado">
                    <option value="">Todos</option>
                    <option value="1">Activos</option>
                    <option value="0">Inactivos</option>
                </select>
                <!--<div class="row">

                <!--
                    <div class="col-sm-4">
                        Activos
                        <input type="radio" name="estado" value="1">
                    </div>
                    <div class="col-sm-4">
                        Inactivos
                        <input type="radio" name="estado" value="0">
                    </div>
                    <div class="col-sm-4">
                        Todos
                        <input type="radio" name="estado" value="">
                    </div>
                    <!--
                    <div class="col-sm-6">
                        <div class="custom-control custom-switch ml-1">
                            <input type="radio" class="custom-control-input" id="estado2" name="activo" value="1" >
                            <label class="custom-control-label" for="estado2">Activo</label>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="custom-control custom-switch ml-1">
                            <input type="radio" class="custom-control-input" id="estado0" name="activo" value="0" >
                            <label class="custom-control-label" for="estado0">Inactivo</label>
                        </div>
                    </div>
                    
                </div>-->
            </div>
            <div class="col-sm-6">
                <select name="tipoUsuario" id="tipoUsuario" class="custom-select">
                    <option value="">Tipo de Usuario</option>
                    <option value="1">Administrador</option>
                    <option value="2">Docente</option>
                    <option value="3">Estudiante</option>
                </select>
            </div>
        </div>
        <div class="table-responsive-lg mt-3" id="datos"></div>
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <form action="../Controlador/LNRegistroUsuario.php" class="was-validated" method="POST" enctype="multipart/form-data">
                <div class="modal-content">
                    <div class="modal-header bg-main text-light">
                        <h5 class="modal-title" id="exampleModalLabel">Registro Usuario</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
    
                    <div class="modal-body">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Datos Generales</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Profile</a>
                            </li>
                            <!--<li class="nav-item" role="presentation">
                                <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Contact</a>
                            </li>-->
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                <input type="text" name="primerNombre" class="form-control mt-3 bb text" placeholder="Primer Nombre" pattern="[A-Za-z0-9\s]{3,12}" title="Use solo letras y son requeridos 3 caracteres minimos, 12 maximo" required>
                                <input type="text" name="segundoNombre" class="form-control mt-3" id="segundoNombre" placeholder="Segundo Nombre" pattern="[A-Za-z0-9\s]{3,12}" title="Use solo letras y son requeridos 3 caracteres minimos, 12 maximo">
                                <input type="text" name="primerApellido" class="form-control mt-3" id="primerApellido" placeholder="Primer Apellido" required pattern="[A-Za-z0-9\s]{3,12}" title="Use solo letras y son requeridos 3 caracteres minimos, 12 maximo">
                                <input type="text" name="segundoApellido" class="form-control mt-3" id="segundoApellido" placeholder="Segundo Apellido" required pattern="[A-Za-z0-9\s]{3,12}" title="Use solo letras y son requeridos 3 caracteres minimos, 12 maximo">
                                <input type="text" name="ci" class="form-control mt-3" id="" placeholder="CI" required pattern="[0-9\s]{5,10}" title="Ingrese un numero de 5 hasta 10 caracteres">
                            </div>
                            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                <select name="rol" id="" class="custom-select mt-3" required>
                                    <option value="" disabled selected>Tipo de Usuario</option>
                                    <option value="1">Administrador</option>
                                    <option value="2">Docente</option>
                                    <option value="3">Estudiante</option>
                                </select>
                                <select name="carrera" id="carrera" class="custom-select mt-3" required>
                                    <option value="" selected disabled>Seleccione una Carrera</option>
                                    <?php foreach($listaCarrera as $datos){?>
                                    <option value="<?php echo $datos['idCarrera']?>"><?php echo $datos['nombre']?></option>
                                    <?php }?>
                                </select>
                                <input type="text" class="form-control mt-3" name="telefono" id="" placeholder="Telefono" required pattern="[0-9\s]{6,8}" title="Ingrese un numero de 6 hasta 8 caracteres">
                                <div class="custom-file mt-3">
                                    <input type="file" class="custom-file-input" name="fotografia" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01" lang="es" required>
                                    <label class="custom-file-label text-left" for="inputGroupFile01">Fotografia de la persona en formato png, jpg o jpeg</label>
                                </div>
                            </div>
                            <!-- <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">...</div>-->
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-dark" data-dismiss="modal">Cerrar</button>
                        <input type="submit" value="Registrar" class="btn bg-s-second">
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script src="../js/jquery-3.5.1.min.js"></script>
    <script src="../js/popper.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready( function () {
            
            function buscarDatos(estado,tipoUsuario){
                $.ajax({
                    url: 'Usuarios.php',
                    type: 'POST',
                    dataType: 'html',
                    data: {estado: estado,
                            tipoUsuario: tipoUsuario
                    },
                })
                .done(function(respuesta){
                    $("#datos").html(respuesta);
                    
                })
                .fail(function(){
                    console.log("error");
                })
            }
            $(buscarDatos());
            $(document).on('change','#filters',function(){
                var estado = $('#estado').val();
                var tipoUsuario = $('#tipoUsuario').val();
                if(estado != "" || tipoUsuario != ""){
                    buscarDatos(estado,tipoUsuario);
                }else{
                    buscarDatos("","");
                }
            });
        });
    </script>
</body>
</html>