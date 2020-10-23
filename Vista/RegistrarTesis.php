<?php
require_once("../Controlador/LNListaUsuario.php");
require_once("../Controlador/LNListaCarrera.php");
require_once("../Controlador/LNListaFacultad.php");
require_once("../Controlador/LNListaTipoTesis.php");
require_once("../Controlador/LNListaAsesor.php");
$objDatosUsuario = new LNListaUsuario();
$personas = $objDatosUsuario->listaUsuario();
//$asignacionCarrera = $objDatosUsuario->datosAsignacionCarrera();
$objDatosCarrera = new LNListaCarrera();
//$carreras = $objDatosCarrera->reporteCarrera();
$objDatosFacultad = new LNListaFacultad();
$facultades = $objDatosFacultad->reporteFacultad();
$objDatosTipoTesis = new LNListaTipoTesis();
$tipoTesis = $objDatosTipoTesis->listaTipoTesis();
$objDatosAsesor = new LNListaAsesor();
$asesores = $objDatosAsesor->listaAsesor();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../css/bootstrap.min.css">
        <link rel="stylesheet" href="../css/style.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Tesis</title>
</head>
<body>
    <?php include("plantillas/navBar.php");?>
    <div class="container mt-4 mb-4">
        <div class="card card-secondary bg-dark text-center w-75 mx-auto d-block">
            <div class="card-header bg-main text-light">
                <h3>Registro Tesis</h3>
            </div>
            <div class="card-body border-secondary bg-light">
                <form action="../Controlador/LNRegistroTesis.php" method="POST" class="was-validated" enctype="multipart/form-data">
                    <!--<input type="text" name="autor" class="form-control mt-3 bg text" placeholder="Autor" list="listaAutores"  required>
                    <!--<datalist id="listaAutores">
                        <?php /*foreach($personas as $datos){?>
                            <option value="<?php echo $datos['nombres']?>"><?php echo $datos['idPersona']?></option>
                            <?php }*/?>
                    </datalist>-->
                    <select name="persona" id="" class="custom-select mt-3" placeholder="Autor" required>
                        <option value="" selected disabled>Autor</option>
                        <?php foreach($personas as $datos){?>
                            <option value="<?php echo $datos['idPersona']?>"><?php echo $datos['nombres']?></option>
                        <?php }?>
                    </select>
                    <select name="asesor" id="" class="custom-select mt-3" required>
                        <option value="" selected disabled>Asesor</option>
                        <?php foreach($asesores as $asesor){?>
                            <option value=""><?php echo $asesor['nombreCompleto']?></option>
                        <?php }?>
                    </select>
                    <select name="tipoBibliografia" id="" class="custom-select mt-3" required>
                        <option value="" disabled selected>Tipo de Bibliografia</option>
                        <?php foreach($tipoTesis as $tipo){?>
                            <option value="<?php echo $tipo['idTipoTesis']?>"><?php echo $tipo['nombre']?></option>
                        <?php }?>
                    </select>
                    <div class="row">
                        <div class="col-lg-6">
                            <select name="facultad" id="facultad" class="custom-select mt-3" required>
                                <option value="" selected disabled>Seleccione una Facultad</option>
                                <?php foreach($facultades as $dato){?>
                                <option value="<?php echo $dato['idFacultad']?>"><?php echo $dato['nombre']?></option>
                                <?php }?>
                            </select>
                        </div>
                        <div class="col-lg-6">
                            <select name="carrera" id="carrera" class="custom-select mt-3" required>
                                <option value="" selected desabled>Seleccione una Facultad Primero</option>
                            </select>
                        </div>
                    </div>
                    <input type="text" name="titulo" class="form-control mt-3" placeholder="Titulo" required>
                    <input type="text" name="palabrasClave" class="form-control mt-3" id="" placeholder="Palabras Clave" required>
                    <!-- <option value="" id="asignacion"> </option>-->
                    <input type="hidden" name="" id="">
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

                    <!--<div class="input-group mt-3">
                        <div class="custom-file">
                            <input type="file" name="imagenTapa" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01">
                            <label class="custom-file-label text-left" for="inputGroupFile01">Elija una Imagen</label>
                        </div>
                    </div>-->
                    <!--<input type="text" name="asignacionCarrera" id="" class="form-control mt-3">-->
                    <input type="submit" value="Registrar" class="btn btn-block btn-danger mt-3" required>
                </form>
            </div>
        </div>
    </div>
    <script src="../js/jquery-3.5.1.min.js"></script>
    <script src="../js/popper.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function(){
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
                    $('#carrera').html('<option>Selecciona una Facultad</option>');
                }
            });
            /*
            $('#persona').on('change',function(){
                var idPersona = $(this).val();
                var idCarrera = $('#carrera').val();
                if(idPersona){
                    $('#asignacion').html(idPersona);



                    /*$.ajax({
                        type:'POST',
                        url:'asignacion.php',
                        data:'idFacultad='+idFacultad,
                        success:function(html){
                            $('#asignacion').html(html);
                        }
                    });
                }
            });
            */
        });
    </script>
</body>
</html>