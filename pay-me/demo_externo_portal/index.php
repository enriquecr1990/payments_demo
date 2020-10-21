<!-- *********************** CONSIDERACIONES Y NOTAS **********************************
    1.- validar el campo idCommerce, el que se proporciona la entidad es de longitud 5
        y en la documentacion es un maximo permitido de 4
        podria ser usado el id wallet que si cumple con la caracteristica
    2.- Para el campo de shippingCountry se toma de en formato ISO del pais de entrega
        a) https://www.upct.es/relaciones_internacionales/prog/docs/Erasmus-14-15/iniciales_paises_iso.pdf
            604 Perú PE PER
        b) https://es.wikipedia.org/wiki/ISO_3166-1
            604 Perú PE PER
    3.- Para el campo purchaseVerification se debe enviar el valor cifrado
        El ejemplo se obtuvo de la integracion de wallet
            cabe mencionar que el id commerce que se envia es el de wallet,
            el otro campo no lo reconoce y sale como comeercio no encontrado
    $registerVerification = openssl_digest($idEntCommerce.$codCardHolderCommerce.$mail.$clvWallet,'sha512');
    ***********************************************************************************
-->
<?php

$acquirerId = '144';
$idCommerce = '10432';
$purchaseOperationNumber = substr(time(),-6);
$purchaseAmount = '78-';
$purchaseCurrencyCode = '604';
$clavePasarela = 'vjcZJfRBeFNsUbxCqk?42344289672';

$purchaseVerification = openssl_digest($acquirerId.$idCommerce.$purchaseOperationNumber.$purchaseAmount.$purchaseCurrencyCode.$clavePasarela,'sha512');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>Método Pay-Me</title>
    <!-- scritps para el pago -->
    <script type="text/javascript" src="https://integracion.alignetsac.com/VPOS2/js/modalcomercio.js" ></script>

</head>
<body>

<div class="container">
    <div class="row">
        <div class="form-group col-lg-12">
            <div class="alert alert-info">
                Metodo de pago Pay-Me
            </div>
        </div>

        <div class="form-group col-lg-12">
            <button type="button" id="get_data_form_payme"
                    class="btn btn-outline-primary">Pagar payme</button>
        </div>
    </div>

</div>

<div id="divLenguaje"></div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>
<script src="js/payme.js"></script>


</body>
</html>