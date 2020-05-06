<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>Método DataFast</title>
    <!-- scritps para el pago -->

</head>
<body>

<div class="container">
    <div class="row">
        <div class="form-group col-lg-12">
            <div class="alert alert-info">
                Metodo de pago DataFast
            </div>
        </div>
    </div>
    <div class="row">
        <div class="form-group col-lg-12">
            <!--<form action="http://payments-local.com/datafast/respuesta.php" class="paymentWidgets" data-brands="VISA MASTER AMEX"></form>-->
            <button id="btn_pagar_datafast" type="button" class="btn btn-danger">Pagar</button>
            <div id="form_to_datafast"></div>
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
<script src="js/df_index.js"></script>

<div id="scripts_datafast"></div>

</body>
</html>