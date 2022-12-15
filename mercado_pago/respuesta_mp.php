<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Mercado pago</title>
    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <link rel="shortcut icon" href="https://http2.mlstatic.com/ui/navigation/2.0.3/mercadopago/favicon.ico"/>

</head>
<body>

<div class="container-fluid">

    <div class="col-lg-12">
        <div class="alert alert-info">
            Metodo de pago "mercado pago" RESPUESTA DE PAGO
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <?php

                echo '<h5>respuesta de mercado pago GET</h5>';
                echo '<pre>';echo print_r($_GET);echo '</pre>';
                echo '<h5>respuesta de mercado pago POST</h5>';
                echo '<pre>';echo print_r($_POST);echo '</pre>';
            ?>
        </div>
    </div>

    <div class="col-lg-12">
        <div class="alert alert-info">
            en bitoo debera mandar la respuesta en el front tomando en cuenta solamente de la respuesta el payment_id y consumirla en otro servicio para consultar el estatus del pago
        </div>
    </div>

    <div class="col-lg-12">
        <button type="button" class="btn btn-sm btn-warning" onclick="MercadoPagoJS.validarPago(<?=$_GET['payment_id']?>)">Validar pago MP</button>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <pre id="respuesta_pago_mp"></pre>
        </div>
    </div>

    <div class="col-lg-12">
        <a href="http://localhost/personales/metodos_pago/mercado_pago/web-checokut.php" class="btn btn-danger btn-sm">Intentar de nuevo</a>
    </div>

</div>

<!--<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>-->
<script src="js/jquery-3.4.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>

<script>

    var base_url = 'http://localhost/personales/metodos_pago/mercado_pago/';
    var url_payment_mp = 'https://www.mercadopago.com.mx/checkout/v1/redirect';

    $(document).ready(function(){



    });

    var MercadoPagoJS = {

        validarPago : function(payment_id){
            $.ajax({
                type : 'post',
                url : base_url + 'private/validateOrder.php',
                data : {
                    payment_id : payment_id
                },
                dataType : 'json',
                success : function(response){
                    console.log(response);
                    $('#respuesta_pago_mp').html(respuesta);
                },error : function(error){
                    console.log(error);
                    alert('lo siento, ocurrio un error');
                }
            });
        }

    }

</script>

</body>
</html>