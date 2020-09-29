$(buscarDatos());

function buscarDatos(consulta,consulta2){
    console.log(consulta,consulta2);
    $.ajax({
        url: 'busquedaFecha.php',
        type: 'POST',
        dataType: 'html',
        data: {consulta: consulta,
            consulta2: consulta2        
        },
    })
    .done(function(respuesta){
        $("#datos").html(respuesta);
    })
    .fail(function(){
        console.log("error");
    })
}

/*$(document).on('keyup','#fechaInicio',function(){
    var valor = $(this).val();
    if(valor != ""){
        buscarDatos(valor,valor2);
        
    }else{
        buscarDatos();
    }
    
});*/

$(document).on('change','#fechaFin',function(){
    var valor = $("#fechaInicio").val();
    var valor2 = $(this).val();
    if(valor2 != ""){
        buscarDatos(valor,valor2);
        
    }else{
        buscarDatos();
    }
}

);