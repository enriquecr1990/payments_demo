$(document).ready(function(){

    $(document).on('click','#pagar_fac_rsk',function(){
        FacRsk.procesar_pago();
    });

});

var FacRsk = {

    procesar_pago : function(){
        //se procesa el post como siempre
        var country = $('#slt_country').val();
        $('#contenedor_mensajes').hide();
        $('#listado_mensajes').html('');
        if(country != ''){
            //se procesa la peticion como redirect simulado
            if($('#slt_redirect').val() == 'si'){
                window.location = 'pago_redirect.php?country='+$('#slt_country').val()
            }else{
                $.ajax({
                    method: 'post',
                    url: 'private/procesar_pago.php',
                    dataType : 'json',
                    data : {
                        'country' : $('#slt_country').val(),
                    },
                    success : function (response) {
                        console.log(response);
                        if(response.status){
                            var iframe = '<iframe style="width: 100%; height: 500px" onload="onload_iframe()" srcdoc="'+response.data.RedirectData+'" ></iframe>'
                            $('#contenedor_pago_facrsk').html(iframe);
                            window.onload = redirectParent;
                            function redirectParent(){
                                window.parent.location = 'http://broker.dev.com/fac/respuesta.php';
                            }
                            // window.location = response.resultado.RedirectData;
                        }else{
                            $('#contenedor_mensajes').show();
                            $('#listado_mensajes').html(FacRsk.mensajes_error(response.msg));
                        }
                    },
                    error :function(){
                        alert('hubo un error uuuu dile al programador');
                    }
                });   
            }
        }else{
            $('#contenedor_mensajes').show();
            $('#listado_mensajes').html('<li>El campo de país es requerido</li>');
        }
    },

    mensajes_error : function(mensajes){
        var html_mensajes = '';
        mensajes.forEach(function(msg){
            html_mensajes += '<li>'+msg+'</li>';
        });
        return html_mensajes;
    },

    respuesta_pago_iframe : function(campo){
        alert('hubo una respuesta ' + campo );
        window.location = base_url + 'index.php?respuesta=algo por aqui'
    }

}

function onload_iframe(){
    window.onload = redirectParent;
    function redirectParent(){
        window.parent.location = 'http://broker.dev.com/fac/respuesta.php';
    }
}