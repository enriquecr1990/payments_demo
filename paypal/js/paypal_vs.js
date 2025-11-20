$(document).ready(function(){

    $(document).on('click', '#btn_paypal_vault', function(){
        PayPal.crear_vault();
    });

    $(document).on('click', '#btn_validar_pago', function(){
        PayPal.validar_pago_vault();
    });

});

var PayPal = {

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
                setTimeout(function(){
                    window.location.href = response.vault.links[1].href;
                },8000);
            },
            error : function () {
                alert('hubo un error uuuu dile al programador');
            }
        });
    },

    validar_pago_vault : function(){
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
                $('#txt_response_vault').val(JSON.stringify(response));
            },
            error : function () {
                alert('hubo un error uuuu dile al programador');
            }
        });
    }

};