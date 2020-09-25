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
            <tr><th>Facultad</th><th class="text-center">Tesis</th><th></th><th></th></tr>
        </thead>
        <tbody>
    <?php foreach($lista as $resultado){?>
            <tr>
                <td><?php echo $resultado['nombre']?></td>
                <td class="text-center"><?php echo $resultado['documentos']?></td>
                <td><a href="TesisCarrera.php?facultad=<?php echo $resultado['idFacultad']?>" class="btn btn-dark">Por Carrera</a></td>
                <td><a href="TesisFacultadAnual.php?facultad=<?php echo $resultado['idFacultad']?>" class="btn bg-main">Reporte Anual</a></td>
            </tr>
            <?php
        }
        ?>
    </tbody>
    </table>
    <div class="grafico">
        <canvas id="chart1"></canvas>
    </div>
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
<script>
        var ctx= document.getElementById("chart1").getContext("2d");
        var Torta= new Chart(ctx,{
            type:"pie",
            data:{
                labels:[
                    <?php foreach($lista as $datoN){?>
                        '<?php echo $datoN['nombre']?>',
                    <?php }?>
                ],
                datasets:[{
                    label:"Datos",
                    data:[
                        <?php foreach($lista as $dato){?>
                            <?php echo $dato['documentos']?>,
                        <?php }?>
                    ],
                    backgroundColor:[
                        'rgb(240, 165, 0)',
                        'rgb(51, 51, 51)',
                        'rgb(180, 180, 180)'
                    ]
                }]
            }
        });
</script>