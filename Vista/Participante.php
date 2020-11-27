<?php
require_once("../Controlador/LNListaParticipante.php");
$objetoParticipantes = new LNListaParticipante();
$lista = $objetoParticipantes->listaParticipante();
if($lista){
?>
    <table class="table table-fluid" id="group">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>CI</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
        <?php foreach($lista as $resultado){?>
            <tr>
                <td><?php echo $resultado['nombreCompleto']?></td>
                <td><?php echo $resultado['ci']?></td>
                <td>
                    <a href="ActualizarUsuario.php?idUsuario=<?php // echo $lista['idPersona']?>">
                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-pencil-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z"/>
                        </svg>
                    </a>
                </td>
            </tr>

        <?php }?>
        </tbody>
    </table>

<?php
}
?>
<script>
    $(document).ready( function () {
        $('#group').DataTable();
    } );
</script>