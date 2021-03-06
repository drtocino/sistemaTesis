<?php
session_start();
if(!isset($_SESSION['idUsuario'])){
    header('Location:Salir.php');
}elseif($_SESSION['idUsuario']){
    include_once("plantillas/navBar.php");
    header("Location:TesisDetalleCarrera.php?idTesis=".$_REQUEST['idTesis']."&t=".$_REQUEST['t']);
    /*if($_SESSION['idUsuario']>0){
    }*/
}else{?>
    
<?php }
include_once("../Controlador/LNListaTesis.php");
$objListaTesis = new LNListaTesis();
$datos = $objListaTesis->detalleTesis($_REQUEST['idTesis']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <title>Tesis Detalle</title>
</head>
<style>
    .info-card{
        /*min-height:15rem;*/
        min-height:25rem;
        max-height:25rem;
    }
    img{
        max-height:60%;
        max-width:40%;
    }
    .svg{
        max-height:80%;
        max-width:60%;
        margin-top:-25%;
    }

</style>
<body>
<?php

?>
    <main>
        <div class="container">
            <div class="row">
                <div class="col-lg-6 mt-3">
                    <div class="card text-white info-card border-0">
                        <h5 class="card-header bg-main">Datos Generales</h5>
                        <div class="card-body bg-s-main text-dark rounded overflow-auto">
                            <h5 class="card-title"><span><?php echo $datos['titulo']?></span></h5>
                            <p class="card-text">Autor: <?php echo $datos['autor']?></p>
                            <p>Fecha y Hora: <?php echo $datos['fechaHoraRegistro']?></p>
                            <p>Tipo de Bibliografía: <?php echo $datos['tipoTesis']?></p>
                            <p>Facultad: <?php echo $datos['facultad']?></p>
                            <p>Carrera: <?php echo $datos['carrera']?></p>
                            <p>Código de la Tesis: <?php echo $datos['codigoTesis']?></p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 mt-3">
                    <div class="card text-white info-card border-0">
                        <h5 class="card-header bg-main">Tapa de Tesis</h5>
                        <div class="card-body bg-s-main rounded">
                            <h5 class="card-title"></h5>
                            <p class="card-text"></p>

                            <?php if($datos['imagenTapaTesis']){?>
                                <img class="mx-auto d-block img" src="<?php echo $datos['imagenTapaTesis']?>" alt="">
                            <?php }else{?>
                                <svg class="svg mx-auto d-block" height="512" viewBox="0 0 512 512" width="512" xmlns="http://www.w3.org/2000/svg">
                                    <rect fill="#353744" height="448" rx="16" width="368" x="72" y="32"/>
                                    <rect fill="#58565c" height="448" rx="16" width="352" x="72" y="32"/>
                                    <rect fill="#353744" height="448" rx="16" width="288" x="72" y="32"/>
                                    <rect fill="#58565c" height="448" rx="16" width="272" x="72" y="32"/>
                                    <path d="m360 56h32a8 8 0 0 1 8 8v384a8 8 0 0 1 -8 8h-32a0 0 0 0 1 0 0v-400a0 0 0 0 1 0 0z" fill="#d7e6f0"/>
                                    <circle cx="208" cy="228" fill="#006a71" r="84"/><rect fill="#353744" height="16" rx="8" width="128" x="144" y="202.667"/>
                                    <path d="m152 202.667h56a0 0 0 0 1 0 0v16a0 0 0 0 1 0 0h-56a8 8 0 0 1 -8-8 8 8 0 0 1 8-8z" fill="#55525b"/>
                                    <path d="m240 250.667-32 16-32-16v-32h64z" fill="#353744"/><path d="m208 266.667-32-16v-24h32z" fill="#55525b"/>
                                    <path d="m256 218.667h8v32h-8z" fill="#353744"/><rect fill="#cbeaed" height="16" rx="4" width="18.667" x="250.667" y="250.667"/><g fill="#353744"><rect height="32" rx="16" width="160" x="128" y="352"/><rect height="32" rx="16" width="80" x="168" y="408"/>
                                    <rect height="32" rx="16" width="80" x="168" y="72"/>
                                    </g>
                                </svg>
                            <?php }?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-4 mb-4">
                <div class="col-sm-12">
                    <div class="card text-light border-0">
                        <h5 class="card-header bg-main">Resumen</h5>
                        <div class="card-body bg-s-main text-dark">
                        <p><?php echo $datos['resumen']?></p>
                        </div>
                    </div>
                </div>
            </div>
<!--<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
  Launch demo modal
</button>-->

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Hola</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
        </div>
    </main>
    <script src="../js/jquery-3.5.1.min.js"></script>
    <script src="../js/popper.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
</body>
</html>