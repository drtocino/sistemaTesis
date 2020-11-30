<?php
session_start();
require_once("../Controlador/LNListaFacultad.php");
require_once("../Controlador/LNListaTipoTesis.php");
$objDatosFacultad = new LNListaFacultad();
$facultad = $objDatosFacultad->reporteFacultad();
$objDatosTipoTesis = new LNListaTipoTesis();
$tipoTesis = $objDatosTipoTesis->listaTipoTesis();
require_once("../Controlador/LNListaUsuario.php");
require_once("../Controlador/LNListaCarrera.php");
require_once("../Controlador/LNListaAsesor.php");
$objDatosCarreras = new LNListaCarrera();
$carreras = $objDatosCarreras->listaCarreras();
$objDatosUsuario = new LNListaUsuario();
$personas = $objDatosUsuario->listaUsuario();
//$asignacionCarrera = $objDatosUsuario->datosAsignacionCarrera();
//$objDatosCarrera = new LNListaCarrera();
//$carreras = $objDatosCarrera->reporteCarrera();
//$objDatosFacultad = new LNListaFacultad();
//$facultades = $objDatosFacultad->reporteFacultad();
$objDatosAsesor = new LNListaAsesor();
$asesores = $objDatosAsesor->listaAsesor();
$datosAnio = $objDatosFacultad->reporteAnualFacultad(1);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/jquery.dataTables.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista Tesis</title>
</head>
<style>
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
<?php
require_once("../Controlador/LNListaUsuario.php");
$usuario = new LNListaUsuario();
$datosUsuario = $usuario->datosUsuario($_SESSION['idUsuario']);
if($_SESSION['idUsuario']){
    if($datosUsuario['idRol']==1){
        include_once("plantillas/navBar.php");
?>
    <button type="button" class="bg-s-second btn-plus text-dark" data-toggle="modal" data-target="#exampleModal">+</button>
<?php
    }elseif($datosUsuario['idRol']==2){
        include_once("plantillas/navBarDocente.php");
    }elseif($datosUsuario['idRol']==3){
        include_once("plantillas/navBarEstudiante.php");
    }
}else{
    if($_SESSION['idUsuario']==0){

    }else{
        header("Location:Salir.php");
    }
}
if(!isset($_SESSION['idUsuario'])){
    header('Location:Salir.php');
}elseif($_SESSION['idUsuario']){
    if(isset($_REQUEST['idCarrera'])){
        header('Location:ListaTesisCarrera.php');
    }
}else{?>
    <div class="alert alert-success alert-dismissible bg-main text-light p-5 border-0">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <h3>
            <strong class="bg-danger p-2 rounded">Atencion!</strong> Estas navegando como usuario externo. <a href=".."><strong class="bg-s-second text-dark p-2 float-right rounded">Login</strong></a>
        </h3>
    </div>
    <?php
    //include_once('plantillas/navBarExtern.php');
}
?>
    <div class="container bg-light rounded mt-3 mb-3 pt-3 pb-3">
        <h1>Lista de Tesis</h1>
        <?php if($_SESSION['idUsuario']){?>
                <div class="row" id="filters">
                    <div class="col-sm-6 mt-3">
                        <select class="custom-select" name="facultad" id="facultad">
                            <option value="" selected>Facultad</option>
                            <?php foreach($facultad as $facultades){?>
                                <option value="<?php echo $facultades['idFacultad']?>"><?php echo $facultades['nombre']?></option>
                            <?php }?>
                        </select>
                    </div>
                    <div class="col-sm-6 mt-3">
                        <select class="custom-select" name="carrera" id="carrera">
                            <option value="" selected>Carrera</option>
                            <?php foreach($carreras as $carrera){?>
                            <option value="<?php echo $carrera['idCarrera']?>"><?php echo $carrera['nombre']?></option>
                            <?php }?>
                        </select>
                    </div>
                </div>
                <div class="row" id="filters">
                    <div class="col-sm-6 mt-3">
                        <select class="custom-select" name="tipoBibliografia" id="tipoBibliografia">
                            <option value="" selected>Bibliografia</option>
                            <?php foreach($tipoTesis as $ttesis){?>
                                <option value="<?php echo $ttesis['idTipoTesis']?>"><?php echo $ttesis['nombre']?></option>
                            <?php }?>
                        </select>
                    </div>
                    <div class="col-sm-6 mt-3">
                        <select name="anio" id="anio" class="custom-select">
                            <option value="" selected>Año</option>
                            <?php foreach($datosAnio as $dato){?>
                                <option value="<?php echo $dato['anio']?>"><?php echo $dato['anio']?></option>
                            <?php }?>
                        </select>
                    </div>
                </div>
            <?php }else{?>
                <div class="row">
                    <div class="col-sm-4">
                        <select class="custom-select" name="facultad" id="facultad">
                            <option selected>Facultad</option>
                            <?php foreach($facultad as $facultades){?>
                                <option value="<?php echo $facultades['idFacultad']?>"><?php echo $facultades['nombre']?></option>
                            <?php }?>
                        </select>
                    </div>
                    <div class="col-sm-4">
                        <select class="custom-select" name="carrera" id="carrera">
                            <option selected>Carrera</option>
                            <?php foreach($carreras as $carrera){?>
                            <option value="<?php echo $carrera['idCarrera']?>"><?php echo $carrera['nombre']?></option>
                            <?php }?>
                        </select>
                    </div>
                    <div class="col-sm-4">
                        <select class="custom-select" name="tipoBibliografia" id="tipoBibliografia">
                            <option selected>Bibliografia</option>
                            <?php foreach($tipoTesis as $ttesis){?>
                                <option value="<?php echo $ttesis['idTipoTesis']?>"><?php echo $ttesis['nombre']?></option>
                            <?php }?>
                        </select>
                    </div>
                </div>
                <?php }?>
        <!--
            <div class="input-group mt-3 mb-3">
                <input type="text" class="form-control" placeholder="Ingrese un Titulo" title="Escriba solo una palabra por favor" name="carrera" id="buscar">
            <div class="input-group-append">
                <button class="btn btn-outline-dark btn-block">Buscar</button>
            </div>
        </div>
                    -->
        <div class="table-responsive-lg mt-3" id="datos"></div>
    </div>
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-lg">
            <form action="../Controlador/LNRegistroTesis.php" method="POST" class="was-validated" enctype="multipart/form-data">
                <div class="modal-content">
                    <div class="modal-header bg-main text-light">
                        <h5 class="modal-title" id="exampleModalLabel">Registro Tesis</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <nav>
                            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                <a class="nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Paso 1</a>
                                <a class="nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Paso 2</a>
                                <a class="nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">Paso 3</a>
                            </div>
                        </nav>
                        <div class="tab-content" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                                <select name="persona" id="" class="custom-select mt-3" placeholder="Autor" required>
                                    <option value="" selected disabled>Autor</option>
                                    <?php foreach($personas as $datos){?>
                                        <option value="<?php echo $datos['idPersona']?>"><?php echo $datos['nombres']?></option>
                                    <?php }?>
                                </select>
                                <select name="asesor" id="" class="custom-select mt-3" required>
                                    <option value="" selected disabled>Asesor</option>
                                    <?php foreach($asesores as $asesor){?>
                                        <option value="<?php echo $asesor['idPersonalTesis']?>"><?php echo $asesor['nombreCompleto']?></option>
                                    <?php }?>
                                </select>
                                <select name="tipoBibliografia" id="" class="custom-select mt-3" required>
                                    <option value="" disabled selected>Tipo de Bibliografia</option>
                                    <?php foreach($tipoTesis as $tipo){?>
                                        <option value="<?php echo $tipo['idTipoTesis']?>"><?php echo $tipo['nombre']?></option>
                                    <?php }?>
                                </select>
                            </div>
                            <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <select name="facultad" id="fac" class="custom-select mt-3" required>
                                            <option value="" selected disabled>Seleccione una Facultad</option>
                                            <?php foreach($facultad as $dato){?>
                                            <option value="<?php echo $dato['idFacultad']?>"><?php echo $dato['nombre']?></option>
                                            <?php }?>
                                        </select>
                                    </div>
                                    <div class="col-lg-6">
                                        <select name="carrera" id="car" class="custom-select mt-3" required>
                                            <option value="" selected disabled>Seleccione una Facultad Primero</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                                <input type="text" name="titulo" class="form-control mt-3" placeholder="Titulo" required>
                                <input type="text" name="palabrasClave" class="form-control mt-3" id="" placeholder="Palabras Clave" required>
                                <!-- <option value="" id="asignacion"> </option>-->
                                <textarea name="resumen" class="form-control mt-3" id="" cols="30" rows="5" placeholder="Resumen" required></textarea>
                                <textarea name="introduccion" class="form-control mt-3" id="" cols="30" rows="5" placeholder="Introduccion" required></textarea>
                                
                                <div class="custom-file mt-3">
                                    <input type="file" class="custom-file-input form-control" name="imagenTapa" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01" lang="es" required>
                                    <label class="custom-file-label text-left" for="inputGroupFile01">Imagen de Tapa en formato png, jpg o jpeg</label>
                                </div>
                                <div class="custom-file mt-3">
                                    <input type="file" class="custom-file-input form-control" name="documento" id="inputGroupFile02" aria-describedby="inputGroupFileAddon02" lang="es" required>
                                    <label class="custom-file-label text-left" for="inputGroupFile02">Documento en formato pdf</label>
                                </div>
                            </div>
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
    <script>
        $(document).ready( function () {
            $('#group').DataTable({
                "ordering": false
            });
            $('#facultad').on('change',function(){
                var idFacultad = $(this).val();
                if(idFacultad){
                    $.ajax({
                        type:'POST',
                        url:'data.php',
                        data:'idFacultad='+idFacultad,
                        success:function(html){
                            $('#carrera').html(html);
                        }
                    });
                }else{
                    $('#carrera').html('<option selected>Carrera</option><?php foreach($carreras as $carrera){?><option value="<?php echo $carrera["idCarrera"]?>"><?php echo $carrera['nombre']?></option><?php }?>');
                }
            });
            $(buscarDatos());

            function buscarDatos(facultad,carrera,tipo,anio){
                $.ajax({
                    url: 'Buscar.php',
                    type: 'POST',
                    dataType: 'html',
                    data: {facultad: facultad,
                            carrera: carrera,
                            tipo: tipo,
                            anio: anio
                    },
                })
                .done(function(respuesta){
                    $("#datos").html(respuesta);
                })
                .fail(function(){
                    console.log("error");
                })
            }
            $(document).on('change','#filters',function(){
                var facultad = $('#facultad').val();
                var carrera = $('#carrera').val();
                var tipo = $('#tipoBibliografia').val();
                var anio = $('#anio').val();
                if(facultad != 0 || carrera != 0 || tipo != 0 || anio != 0){
                    buscarDatos(facultad,carrera,tipo,anio);
                }else{
                    buscarDatos("","","","");
                }
            });
            /*$(document).on('change','#facultad',function(){
                var facultad = $(this).val();    
                if(facultad){
                    buscarDatos(facultad);
                    $(document).on('change','#carrera',function(){
                        var carrera = $(this).val();
                        if(carrera != ""){
                            buscarDatos(facultad, carrera);
                            $(document).on('change','#tipoBibliografia',function(){
                                var tipo = $(this).val();
                                if(tipo != ""){
                                    buscarDatos(facultad, carrera, tipo);
                                    $(document).on('change','#anio',function(){
                                        var anio = $(this).val();
                                        if(anio != ""){
                                            buscarDatos(facultad, carrera, tipo, anio);
                                        }
                                    });
                                }
                            });
                        }
                    });
                }else{
                    $(document).on('change','#tipoBibliografia',function(){
                        var tipo = $(this).val();
                        if(tipo != ""){
                            buscarDatos(facultad, "", tipo);
                        }else{
                            buscarDatos();
                        }
                    });
                }
            });*/
            /*$(document).on('change','#tipoBibliografia',function(){
                var tipo = $(this).val();
                if(tipo != ""){
                    buscarDatos("", "", tipo);
                }else{
                    buscarDatos();
                }
            });
            $(document).on('change','#anio',function(){
                var anio = $(this).val();
                if(anio != ""){
                    buscarDatos("", "", "", anio);
                    //console.log(anio);
                }
            });*/
            $('#fac').on('change',function(){
                var idFacultad = $(this).val();
                if(idFacultad){
                    $.ajax({
                        type:'POST',
                        url:'data.php',
                        data:'idFacultad='+idFacultad,
                        success:function(html){
                            $('#car').html(html);
                        }
                    });
                }else{
                    $('#car').html('<option>Selecciona una Facultad</option>');
                }
            });
            
        });
        
    </script>
    <!--<script type="text/javascript" src="../js/main.js"></script>-->
    <script src="../js/jquery.dataTables.min.js"></script>
</body>
</html>