$(document).ready(function(){

    $(document).on('keyup','#cardNumber',function(){
        MP.processBinPayment($(this));
    });

    $(document).on('click','#btnPaymentMPSubmit',function(){
        //no olvidar la validacion del formulario
        //usarlo cuando se implemente en el sistema a usar
        MP.processPaymentToken();
    });

    MP.initVars();

});

var MP = {

    initVars : function(){
        Mercadopago.setPublishableKey("TEST-336967b6-08ff-48b4-9a27-aac54ce85495");
    },

    processBinPayment : function (input){
        if(input.val().length == 6){
            var bin = input.val().substring(0,6);
            Mercadopago.getPaymentMethod({
                "bin": bin
            }, MP.setPaymentMethodInfo);
        }
    },

    setPaymentMethodInfo : function (status,response){
        if (status == 200) {
            var id = response[0].id;
            var url_img = response[0].secure_thumbnail;
            var name = response[0].name;
            var html_img = '<img src="'+url_img+'" alt="'+name+'">';
            $('#paymentMethodId').val(id);
            $('#typeCard').html(html_img);
            $('#typeCard').closest('div').fadeIn();
        } else {
            $('#typeCard').closest('div').fadeOut();
            alert(`payment method info error: ${response}`);
        }
    },

    processPaymentToken : function(){
        Mercadopago.createToken($('#formMPPayment'),MP.responseTokenMP);
    },

    responseTokenMP : function (status,response){
        console.log(response);
        if (status != 200 && status != 201) {
            //verificacion fallida
        }else{
            var post_payment = {
                token : response.id,
                payment_method_id : $('#paymentMethodId').val()
            };
            $.ajax({
                url: '/extras/payments/mercado_pago/procesar-web-api.php',
                type: 'POST',
                data : post_payment,
                dataType:'json',
                success:function(response){
                    alert('termino el proceso bien');
                    console.log(response);
                },
                error: function (xhr) {
                    alert('algo salio mal');
                    console.log(xhr);
                }
            });
        }
    }

};