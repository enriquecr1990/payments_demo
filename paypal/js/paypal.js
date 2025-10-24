$(document).ready(function(){

    PayPal.iniciarPaypal();

});

var PayPal = {

    iniciarPaypal : function(){
        paypal.Buttons({
            env: 'sanbox',  // sanbox | production
            // Set style of buttons
            style: {
                layout: 'vertical',   // horizontal | vertical
                size:   'responsive',   // medium | large | responsive
                shape:  'pill',         // pill | rect
                color:  'gold',         // gold | blue | silver | black,
                fundingicons: true,    // true | false,
                tagline: false,          // true | false,
                //height: 40
            },
            commit: true,
            // Set up the transaction
            createOrder: function() {
                postData = new FormData();
                postData.append('order','1000010000');
                postData.append('type','type_order');
                postData.append('_token','1928ucr192m3ur192mp1928cump3mdpjdp82cm19jcpm8');
                return fetch(base_url + 'private/createOrder.php', {
                    method: 'POST',
                    body : postData
                }).then(function(res) {
                    return res.json();
                }).then(function(data) {
                    console.log(data.order);
                    return data.order.id;
                });
            },

            // Finalize the transaction
            onApprove: function(data, actions) {
                return fetch(base_url + 'private/captureOrder.php?order_id='+data.orderID, {
                    method: 'post',
                }).then(function(res) {
                    return res.json();
                }).then(function(res) {
                    console.log(res);
                    //window.location.href = 'payment_success';
                    $('#response_paypal').html('<div class="alert alert-success">Pago exitoso</div>');
                });
            },
            onCancel: function(data,actions){
                console.log('*************** cancel: ',data);
                $('#response_paypal').html('<div class="alert alert-warning">Pago cancelado</div>');
            },
            onError: function(data,actions){
                console.log('*************** ERROR: ',data);
                $('#response_paypal').html('<div class="alert alert-danger">Pago con error</div>');
            }
        }).render('#conteiner-btn-paypal');
    },

    iniciarPaypalBackend : function (){
        $.ajax({
            method: 'post',
            url : 'http://comprandoando-local.com/api/metodopago/paypal/configuracion',
            dataType : 'json',
            data : {
                tipo: 'sanbox'
            },
            success : function (response) {
                if(response.code == 200){
                    Paypal.iniciarPaypal('#paypal_buttons',$.parseJSON(response.data));
                }else{
                    alert('hubo un error');
                }
            },
            error :function(){
                alert('hubo un error uuuu dile al programador');
            }
        });
    },

};