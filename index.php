<?php include_once ('extras/private/ComunHelper.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

    <meta name="author" content="Enrique Corona Ricaño">
    <meta name="description" content="Demos de métodos de pago Online para varios paises de América latina">
    <meta name="keywords" content="Métodos de pago Online México, Demos metodos de pago, Metodo de pago PayPal, Metodo de pago MercadoPago, Metodo de pago VisaCheckout">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <link rel="icon" sizes="32x32" href="<?=ComunHelper::base_url()?>extras/imagenes/icons/banking_financial.png">

    <title>Desarrollo de metodos de pago Online DEMOS</title>
</head>
<body>

<div class="container">
    <div class="row">
        <div class="form-group col-lg-12 col-md-12">
            <div class="alert alert-secondary">Metodos de pago para México</div>
        </div>
    </div>

    <div class="row">
        <div class="form-group col-lg-3 col-md-6 col-sm-12">
            <div class="card" style="width: 18rem;">
                <img src="<?=ComunHelper::base_url()?>extras/imagenes/logos/paypal01.jfif" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">PayPal</h5>
                    <p class="card-text">Método de pago PayPal aceptados en muchos paises del mundo</p>
                    <a href="<?=ComunHelper::base_url()?>/paypal" class="btn btn-outline-primary" target="_blank">Ver Demo</a>
                </div>
            </div>
        </div>
    </div>

</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>

</body>
</html>