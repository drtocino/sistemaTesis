<?php 
include("plantillas/navBar.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <title>Actualizar Tesis</title>
</head>
<body>
    <div class="container mt-4 mb-4">
    <div class="card card-secondary bg-dark text-center w-75 mx-auto d-block">
            <div class="card-header bg-main text-dark">
                <h3>Registro Tesis</h3>
            </div>
            <div class="card-body border-secondary bg-light">
                <form action="../Controlador/LNRegistroTesis.php" method="POST" class="was-validated" enctype="multipart/form-data">
                    <input type="text" name="titulo" class="form-control mt-3 bb text" placeholder="Titulo" required>
                    <!--<input type="text" name="autor" class="form-control mt-3 bg text" placeholder="Autor" list="listaAutores"  required>
                    <!--<datalist id="listaAutores">
                        <?php /*foreach($personas as $datos){?>
                            <option value="<?php echo $datos['nombres']?>"><?php echo $datos['idPersona']?></option>
                        <?php }*/?>
                    </datalist>-->
                    <select name="" id="" class="form-control mt-3" placeholder="Autor" required>
                        <option value="" selected disabled>Autor</option>
                        <?php foreach($personas as $datos){?>
                            <option value="<?php echo $datos['idPersona']?>"><?php echo $datos['nombres']?></option>
                        <?php }?>
                    </select>
                    <select name="tipoBibliografia" id="" class="form-control mt-3" required>
                        <option value="" disabled selected>Tipo de Bibliografia</option>
                        <?php foreach($tipoTesis as $tipo){?>
                        <option value="<?php echo $tipo['idTipoTesis']?>"><?php echo $tipo['nombre']?></option>
                        <?php }?>
                    </select>
                    <div class="row">
                        <div class="col-lg-6">
                            <select name="facultad" id="facultad" class="form-control mt-3" required>
                                <option value="" selected disabled>Seleccione una Facultad</option>
                                <?php foreach($facultades as $dato){?>
                                <option value="<?php echo $dato['idFacultad']?>"><?php echo $dato['nombre']?></option>
                                <?php }?>
                            </select>
                        </div>
                        <div class="col-lg-6">
                            <select name="carrera" id="carrera" class="form-control mt-3" required>
                                <option value="" selected desabled>Seleccione una Facultad Primero</option>
                            </select>
                        </div>
                    </div>
                    <textarea name="resumen" class="form-control mt-3" id="" cols="30" rows="5" placeholder="Resumen" required></textarea>
                    <textarea name="introduccion" class="form-control mt-3" id="" cols="30" rows="5" placeholder="Introduccion" required></textarea>
                    <input type="file" name="imagenTapa" id="imagenTapa" class="form-control mt-3" id="" required>
                    <!--<div class="input-group mt-3">
                        <div class="custom-file">
                            <input type="file" name="imagenTapa" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01">
                            <label class="custom-file-label text-left" for="inputGroupFile01">Elija una Imagen</label>
                        </div>
                    </div>-->
                    <input type="submit" value="Registrar" class="btn btn-block btn-danger mt-3">
                </form>
            </div>
    </div>
</body>
</html>