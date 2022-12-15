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
            Metdo de pago "mercado pago"
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <button id="btn_pagar_mp" type="button" class="btn btn-info">Pagar</button>
        </div>
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

        $(document).on('click','#btn_pagar_mp',function(){
            MercadoPagoJS.crearOrden();
        });

    });

    var MercadoPagoJS = {

        crearOrden : function(){
            $.ajax({
                type : 'post',
                url : base_url + 'private/createOrder.php',
                data : {},
                dataType : 'json',
                success : function(response){
                    console.log(response);
                    if(response.status){
                        //alert('se obtuvo la orden de pago');
                        var link_pago = response.init_point != undefined && response.init_point != '' ? response.init_point : url_payment_mp + '?pref_id='+response.id;
                        //setTimeout(function(){
                            window.location = link_pago;
                        //},2000);
                    }else{
                        alert('no se pudo generar la orden de pago');
                    }
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