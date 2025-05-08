<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>BCP</title>
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
            Metodo de pago "BCP"
        </div>
        <div class="form-group">
            <button type="button" id="crear_qr" class="btn btn-sm btn-outline-success">Generar QR</button>
        </div>
    </div>

    <div id="contendor_img_qr">

    </div>
</div>

<script src="js/jquery-3.4.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>

<script>

    var base_url = 'http://broker-bcp.local.com/';

    $(document).ready(function(){
        $(document).on('click','#crear_qr',function(){
            BCP.prepareButton();
        });
    });

    var BCP = { 

        prepareButton : function(){
            $.ajax({
                type : 'post',
                url : base_url + 'private/createOrder.php',
                data : {
                    
                },
                dataType : 'json',
                success : function(response){
                    console.log(response);
                    if(response.status){
                        if(response.data.bcp.state == '00'){
                            var html = '<div class="col-lg-12 text-center">'+
                            '<img src="data:image/png;base64, '+response.data.bcp.data.qrImage+'" alt="codigo qr generado BCP">'+
                            '</div>';
                        }else{
                            var html = '<div class="coñ-lg-12"><div class="alert alert-info">No se pudo generar el QR: '+response.data.bcp.message+'</div></div>';
                        }
                        $('#contendor_img_qr').html(html);
                    }else{
                        alert('no se pudo generar el qr de pago');
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

    }

</script>

</body>
</html>