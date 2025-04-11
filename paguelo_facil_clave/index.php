<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>PagueloFacil</title>
    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <link rel="shortcut icon" href="https://http2.mlstatic.com/ui/navigation/2.0.3/mercadopago/favicon.ico"/>
    
    <script src="https://sandbox.paguelofacil.com/HostedFields/vendor/scripts/PFScriptClave.js"></script>
    <!-- <script src="https://secure.paguelofacil.com/HostedFields/vendor/scripts/PFScriptClave.js"></script> -->

</head>
<body>

<div class="container-fluid">

    <div class="col-lg-12">
        <div class="alert alert-info">
            Metodo de pago "Paguelo Facil Enlace boton"
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <button id="btn_pagar_pfc" type="button" class="btn btn-info">Crear orden</button>
        </div>
    </div>
    <div></div>
</div>

<script src="js/jquery-3.4.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>


<script>

    var base_url = 'http://personales-local.com/metodos_pago/paguelo_facil_clave/';

    $(document).ready(function(){
        $(document).on('click','#btn_pagar_pfc',function(){
            $(this).attr('disabled',true).append('<div class="spinner-grow text-dark  spinner-grow-sm" role="status"></div>');
            PFClave.prepareButton();
        });
    });

    var PFClave = {

        prepareButton : function(){
            $.ajax({
                type : 'post',
                url : base_url + 'private/createOrder.php',
                data : {},
                dataType : 'json',
                success : function(response){
                    console.log(response);
                    if(response.status){
                        alert('se genero el boton de pago');
                    }else{
                        alert('no se pudo generar la orden de pago');
                    }
                    $('#btn_pagar_pfc').removeAttr('disabled');
                    $('.spinner-grow').remove();
                },error : function(error){
                    console.log(error);
                    alert('lo siento, ocurrio un error');
                    $('#btn_pagar_pfc').removeAttr('disabled');
                    $('.spinner-grow').remove();
                }
            });
        },

    };
</script>

</body>
</html>