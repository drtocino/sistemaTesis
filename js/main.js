$(buscarDatos());

function buscarDatos(facultad){
    $.ajax({
        url: 'Buscar.php',
        type: 'POST',
        dataType: 'html',
        data: {facultad: facultad,
                carrera,carrera
        },
    })
    .done(function(respuesta){
        $("#datos").html(respuesta);
    })
    .fail(function(){
        console.log("error");
    })
}

$(document).on('change','#facultad',function(){
    var valor = $(this).val();    
    if(valor != ""){
        buscarDatos(valor);
    }else{
        buscarDatos();
    }
});