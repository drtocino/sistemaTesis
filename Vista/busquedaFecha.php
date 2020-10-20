<?php
require_once("../Controlador/LNListaFacultad.php");
$objDatosFacultad = new LNListaFacultad();
$fechaInicio="";
$fechaFin='';
$busqueda = '';
$lista = $objDatosFacultad->reporteFacultadFecha($fechaInicio,$fechaFin);


if(isset($_POST['consulta2'])){
    $fechaInicio = $_POST["consulta"];
    $fechaFin = $_POST["consulta2"];
    $lista = $objDatosFacultad->reporteFacultadFecha($fechaInicio,$fechaFin);
    //var_dump($lista);
    /*if(isset($_POST['consulta2'])){
        $fechaFin = $_POST["consulta2"];
        $lista = $objDatosFacultad->reporteFacultadFecha($fechaInicio,$fechaFin);
    }*/
}elseif(isset($_POST['consulta'])){
    $fechaFin = $_POST["consulta"];
    $lista = $objDatosFacultad->reporteFacultadFecha($fechaInicio,$fechaFin);
}else{
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
                <td><a href="TesisFacultadAnual.php?facultad=<?php echo $resultado['idFacultad']?>" class="btn bg-main text-light">Reporte Anual</a></td>
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
                        'rgb(0, 106, 113)',
                        'rgb(203, 234, 237)',
                        'rgb(211, 222, 50)',
                        'rgb(74, 74, 74)',
                    ]
                }]
            }
        });
</script>