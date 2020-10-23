<?php
session_start();
require_once("../Controlador/LNListaUsuario.php");
$Usuario = new LNListaUsuario();
$ListaUsuarios = $Usuario->listaUsuario();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../css/bootstrap.min.css">
        <link rel="stylesheet" href="../css/style.css">
        <link rel="stylesheet" href="../css/jquery.dataTables.min.css">
        <title>Lista de Usuarios</title>
    </head>
    <style>
        table{
            border-radius:10rem;
        }
        thead{
            border-radius:10rem;
        }
        </style>
<body>
    <?php if(!$_SESSION){
        header("Location:Salir.php");
    }else{
        include("plantillas/navBar.php");?>
        <button type="button" class="bg-s-second btn-plus text-dark" data-toggle="modal" data-target="#exampleModal">+</button>
        <!--<a href="RegistrarTesis.php" class="bg-s-second btn-plus text-dark">+</a>-->
<?php
    }?>
    <div class="container rounded bg-light mt-3 mb-3 pt-3 pb-3">
        <h1>Lista de Usuarios</h1>
        <table class="table" id="group">
            <thead class="">
                <tr>
                    <th>Nombre Completo</th>
                    <th>Estado</th>
                    <th>Tipo Usuario</th>
                    <th>Usuario</th>
                    <th>Fecha</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody class="">
                <?php foreach($ListaUsuarios as $lista){?>
                <tr>
                    <td><?php echo $lista['nombres']?></td>
                    <td><?php if($lista['activo']) echo "Activo"; else echo "Inactivo"?></td>
                    <td>
                    <?php switch($lista['idRol']){ case 1:echo "Administrador";break;case 2:echo "Docente";break;case 3:echo "Estudiante";break;}?>
                    </td>
                    <td><?php echo $lista['usuario']?></td>
                    <td><?php echo $lista['fechaRegistro']?></td>
                    <td>
                        <a href="">
                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-pencil-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z"/>
                            </svg>
                        </a>
                    </td>
                    <td>
                        <a href="">
                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-trash-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5a.5.5 0 0 0-1 0v7a.5.5 0 0 0 1 0v-7z"/>
                            </svg>
                        </a>
                    </td>
                </tr>
                <?php }?>
            </tbody>
        </table>
    </div>
    <!-- Button trigger modal -->

<!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <form action="" class="was-validated" method="POST">
                <div class="modal-content">
                    <div class="modal-header bg-main text-light">
                        <h5 class="modal-title" id="exampleModalLabel">Registro Usuario</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
    
                    <div class="modal-body">
                        <input type="text" name="primerNombre" class="form-control mt-3 bb text" placeholder="Primer Nombre" pattern="[A-Za-z0-9\s]{3,12}" title="Use solo letras y son requeridos 3 caracteres minimos, 12 maximo" required>
                        <input type="text" name="segundoNombre" class="form-control mt-3" id="" placeholder="Segundo Nombre" pattern="[A-Za-z0-9\s]{3,12}" title="Use solo letras y son requeridos 3 caracteres minimos, 12 maximo">
                        <input type="text" name="primerApellido" class="form-control mt-3" id="" placeholder="Primer Apellido" required pattern="[A-Za-z0-9\s]{3,12}" title="Use solo letras y son requeridos 3 caracteres minimos, 12 maximo">
                        <input type="text" name="segundoApellido" class="form-control mt-3" id="" placeholder="Segundo Apellido" required pattern="[A-Za-z0-9\s]{3,12}" title="Use solo letras y son requeridos 3 caracteres minimos, 12 maximo">
                        <input type="text" name="ci" class="form-control mt-3" id="" placeholder="CI" required pattern="[0-9\s]{5,10}" title="Ingrese un numero de 5 hasta 10 caracteres">
                        <select name="rol" id="" class="custom-select mt-3" required>
                            <option value="" disabled selected>Tipo de Usuario</option>
                            <option value="1">Administrador</option>
                            <option value="2">Docente</option>
                            <option value="3">Estudiante</option>
                        </select>
                        <select name="carrera" id="carrera" class="custom-select mt-3" required>
                            <option value="" selected disabled>Seleccione una Carrera</option>
                            <?php foreach($lista as $datos){?>
                            <option value="<?php echo $datos['idCarrera']?>"><?php echo $datos['nombre']?></option>
                            <?php }?>
                        </select>
                        <input type="text" class="form-control mt-3" name="telefono" id="" placeholder="Telefono" required pattern="[0-9\s]{6,8}" title="Ingrese un numero de 6 hasta 8 caracteres">
                        <div class="custom-file mt-3">
                            <input type="file" class="custom-file-input" name="fotografia" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01" lang="es" required>
                            <label class="custom-file-label text-left" for="inputGroupFile01">Fotografia de la persona en formato png, jpg o jpeg</label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-dark" data-dismiss="modal">Cerrar</button>
                        <input type="submit" value="Registrar" class="btn bg-s-second">
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script src="../js/jquery-3.5.1.min.js"></script>
    <script src="../js/popper.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready( function () {
            $('#group').DataTable();
        } );
    </script>
</body>
</html>