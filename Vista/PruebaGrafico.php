<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Graficos</title>
</head>
<style>
    .container{
        max-width: 50%;
    }
</style>
<body>
    <div class="container">
        <div class="container mt-4 p-4 bg-dark text-white">
            <h1>Grafica de Torta</h1>
            <canvas id="chart1"></canvas>
        </div>
    </div>
    <script src="../js/Chart.js"></script>
    <script>
        var ctx= document.getElementById("chart1").getContext("2d");
        var Torta= new Chart(ctx,{
            type:"pie",
            data:{
                labels:['Ingenieros','Empresarios','Maestros'],
                datasets:[{
                    label:"Num Datos",
                    data:[20,10,30],
                    backgroundColor:[
                        'rgb(252, 186, 3)',
                        'rgb(51, 51, 51)',
                        'rgb(230, 230, 230)'
                    ]
                }]
            }
        });
    </script>
</body>
</html>