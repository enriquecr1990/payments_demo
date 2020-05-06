$(document).ready(function(){

    $('#btn_pagar_datafast').on('click',function(){
        DataFast.processFormDataFast();
    });

});

var DataFast = {

    processFormDataFast : function(){
        $.ajax({
            method: 'post',
            url: 'private/identificador_pago.php',
            dataType : 'json',
            data : {},
            success : function (response) {
                if(response.status){
                    DataFast.addScriptDataFast(response.checkoutId);
                    DataFast.addFormDataFast();
                }
            },
            error :function(){
                alert('hubo un error uuuu dile al programador');
            }
        });
    },

    addScriptDataFast: function(checoutId){
        var strScript = '<script src="https://test.oppwa.com/v1/paymentWidgets.js?checkoutId='+checoutId+'"></script>';
        $('body').append(strScript);
    },

    addFormDataFast : function (){
        $('#form_to_datafast').html('<form action="http://payments-local.com/datafast/respuesta" class="paymentWidgets" data-brands="VISA MASTER AMEX"></form>');
    }

};