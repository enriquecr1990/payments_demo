<?php

class ComunHelper
{

    public static function curlopt($url_curl,$options){
        $curl = curl_init($url_curl);
        curl_setopt_array($curl,$options);
        $response = curl_exec($curl);
        $error = curl_error($curl);
        curl_close($curl);
        if($error){
            $return = $error;
        }else{
            $return = $response;
        }
        return $return;
    }

}

$urlPayPalConfiguracion = 'http://comprandoando-local.com/api/metodopago/paypal/configuracion';
$urlPayPalCreateOrder = 'http://comprandoando-local.com/api/metodopago/paypal/createOrder';
$urlPayPalOnApprove = 'http://comprandoando-local.com/api/metodopago/paypal/onApprove';

/**
 * apartado para consumir el servicio del backend de paypal del proyecto softura
 */
$options = array(
    CURLOPT_POST => true,
    CURLOPT_SSL_VERIFYPEER => false,
    CURLOPT_HEADER => false,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_HTTPHEADER => array(
        'Content-type: application/json',
    ),
    CURLOPT_POSTFIELDS => array()
);

$params = ComunHelper::curlopt($urlPayPalConfiguracion,$options);
$params = json_decode($params);
$activePaypal = true;
if(isset($params->code) && $params->code != 200){
    $activePaypal = false;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <link rel="icon" sizes="32x32" href="https://www.paypalobjects.com/webstatic/developer/favicons/pp32.png">

    <title>Probando pago PayPal</title>
</head>
<body>


<div class="container">
    <div class="row mt-1">
        <div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
            <?php if($activePaypal): ?>
                <div id="conteiner-btn-paypal"></div>
            <?php else: ?>
                <div class="alert alert-danger">No se cargaron los parametros de PayPal</div>
            <?php endif; ?>
        </div>
    </div>
    <div class="row mt-1">
        <div class="form-group col-lg-12 col-md-12 col-sm-12" id="response_paypal">

        </div>
    </div>
</div>

<!--<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>-->
<script src="js/jquery-3.4.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>
<!-- scritps para el pago -->
<?php if($activePaypal): ?>
    <script src="https://www.paypal.com/sdk/js?client-id=<?=$params->data->public_key?>&currency=<?=$params->data->currency?>"></script>
    <!-- script para el paypal
    funciones de iniciar el paypal para los botones
    url para el createOrder
    url para el onApproved
     -->
    <script type="text/javascript">
        $(document).ready(function(){

            PayPal.iniciarPaypal();

        });

        var PayPal = {

            iniciarPaypal : function(){
                paypal.Buttons({
                    env: '<?=$params->data->tipo?>',  // sanbox | production
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
                        //ejemplo de datos de enviar al createOrder paypal
                        postData = new FormData();
                        postData.append('order','1000010000');
                        postData.append('type','type_order');
                        postData.append('_token','1928ucr192m3ur192mp1928cump3mdpjdp82cm19jcpm8');
                        return fetch('<?=$urlPayPalCreateOrder?>', {
                            method: 'POST',
                            body : postData
                        }).then(function(res) {
                            return res.json();
                        }).then(function(response) {
                            console.log(response.order);
                            return response.data.id;
                        });
                    },

                    // Finalize the transaction
                    onApprove: function(data) {
                        $('#response_paypal').html('<div class="alert alert-info">Procesando el pago</div>');
                        console.log(data);
                        postdataApprove = new FormData();
                        //el order ID y el payer ID se debe enviar para procesar el pago
                        postdataApprove.append('payerID',data.payerID);
                        postdataApprove.append('orderID',data.orderID);
                        //datos extra ah enviar para aprovar el pago
                        postdataApprove.append('type','type_order');
                        postdataApprove.append('_token','fdasip9fas9pdf8aps8f9apsf9nafp7a9fe0fa98a90efp');
                        return fetch('<?=$urlPayPalOnApprove?>', {
                            method: 'post',
                            body: postdataApprove
                        }).then(function(res) {
                            return res.json();
                        }).then(function(res) {
                            console.log(res);
                            $('#response_paypal').html('<div class="alert alert-success">ID PAYMENT:'+res.data.idPayment+' ESTATUS: '+res.data.status+' MESSAGE: '+res.message+'</div>');
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

        };
    </script>
<?php endif; ?>

</body>
</html>