<?php
include("plantillas/navBar.php");
require_once("../Controlador/LNListaUsuario.php");
$objDatosUsuario = new LNListaUsuario();
$lista = $objDatosUsuario->listaUsuario();
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
    <div class="container mt-4 mb-4">
        <div class="card card-secondary bg-dark text-center w-75 mx-auto d-block">
            <div class="card-header bg-main text-dark">
                <h3>Registro Tesis</h3>
            </div>
            <div class="card-body border-secondary bg-dark">
                <form action="" class="was-validated">
                    <input type="text" name="titulo" class="form-control mt-3 bb text" placeholder="Titulo" required>
                    <input type="text" name="autor" class="form-control mt-3 bg text" placeholder="Autor" list="listaAutores" required>
                    <datalist id="listaAutores">
                        <?php foreach($lista as $datos){?>
                            <option value="<?php echo $datos['idPersona']?>"><?php echo $datos['nombres']?></option>
                        <?php }?>
                    </datalist>
                    <input type="text" name="tipoBibliografia" class="form-control mt-3 bg text" placeholder="Tipo de Bibliografia" required>
                    <input type="text" name="facultad" class="form-control mt-3 bg text" placeholder="Facultad" required>
                    <input type="text" name="carrera" class="form-control mt-3 bg text" placeholder="Carrera" required>
                    <input type="text" name="resumen" class="form-control mt-3 bg text" placeholder="Resumen" required>
                    <div class="input-group mt-3">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01" required>
                            <label class="custom-file-label text-left" for="inputGroupFile01">Elija una Imagen</label>
                        </div>
                    </div>
                    <input type="submit" value="Registrar" class="btn btn-lg btn-light mt-3">
                </form>
            </div>
        </div>
    </div>
</body>
</html>