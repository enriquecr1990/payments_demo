$(document).ready(function(){

    $(document).on('click','#pagar_fac_rsk',function(){
        FacRsk.procesar_pago();
    });

});

var FacRsk = {

    procesar_pago : function(){
        $.ajax({
            method: 'post',
            url: 'private/procesar_pago.php',
            dataType : 'json',
            data : {},
            success : function (response) {
                //console.log(response);
                var iframe = '<iframe style="width: 100%; height: 400px" srcdoc="'+response.resultado.RedirectData+'"></iframe>'
                $('#contenedor_pago_facrsk').html(iframe);
                window.onload = redirectParent;
                function redirectParent(){
                    window.parent.location = './AutenticaciónResult';
                }
            },
            error :function(){
                alert('hubo un error uuuu dile al programador');
            }
        });
    },

    respuesta_pago_iframe : function(campo){
        alert('hubo una respuesta ' + campo );
        window.location = base_url + 'index.php?respuesta=algo por aqui'
    }

}