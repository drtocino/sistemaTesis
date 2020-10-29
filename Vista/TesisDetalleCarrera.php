<?php
session_start();

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
    
    img{
        max-height:80%;
        max-width:60%;
        min-height:60%;
    }
    .svg{
        margin: 0;
        max-height:80%;
        max-width:60%;
        margin-top:0%;
    }
    #viewpdf{
        min-height:50rem;
    }
    /*.nav-pills{
        background:#f0a500;
    }*/
    .nav-tabs .nav-link{
        background:#006a71;
        color:#fff;
        border-radius:5px;
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
    include_once("plantillas/navBar.php");
}elseif($datosUsuario['idRol']==2){
    include_once("plantillas/navBarDocente.php");
}elseif($datosUsuario['idRol']==3){
    header('Location:Home.php');
}
?>
<?php if(!isset($_SESSION['idUsuario'])){
    header('Location:Salir.php');
}elseif($_SESSION['idUsuario']){
    
}?>
    <main>
        <div class="container mb-3">
            <div class="">
                <ul class="nav nav-tabs mb-3 mt-3" id="pills-tab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Datos Generales</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Fotografias</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="false">Resumen</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-intro" role="tab" aria-controls="pills-contact" aria-selected="false">Introduccion</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-doc" role="tab" aria-controls="pills-contact" aria-selected="false">Documento</a>
                    </li>
                </ul>
                <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                    <div class="card text-white bg-dark info-card">
                        <h5 class="card-header bg-main text-light">Datos Generales</h5>
                        <div class="card-body bg-s-main text-dark  overflow-auto">
                            <div class="row pr-3">
                                <div class="col-sm-6">
                                    <h5 class="card-title"><span><?php echo $datos['titulo']?></span></h5>
                                    <p class="card-text">Autor: <?php echo $datos['autor']?></p>
                                    <p>Fecha y Hora: <?php echo $datos['fechaHoraRegistro']?></p>
                                    <p>Tipo de Bibliografía: <?php echo $datos['tipoTesis']?></p>
                                    <p>Facultad: <?php echo $datos['facultad']?></p>
                                    <p>Carrera: <?php echo $datos['carrera']?></p>
                                    <p>Código de la Tesis: <?php echo $datos['codigoTesis']?></p>
                                </div>
                                <div class="col-sm-6 bg-secondary p-0 rounded">
                                <?php if($datos['imagenTapaTesis']){?>
                                    <img class="mx-auto d-block img" src="<?php echo $datos['imagenTapaTesis']?>" alt="">
                                <?php }else{?>
                                    <svg class="svg mx-auto d-block" height="448" viewBox="0 0 448 448" width="448" xmlns="http://www.w3.org/2000/svg">
                                        <rect fill="#353744" height="448" rx="16" width="368" x="72" y="32"/>
                                        <rect fill="#55525b" height="448" rx="16" width="352" x="72" y="32"/>
                                        <rect fill="#353744" height="448" rx="16" width="288" x="72" y="32"/>
                                        <rect fill="#55525b" height="448" rx="16" width="272" x="72" y="32"/>
                                        <path d="m360 56h32a8 8 0 0 1 8 8v384a8 8 0 0 1 -8 8h-32a0 0 0 0 1 0 0v-400a0 0 0 0 1 0 0z" fill="#d7e6f0"/>
                                        <circle cx="208" cy="228" fill="#fabe19" r="84"/>
                                        <rect fill="#353744" height="16" rx="8" width="128" x="144" y="202.667"/>
                                        <path d="m152 202.667h56a0 0 0 0 1 0 0v16a0 0 0 0 1 0 0h-56a8 8 0 0 1 -8-8 8 8 0 0 1 8-8z" fill="#55525b"/>
                                        <path d="m240 250.667-32 16-32-16v-32h64z" fill="#353744"/><path d="m208 266.667-32-16v-24h32z" fill="#55525b"/>
                                        <path d="m256 218.667h8v32h-8z" fill="#353744"/>
                                        <rect fill="#f5871e" height="16" rx="4" width="18.667" x="250.667" y="250.667"/><g fill="#353744">
                                        <rect height="32" rx="16" width="160" x="128" y="352"/>
                                        <rect height="32" rx="16" width="80" x="168" y="408"/>
                                        <rect height="32" rx="16" width="80" x="168" y="72"/></g>
                                    </svg>
                                <?php }?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                    <div class="card text-white bg-dark info-card">
                        <h5 class="card-header bg-main text-light">Fotografias</h5>
                        <div class="card-body bg-s-main rounded">
                            <h5 class="card-title"></h5>
                            <div class="row">
                                <div class="col-sm-5 text-center bg-secondary rounded p-4 m-3">
                                    <?php if($datos['fotografia']){?>
                                        <h5>Autor</h5>
                                        <img src="<?php echo $datos['fotografia']?>" alt="image">
                                    <?php }else{?>
                                    <h5>Autor</h5>
                                    <img src="892795.svg"></img>
                                    <?php }?>
                                </div>
                                <div class="col-sm-5 text-center bg-secondary rounded p-4 m-3">
                                    <h5>Tutor</h5>
                                    <img src="892771.svg"></img>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
                    <div class="card text-daek bg-dark">
                        <h5 class="card-header bg-main text-light">Resumen</h5>
                        <div class="card-body bg-s-main">
                        <p><?php echo $datos['resumen']?></p>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="pills-intro" role="tabpanel" aria-labelledby="pills-contact-tab">
                    <div class="card text-dark bg-dark">
                        <h5 class="card-header bg-main text-light">Introduccion</h5>
                        <div class="card-body bg-s-main">
                        <p><?php echo $datos['introduccion']?></p>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="pills-doc" role="tabpanel" aria-labelledby="pills-contact-tab">
                    <div class="card text-white bg-dark">
                        <h5 class="card-header bg-main text-light">Documento</h5>
                        <div class="card-body bg-s-main text-dark">
                            <?php if($datos['documentoCompleto']){?>
                            <div id="viewpdf"></div>
                            <?php }else{?>
                            <h3>No se pudo encontrar el archivo PDF</h3>
                            <?php }?>
                        </div>
                    </div>
                </div>
                <!--<div id="viewpdf"></div>-->
            </div>
        </div>
    </main>
    <script src="../js/jquery-3.5.1.min.js"></script>
    <script src="../js/popper.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/pdfobject.js"></script>
    <script>
        var viewer = $('#viewpdf');
        PDFObject.embed('<?php echo $datos['documentoCompleto']?>', viewer);
    </script>
</body>
</html>