<?php
session_start();
require_once("../Controlador/LNListaFacultad.php");
require_once("../Controlador/LNListaTipoTesis.php");
$objDatosFacultad = new LNListaFacultad();
$facultad = $objDatosFacultad->reporteFacultad();
$objDatosTipoTesis = new LNListaTipoTesis();
$tipoTesis = $objDatosTipoTesis->listaTipoTesis();
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
if(!isset($_SESSION['idUsuario'])){
    header('Location:Salir.php');
}elseif($_SESSION['idUsuario']){
    if(isset($_REQUEST['idCarrera'])){
        header('Location:ListaTesisCarrera.php');
    }
    include_once("plantillas/navBar.php");
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
        <h1>Lista Tesis</h1>
        <div class="row">
            <div class="col-sm-4">
                <select class="custom-select" name="facultad" id="facultad">
                    <option selected disabled>Facultad</option>
                    <?php foreach($facultad as $facultades){?>
                        <option value="<?php echo $facultades['idFacultad']?>"><?php echo $facultades['nombre']?></option>
                    <?php }?>
                </select>
            </div>
            <div class="col-sm-4">
                <select class="custom-select" name="carrera" id="carrera">
                    <option selected disabled>Carrera</option>
                </select>
            </div>
            <div class="col-sm-4">
                <select class="custom-select" name="tipoBibliografia" id="tipoBibliografia">
                    <option selected disabled>Bibliografia</option>
                    <?php foreach($tipoTesis as $ttesis){?>
                        <option value="<?php echo $ttesis['idTipoTesis']?>"><?php echo $ttesis['nombre']?></option>
                    <?php }?>
                </select>
            </div>
        </div>
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
    <script src="../js/jquery-3.5.1.min.js"></script>
    <script src="../js/popper.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script>
        $(document).ready( function () {
            $('#group').DataTable();
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
            $(buscarDatos());

            function buscarDatos(facultad,carrera,tipo){
                $.ajax({
                    url: 'Buscar.php',
                    type: 'POST',
                    dataType: 'html',
                    data: {facultad: facultad,
                            carrera: carrera,
                            tipo: tipo
                    },
                })
                .done(function(respuesta){
                    $("#datos").html(respuesta);
                })
                .fail(function(){
                    console.log("error");
                })
            }

            $(document).on('change','#facultad',function(){
                var facultad = $(this).val();    
                if(facultad != ""){
                    buscarDatos(facultad);
                    $(document).on('change','#carrera',function(){
                        var carrera = $(this).val();
                        if(carrera != ""){
                            buscarDatos(facultad, carrera);
                            $(document).on('change','#tipoBibliografia',function(){
                                var tipo = $(this).val();
                                if(tipo != ""){
                                    buscarDatos(facultad, carrera, tipo);
                                }
                            });
                        }
                    });
                }else{
                    $(document).on('change','#tipoBibliografia',function(){
                        var tipo = $(this).val();
                        if(tipo != ""){
                            buscarDatos("", "", tipo);
                        }else{
                            buscarDatos();
                        }
                    });
                }
            });
            
        });
        
    </script>
    <script type="text/javascript" src="../js/main.js"></script>
    <script src="../js/jquery.dataTables.min.js"></script>
</body>
</html>