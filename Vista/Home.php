<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta charset="ANSI">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
</head>
<style>
    .svg{
        max-height:4rem;
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
    }elseif($datosUsuario['idRol']==2){
        include_once("plantillas/navBarDocente.php");
    }elseif($datosUsuario['idRol']==3){
        include_once("plantillas/navBarEstudiante.php");
    }
}else{
    header("Location:Salir.php");
}
switch($datosUsuario['idRol']){
    case 1:
        $idRol = "Administrador";
    break;
    case 2:
        $idRol = "Docente";
    break;
    case 3:
        $idRol = "Estudiante";
    break;
}
?>
    <div class="container mt-4">
        <div class="jumbotron bg-s-second text-dark">
            <h1>Bienvenido!</h1>
            <h1><?php echo $idRol?></h1>
            <h1><?php echo $datosUsuario['nombres']?></h1>
            
        </div>
        <div class="list-group list-group-flush rounded">
            <!--<div class="list-group-item">
                <svg class="" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" height="4rem" 
                        viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve">
                    <path style="fill:#5C6BC0;" d="M255.968,5.329C114.624,5.329,0,120.401,0,262.353c0,113.536,73.344,209.856,175.104,243.872
                        c12.8,2.368,17.472-5.568,17.472-12.384c0-6.112-0.224-22.272-0.352-43.712c-71.2,15.52-86.24-34.464-86.24-34.464
                        c-11.616-29.696-28.416-37.6-28.416-37.6c-23.264-15.936,1.728-15.616,1.728-15.616c25.696,1.824,39.2,26.496,39.2,26.496
                        c22.848,39.264,59.936,27.936,74.528,21.344c2.304-16.608,8.928-27.936,16.256-34.368c-56.832-6.496-116.608-28.544-116.608-127.008
                        c0-28.064,9.984-51.008,26.368-68.992c-2.656-6.496-11.424-32.64,2.496-68c0,0,21.504-6.912,70.4,26.336
                        c20.416-5.696,42.304-8.544,64.096-8.64c21.728,0.128,43.648,2.944,64.096,8.672c48.864-33.248,70.336-26.336,70.336-26.336
                        c13.952,35.392,5.184,61.504,2.56,68c16.416,17.984,26.304,40.928,26.304,68.992c0,98.72-59.84,120.448-116.864,126.816
                        c9.184,7.936,17.376,23.616,17.376,47.584c0,34.368-0.32,62.08-0.32,70.496c0,6.88,4.608,14.88,17.6,12.352
                        C438.72,472.145,512,375.857,512,262.353C512,120.401,397.376,5.329,255.968,5.329z"/>
                    <g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g>
                </svg>
                <a href="https://github.com/drtocino/sistemaTesis">Clona el Proyecto</a>
            </div>-->
            <div class="list-group-item">
                <svg class="" data-name="Capa 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100.3 76.5" height="4rem" width="4rem">
                <path d="M46.3 26.5H26.9L20.8 16h31.6l9.2-16H9.4a9.3 9.3 0 00-8.1 4.7 9.3 9.3 0 000 9.4l33.3 57.7a9.4 9.4 0 0016.2 0l1.1-1.9-15.3-26.6z" fill="#4ad295"/>
                <path d="M84.2 4.7A9.3 9.3 0 0076.1 0h-2.3l-25 43.3 9.2 16L84.2 14a9.3 9.3 0 000-9.3z" fill="#4ad295"/>
                </svg>
                
                <a href="https://www.flaticon.es/">Revisa la Iconografia</a>
                <br>Icons made by <a href="https://www.flaticon.com/authors/flat-icons" title="Flat Icons">Flat Icons</a> from <a href="https://www.flaticon.com/" title="Flaticon"> www.flaticon.com</a>
                <br>Iconos diseñados por <a href="https://www.flaticon.es/autores/prettycons" title="prettycons">prettycons</a> from <a href="https://www.flaticon.es/" title="Flaticon"> www.flaticon.es</a>
                <br>Iconos diseñados por <a href="https://www.flaticon.es/autores/smashicons" title="Smashicons">Smashicons</a> from <a href="https://www.flaticon.es/" title="Flaticon"> www.flaticon.es</a>
            </div>
        </div>
    </div>
    <script src="../js/jquery-3.5.1.min.js"></script>
    <script src="../js/popper.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
</body>
</html>