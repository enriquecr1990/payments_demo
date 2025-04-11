$(document).ready(function(){

    $('#btn_pagar_bamboo_old').on('click',function(){
        Bamboo.startForm();
    });

    $('#btn_pagar_bamboo').on('click',function(){
        Bamboo.procesar_formulario_api();
    });

    $('#btn_validar_bamboo').on('click',function(){
        Bamboo.validar_pago();
    });

});

var Bamboo = {

    //primeras integraciones
    procesar_formulario_api : function(){
        $.ajax({
            url: '/bamboo/private/procesar_orden.php',
            type: 'POST',
            data : {
                operacion : 'crear_orden',
            },
            dataType:'json',
            success:function(response){
                alert('termino el proceso bien');
                console.log(response);
                $('#purchase_id').val(response.data.curlopt.Response.PurchaseId);
                $('#div_validar_pago').fadeIn();
            },
            error: function (xhr) {
                alert('algo salio mal');
                console.log(xhr);
            }
        });
    },

    validar_pago : function(){
        $.ajax({
            url: '/bamboo/private/procesar_orden.php',
            type: 'POST',
            data : {
                operacion : 'validar_pago',
                purchase_id: $('#purchase_id').val()
            },
            dataType:'json',
            success:function(response){
                alert('termino el proceso bien de validacion');
                console.log(response);
            },
            error: function (xhr) {
                alert('algo salio mal');
                console.log(xhr);
            }
        });
    },

    //pruebas para primera version de integracion 
    startForm : function(){
        PWCheckout.SetProperties({
            "name": "Mi tienda",
            "email": "enriquecr1990@gmail.com",
            "image": "https://mystore.com/media/logo/stores/1/MyStore-long-RBG-08262021.jpg",
            "button_label": "Pagar 1842.21",
            "description": "Checkout de Mi tienda TESTING ecr",
            "currency": "USD",
            "amount": "1843.21",
            "lang": "ES",
            "form_id": "form_to_bamboo",
            "checkout_card": "1",
            "autoSubmit": `true`,
            "email_edit": `false`,
            "country_code" : "UY"
        });
        PWCheckout.SetStyle({
            "backgroundColor": "f2f2f2",
            "buttonColor": "555555",
            "buttonHoverColor": "777777",
            "buttonTextColor": "ffffff",
            "buttonTextHoverColor": "ffffff",
            "inputBackgroundColor": "ffffff",
            "inputTextColor": "767676",
            "inputErrorColor": "ff0000",
            "inputAddonBackgroundColor": "ffffff",
            "labelColor": "494949"
        });
        // PWCheckout.SetStyle({
        //     "width": "1600px",
        //     "height": "800px",
        //     "margin": "auto"
        // });
    
        function WindowIsOpen(){
            console.log("Checkout Window is Open");
        }
        PWCheckout.Bind("opened", WindowIsOpen);
        PWCheckout.Unbind("opened", WindowIsOpen);
        PWCheckout.AddActionButton("btn_pagar_bamboo_old");
        var paymentMediaId = [1,2,3,4,5,7];
        var bankId = [1,2,3,4,5,6,7,8,9,10,11,12];
        var paymentMediaType = [1,2,6,7,101,102,104,105]
        PWCheckout.Iframe.OpenIframeWithPaymentMediaOptions(paymentMediaId, bankId, paymentMediaType);
    },

    addScriptDataFast: function(checoutId){
        var strScript = '<script src="https://test.oppwa.com/v1/paymentWidgets.js?checkoutId='+checoutId+'"></script>';
        $('body').append(strScript);
    },

    addFormDataFast : function (){
        $('#form_to_datafast').html('<form action="http://payments-local.com/datafast/respuesta" class="paymentWidgets" data-brands="VISA MASTER AMEX"></form>');
    }

};