$(buscarDatos());

function buscarDatos(consulta,consulta2,consulta3){
    $.ajax({
        url: 'BuscarTesisCarrera.php',
        type: 'POST',
        dataType: 'html',
        data: {consulta: consulta,
                consulta2: consulta2,
                consulta3: consulta3},
    })
    .done(function(respuesta){
        $("#datos").html(respuesta);
    })
    .fail(function(){
        console.log("error");
    })
}

$(document).on('keyup','#buscar',function(){
    var valor = $(this).val();
    if(valor != ""){
        buscarDatos(valor);
    }else{
        buscarDatos();
    }
});