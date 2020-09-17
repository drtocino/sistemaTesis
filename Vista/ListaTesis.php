<?php
include_once("plantillas/navBar.php");
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
<body>
    <div class="container">
        <h1>Lista Tesis</h1>
        <div class="input-group mt-3 mb-3">
            <input type="text" class="form-control" placeholder="Ingrese un Titulo" title="Escriba solo una palabra por favor" name="buscar" id="buscar">
            <div class="input-group-append">
                <button class="btn btn-outline-dark btn-block">Buscar</button>
            </div>
        </div>
        <div class="table-responsive" id="datos"></div>
    </div>
    <script src="../js/jquery-3.5.1.min.js"></script>
    <script type="text/javascript" src="../js/main.js"></script>
    <script src="../js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready( function () {
            $('#group').DataTable();
        } );
    </script>
</body>
</html>