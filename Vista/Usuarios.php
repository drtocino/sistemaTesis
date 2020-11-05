<?php
session_start();
require_once("../Controlador/LNListaUsuario.php");
$Usuario = new LNListaUsuario();
$estado = "";
$tipoUsuario = "";
$ListaUsuarios = $Usuario->busquedaUsuario($estado,$tipoUsuario);
if(isset($_POST['estado'])){
    $estado = $_POST['estado'];
    $ListaUsuarios = $Usuario->busquedaUsuario($estado,$tipoUsuario);
    if(isset($_POST['tipoUsuario'])){
        $tipoUsuario = $_POST['tipoUsuario'];
        $ListaUsuarios = $Usuario->busquedaUsuario($estado,$tipoUsuario);
    }
}

if($ListaUsuarios){
?>
<table class="table" id="group">
    <thead class="">
        <tr>
            <th>Nombre Completo</th>
            <th>Estado</th>
            <th>Rol</th>
            <th>Usuario</th>
            <th>CI</th>
            <th>Fecha Registro</th>
            <?php if($_SESSION['idRol'] == 1){?>
            <th></th>
            <?php }?>
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
            <td><?php echo $lista['ci']?></td>
            <td><?php echo $lista['fechaRegistro']?></td>
            <?php if($_SESSION['idRol'] == 1){?>
            <td>
                <a href="UsuarioDetalle.php?idUsuario=<?php echo $lista['idPersona']?>">
                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-info-square-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2zm8.93 4.588l-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM8 5.5a1 1 0 1 0 0-2 1 1 0 0 0 0 2z"/>
                    </svg>
                </a>
            </td>
            <?php }?>
            <td>
                <a href="ActualizarUsuario.php?idUsuario=<?php echo $lista['idPersona']?>">
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

<?php
}else{
?>
    <h4>No se encontraron conincidencias :(</h4>
<?php
}
?>
<script>
    $(document).ready( function () {
        $('#group').DataTable();
    } );
</script>