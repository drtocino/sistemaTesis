<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exito</title>
</head>
<body>
    <div class="container text-center mt-4">
        <h2 class="text-success">Exito <span class="text-danger"></span></h2>
        <h4>Registro realizado con exito</h4>
        <?php if(isset($_REQUEST['password'])){?>
            <h4>El password es <?php echo $_REQUEST['password']?></h4>
        <?php }?>
        <a href="ListaTesis.php" class="btn btn-success mt-4">Lista de Tesis</a>

    </div>
</body>
</html>