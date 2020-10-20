<?php
include __DIR__.'\private\helper\ComunHelper.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>Método Rapipago</title>
    <!-- scritps para el pago -->

</head>
<body>

<div class="container">
    <div class="row">
        <div class="form-group col-lg-12">
            <div class="alert alert-info">
                Metodo de pago Rapipago
            </div>
        </div>
    </div>

    <div class="form-row" >
        <div class="form-group col-xlg-6 col-lg-6 col-md-12 col-sm-12 col-xs-12" id="section_form_rapipago">
            <button id="btn_procesar_form_rapipago" type="button" class="btn btn-success">Procesar formulario</button>
        </div>
    </div>

    <div class="form-row">
        <div class="form-group col-xlg-12 col-lg-12">
            <input type="hidden" id="GS_USERNAME" value="">
            <input type="hidden" id="GS_PASSWORD" value="">
            <input type="hidden" id="GS_EMAIL" value="">
            <input type="hidden" id="GS_CLIENT_ID" value="">
            <input type="hidden" id="GS_TX_ID" value="">
            <input type="hidden" id="GS_MONTO_BASE" value="">
            <input type="hidden" id="GS_MONTO_ADICIONAL" value="">
            <input type="hidden" id="GS_IMPUESTOS" value="">
            <input type="hidden" id="GS_IMPORTE" value="">
            <input type="hidden" id="GS_MERCHANT_ID" value="">
            <input type="hidden" id="GS_REF_01" value="">
            <input type="hidden" id="GS_REF_02" value="">
            <input type="hidden" id="GS_REF_03" value="">
            <input type="hidden" id="GS_MONEDA" value="ARS ">
            <input type="hidden" id="GS_CUOTAS" value="">
            <input type="hidden" id="GS_RECARGO" value="">
            <input type="hidden" id="GS_AMBIENTE" value="">
            <input type="hidden" id="GS_URL_HOME" value="">
            <input type="hidden" id="GS_URL_CONFIRM" value="">
            <input type="hidden" id="GS_PRODUCTO" value="">
            <input type="hidden" id="GS_DIAS_VENCIMIENTO" value="1">
            <input type="hidden" id="GS_TIPO_OPERACION" value="1">
            <input type="hidden" id="GS_SHASIGN" value="">
            <button type="submit" id="GS_BOTON_PAGO">Iniciar Operación</button>
        </div>
    </div>
</div>


<script src="js/plugins/jquery-3.4.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>

<script src="js/plugins/js_validate/jquery.validate.min.js"></script>
<script src="js/plugins/js_validate/localization/messages_es.min.js"></script>

<script src="js/botonWeb.js"></script>
<script src="js/rapipago.js"></script>

<script type="text/javascript">
    var base_url = '<?=ComunHelper::base_url();?>';
</script>

</body>
</html>