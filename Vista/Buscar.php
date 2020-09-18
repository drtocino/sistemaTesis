<?php
require_once("../Controlador/LNListaTesis.php");
$objetoTesis = new LNListaTesis();
$busqueda="";
$lista = $objetoTesis->listaTesis($busqueda);

if(isset($_POST['consulta'])){
    $busqueda = $_POST["consulta"];
    $lista = $objetoTesis->listaTesis($busqueda);
}
//echo $usuario['idMateria'];
//echo var_dump($lista);
    if($lista){
    ?>
    <table class="table table-fluid" id="group">
        <thead>
            <tr>
                <th>Codigo</th>
                <th>Autor</th>
                <th>Titulo de Tesis</th>
                <th>Tipo Tesis</th>
            </tr>
        </thead>
        <tbody>
    <?php foreach($lista as $resultado){?>
            <tr>
                <td><?php echo $resultado['codigoTesis']?></td>
                <td><?php echo $resultado['autor']?></td>
                <td><a href=""><?php echo $resultado["titulo"]?></a></td>
                <td><?php echo $resultado['tipoTesis']?></td>
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