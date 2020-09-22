<?php
require_once("../Controlador/LNListaFacultad.php");
$objDatosFacultad = new LNListaFacultad();
$busqueda="";
$lista = $objDatosFacultad->reporteFacultad($busqueda);

if(isset($_POST['consulta'])){
    $busqueda = $_POST["consulta"];
    $lista = $objDatosFacultad->reporteFacultad($busqueda);
}
//echo $usuario['idMateria'];
//echo var_dump($lista);
    if($lista){
    ?>
    <table class="table table-fluid" id="group">
        <thead>
            <tr><th>Facultad</th><th>Tesis</th><th></th><th></th></tr>
        </thead>
        <tbody>
    <?php foreach($lista as $resultado){?>
            <tr>
                <td><?php echo $resultado['nombre']?></td>
                <td><?php echo $resultado['documentos']?></td>
                <td><a href="TesisCarrera.php?facultad=<?php echo $resultado['idFacultad']?>" class="btn btn-dark">Por Carrera</a></td>
                <td><a href="TesisFacultadAnual.php?facultad=<?php echo $resultado['idFacultad']?>" class="btn btn-success">Reporte Anual</a></td>
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
        $('#group').DataTable();
    } );
</script>