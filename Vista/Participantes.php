<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/jquery.dataTables.min.css">
    <title>Participantes</title>
</head>
<style>
    .tab-content{
        min-width:26rem;
    }
</style>
<body>
<?php
require_once("../Controlador/LNListaUsuario.php");
$usuario = new LNListaUsuario();
$datosUsuario = $usuario->datosUsuario($_SESSION['idUsuario']);
if(!$_SESSION['idUsuario']){
    header('Location:Salir.php');
}
if($datosUsuario['idRol']==1){
    include_once("plantillas/navBar.php");?>
    <button type="button" class="bg-s-second btn-plus text-dark" data-toggle="modal" data-target="#exampleModal">+</button>
<?php    
}elseif($datosUsuario['idRol']==2){
    include_once("plantillas/navBarDocente.php");
}elseif($datosUsuario['idRol']==3){
    include_once("plantillas/navBarEstudiante.php");
}
?>
<?php if(!isset($_SESSION['idUsuario'])){
    header('Location:Salir.php');
}elseif($_SESSION['idUsuario']){
    
}?>
    <div class="container bg-light mt-3 mb-3 pt-3 pb-3 rounded">
    <h1>Lista de Participantes de Tesis</h1>
        <div class="table-responsive-lg mt-3" id="datos"></div>
    </div>

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
                                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Paso 1</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Paso 2</a>
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
            
            function buscarDatos(){
                $.ajax({
                    url: 'Participante.php',
                    type: 'POST',
                    dataType: 'html',
                    data: {},
                })
                .done(function(respuesta){
                    $("#datos").html(respuesta);
                    
                })
                .fail(function(){
                    console.log("error");
                })
            }
            $(buscarDatos());
            /*$(document).on('change','#filters',function(){
                var estado = $('#estado').val();
                var tipoUsuario = $('#tipoUsuario').val();
                if(estado != "" || tipoUsuario != ""){
                    buscarDatos(estado,tipoUsuario);
                }else{
                    buscarDatos("","");
                }
            });*/
        });
    </script>
</body>
</html>