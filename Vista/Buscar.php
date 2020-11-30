<?php
require_once("../Controlador/LNListaTesis.php");
$objetoTesis = new LNListaTesis();
$idFacultad = "";
$idCarrera = "";
$idTipoTesis = "";
$anio = "";
$lista = $objetoTesis->listaTesis($idFacultad,$idCarrera,$idTipoTesis,$anio);

if(isset($_POST['facultad'])){
    $idFacultad = $_POST["facultad"];
    $lista = $objetoTesis->listaTesis($idFacultad,$idCarrera,$idTipoTesis,$anio);
    if(isset($_POST['carrera'])){
        $idCarrera = $_POST['carrera'];
        $lista = $objetoTesis->listaTesis($idFacultad,$idCarrera,$idTipoTesis,$anio);
        if(isset($_POST['tipo'])){
            $idTipoTesis = $_POST['tipo'];
            $lista = $objetoTesis->listaTesis($idFacultad,$idCarrera,$idTipoTesis,$anio);
            if(isset($_POST['anio'])){
                $anio = $_POST['anio'];
                $lista = $objetoTesis->listaTesis($idFacultad,$idCarrera,$idTipoTesis,$anio);
            }
        }
    }
}else{
    /*if(isset($_POST['anio'])){
        $idTipoTesis = $_POST['anio'];
        $lista = $objetoTesis->listaTesis($idFacultad,$idCarrera,$idTipoTesis,$anio);
    }*/
}

/*elseif(isset($_POST['tipo'])){
    $idTipoTesis = $_POST['tipo'];
    $lista = $objetoTesis->listaTesis($idFacultad,$idCarrera,$idTipoTesis);
}*/
//echo $usuario['idMateria'];
//echo var_dump($lista);
    if($lista){
    ?>
    <style>
        tbody{
            background: ;
        }
    </style>
    <table class="table table-fluid rounded" id="group">
        <thead>
            <tr>
                <th>Codigo</th>
                <th>Autor</th>
                <th>Titulo de Tesis</th>
                <th>Tipo Tesis</th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
    <?php foreach($lista as $resultado){?>
            <tr>
                <td><?php echo $resultado['codigoTesis']?></td>
                <td><?php echo $resultado['autor']?></td>
                <td><a href="TesisDetalle.php?idTesis=<?php echo $resultado['idDocumentoTesis']?>&t=1"><?php echo $resultado["titulo"]?></a></td>
                <td><?php echo $resultado['tipoTesis']?></td>
                <td>
                    <a href="ActualizarTesis.php">
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
            <?php
        }
        ?>
    </tbody>
    </table>
    <?php
    }else{
    ?>
        <h4>No se encontraron coincidencias :(</h4>
    <?php
    }
?>
<script>
    $(document).ready( function () {
        $('#group').DataTable({
            "ordering": false
        });
    } );
</script>