<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>PayPhone</title>
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
            Metodo de pago "Payphone"
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <button id="btn_pagar_pp" type="button" class="btn btn-info">Crear orden</button>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12" id="div_link_pago">

        </div>
    </div>

    <div class="row">
        <div class="col-lg-12" id="contenedor_div_validar_pago">

        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <pre id="respuesta_pago_mp"></pre>
        </div>
    </div>

</div>

<div id="contenedor_modal_frame">
    <div class="modal" id="modal_frame_mp" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <iframe id="iframe_mp" style="width: 100%; min-height: 500px; max-height: 900px"></iframe>
                </div>
            </div>
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

    var base_url = 'http://localhost/personales/metodos_pago/payphone/';

    $(document).ready(function(){

        $(document).on('click','#btn_pagar_pp',function(){
            $(this).attr('disabled',true).append('<div class="spinner-grow text-dark  spinner-grow-sm" role="status"></div>');
            PayPhoneJS.prepareButton();
        });

    });

    var PayPhoneJS = {

        prepareButton : function(){
            $.ajax({
                type : 'post',
                url : base_url + 'private/createOrder.php',
                data : {
                    //data_comercio : {},
                    //data_carrito: {},
                    //data_comprador : {},
                },
                dataType : 'json',
                success : function(response){
                    console.log(response);
                    if(response.status){
                        window.location = response.data.payWithCard;
                    }else{
                        alert('no se pudo generar la orden de pago');
                    }
                    $('#btn_pagar_pp').removeAttr('disabled');
                    $('.spinner-grow').remove();
                },error : function(error){
                    console.log(error);
                    alert('lo siento, ocurrio un error');
                    $('#btn_pagar_pp').removeAttr('disabled');
                    $('.spinner-grow').remove();
                }
            });
        },

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
                    $('#respuesta_pago_mp').html(response);
                },error : function(error){
                    console.log(error);
                    alert('lo siento, ocurrio un error');
                }
            });
        },

        cerrar_modal_mp : function(payment_id){
            $('#modal_frame_mp').modal('hide');
            var btn_validar_pago = '<button type="button" class="btn btn-sm btn-warning" onclick="MercadoPagoJS.validarPago('+payment_id+')">Validar pago MP</button>'
            $('#contenedor_div_validar_pago').html(btn_validar_pago);
        }

    }

</script>

</body>
</html>