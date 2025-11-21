$(document).ready(function(){

    $(document).on('click', '#btn_paypal_vault', function(){
        PayPal.crear_vault();
    });

    $(document).on('click', '#btn_validar_pago', function(){
        PayPal.validar_pago_vault();
    });

});

var PayPal = {

    html_spinner : function (){
        var html = '' +
            '<div class="spinner-border text-success" role="status">' +
            '<span class="sr-only">Loading...</span>' +
            '</div>';
        return html;
    },

    crear_vault : function(){
        $.ajax({
            method: 'post',
            url : 'private/createOrderVault.php',
            dataType: 'json',
            data : {},
            success : function (response) {
                console.log(response);
                //simulemos que todo paso bien
                $('#pago_vault_success').fadeIn();
                $('#url_redirect').html(response.vault.links[1].href);
                var html_link = '<a href="'+response.vault.links[1].href+'" class="">Ir a PayPal</a>';
                $('#pago_vault_success').append(html_link);
                // setTimeout(function(){
                //     window.location.href = response.vault.links[1].href;
                // },8000);
            },
            error : function () {
                alert('hubo un error uuuu dile al programador');
            }
        });
    },

    validar_pago_vault : function(){
        $('#json_resultado_pago').html(PayPal.html_spinner());
        $.ajax({
            method: 'post',
            url : 'private/validarOrderVault.php',
            dataType: 'json',
            data : {
                approval_token_id : $('#approval_token_id').val()
            },
            success : function (response) {
                console.log(response);
                //simulemos que todo paso bien
                renderJson(response,'#json_resultado_pago');
            },
            error : function () {
                alert('hubo un error uuuu dile al programador');
            }
        });
    }

};

function renderJson(json,preToJSON){
    var opciones = {
        collapsed : false,
        rootCollapsable : true,
        withQuotes : false,
        withLinks : true
    };
    $(preToJSON).jsonViewer(json,opciones);
}