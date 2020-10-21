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

$acquirerId = '119';
$idCommerce = '10498';
$purchaseOperationNumber = substr(time(),-6);
$purchaseAmount = '78';
$purchaseCurrencyCode = '4596';
$clavePasarela = 'sbjEcqZaXJeXRxj$38249245';

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

    <title>Método Pay-Me Ecuador</title>
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
    </div>
    <!--<textarea class="form-control col-lg-12"><script type="text/javascript" src="https://integracion.alignetsac.com/VPOS2/js/modalcomercio.js" ></script></textarea>-->
    <div class="row">
        <div class="form-group col-lg-12">
            <form name="f1" id="f1" action="#" method="post" class="alignet-form-vpos2">

                <div class="row">
                    <label class="col-lg-3">acquirerId</label><input type="text" class="col-lg-9" name="acquirerId" value="<?=$acquirerId?>">
                    <label class="col-lg-3">idCommerce</label><input type="text" class="col-lg-9" name="idCommerce" value="<?=$idCommerce?>">
                    <label class="col-lg-3">purchaseOperationNumber</label><input type="text" class="col-lg-9" name="purchaseOperationNumber" value="<?=$purchaseOperationNumber?>">
                    <label class="col-lg-3">purchaseAmount</label><input type="text" class="col-lg-9" name="purchaseAmount" value="<?=$purchaseAmount?>">
                    <label class="col-lg-3">purchaseCurrencyCode</label><input type="text" class="col-lg-9" name="purchaseCurrencyCode" value="<?=$purchaseCurrencyCode?>">
                    <label class="col-lg-3">language</label><input type="text" class="col-lg-9" name="language" value="SP">

                    <label class="col-lg-3">shippingFirstName</label><input type="text" class="col-lg-9" name="shippingFirstName" value="Enrique">
                    <label class="col-lg-3">shippingLastName</label><input type="text" class="col-lg-9" name="shippingLastName" value="Corona">
                    <label class="col-lg-3">shippingEmail</label><input type="text" class="col-lg-9" name="shippingEmail" value="enriquecr1990@gmail.com">
                    <label class="col-lg-3">shippingAddress</label><input type="text" class="col-lg-9" name="shippingAddress" value="Una calle de peru">
                    <label class="col-lg-3">shippingZIP</label><input type="text" class="col-lg-9" name="shippingZIP" value="100401">
                    <label class="col-lg-3">shippingCity</label><input type="text" class="col-lg-9" name="shippingCity" value="QUITO">
                    <label class="col-lg-3">shippingState</label><input type="text" class="col-lg-9" name="shippingState" value="PICHINCH">
                    <label class="col-lg-3">shippingCountry</label><input type="text" class="col-lg-9" name="shippingCountry" value="EC">

                    <label class="col-lg-3">userCommerce</label><input type="text" class="col-lg-9" name="userCommerce" value="">
                    <label class="col-lg-3">userCodePayme</label><input type="text" class="col-lg-9" name="userCodePayme" value="">

                    <label class="col-lg-3">descriptionProducts</label><input type="text" class="col-lg-9" name="descriptionProducts" value="Probando pagar con payme PARA ecuador">
                    <label class="col-lg-3">programmingLanguage</label><input type="text" class="col-lg-9" name="programmingLanguage" value="PHP">
                    <label class="col-lg-3">purchaseVerification</label><input type="text" class="col-lg-9" name="purchaseVerification" value="<?=$purchaseVerification?>">

                    <label class="col-lg-3">reserved1</label><input type="text" class="col-lg-9" name="purchaseVerification" value="SP">
                    <label class="col-lg-3">reserved2</label><input type="text" class="col-lg-9" name="purchaseVerification" value="4596">
                    <label class="col-lg-3">reserved3</label><input type="text" class="col-lg-9" name="purchaseVerification" value="492">
                    <label class="col-lg-3">reserved4</label><input type="text" class="col-lg-9" name="purchaseVerification" value="000">
                    <label class="col-lg-3">reserved5</label><input type="text" class="col-lg-9" name="purchaseVerification" value="000">
                    <label class="col-lg-3">reserved9</label><input type="text" class="col-lg-9" name="purchaseVerification" value="000">
                    <label class="col-lg-3">reserved10</label><input type="text" class="col-lg-9" name="purchaseVerification" value="4104">
                    <label class="col-lg-3">taxMontoFijo</label><input type="text" class="col-lg-9" name="purchaseVerification" value="4596">
                    <label class="col-lg-3">taxMontoGravaIva</label><input type="text" class="col-lg-9" name="purchaseVerification" value="4104">
                    <label class="col-lg-3">taxMontoIVA</label><input type="text" class="col-lg-9" name="purchaseVerification" value="492">
                    <label class="col-lg-3">taxMontoNoGravaIva</label><input type="text" class="col-lg-9" name="purchaseVerification" value="000">
                    <label class="col-lg-3">taxServicio</label><input type="text" class="col-lg-9" name="purchaseVerification" value="000">
                    <label class="col-lg-3">taxICE</label><input type="text" class="col-lg-9" name="purchaseVerification" value="0">
                </div>
                <div class="row">
                    <div class="form-group col-lg-12">
                        <input type="button" onclick="javascript:AlignetVPOS2.openModal('https://integracion.alignetsac.com/')" class="btn btn-success" value="comprar">
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>

<div id="divLenguaje"></div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>


</body>
</html>