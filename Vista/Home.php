<?php
session_start();
if($_SESSION['idUsuario']){
    include_once("plantillas/navBar.php");
}else{
    header("Location:Salir.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
</head>
<body>
    <div class="container">
        <h1>Bienvenido!</h1>
    </div>
</body>
</html>