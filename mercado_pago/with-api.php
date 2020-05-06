<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Mercado pago</title>
    <meta charset="utf-8">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <link rel="shortcut icon" href="https://http2.mlstatic.com/ui/navigation/2.0.3/mercadopago/favicon.ico"/>

</head>
<body>

<div class="container-fluid">

    <div class="col-lg-12">
        <div class="alert alert-info">
            Metodo de pago "mercado pago"
        </div>
    </div>

    <div class="row">
        <div class="col-lg-4"></div>
        <div class="col-lg-4">
            <form action="" method="post" id="formMPPayment" name="pay">

                <div class="form-group row">
                    <div class="col-lg-12">
                        <label for="cardNumber">Numero de tarjeta:</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="cardNumber" data-checkout="cardNumber"
                                   placeholder="4509 9535 6623 3704"
                                   onselectstart="return false" onpaste="return false" onCopy="return false"
                                   onCut="return false" onDrag="return false" onDrop="return false" autocomplete=off/>
                            <div class="input-group-append" style="display: none">
                                <span class="input-group-text" id="typeCard"></span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-lg-4">
                        <label for="securityCode">CVV:</label>
                        <input type="text" class="form-control" id="securityCode" data-checkout="securityCode"
                               placeholder="123"
                               onselectstart="return false" onpaste="return false" onCopy="return false"
                               onCut="return false" onDrag="return false" onDrop="return false" autocomplete=off/>
                    </div>
                    <div class="col-lg-4">
                        <label for="cardExpirationMonth">Mes:</label>
                        <input type="text" class="form-control" id="cardExpirationMonth" data-checkout="cardExpirationMonth"
                               placeholder="12"
                               onselectstart="return false" onpaste="return false" onCopy="return false"
                               onCut="return false"
                               onDrag="return false" onDrop="return false" autocomplete=off/>
                    </div>
                    <div class="col-lg-4">
                        <label for="cardExpirationYear">Año:</label>
                        <input type="text" class="form-control" id="cardExpirationYear" data-checkout="cardExpirationYear"
                               placeholder="2015"
                               onselectstart="return false" onpaste="return false" onCopy="return false"
                               onCut="return false"
                               onDrag="return false" onDrop="return false" autocomplete=off/>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-lg-12">
                        <label for="cardholderName">Nombre de como aparece en la tarjeta:</label>
                        <input type="text" class="form-control" id="cardholderName" data-checkout="cardholderName"
                               placeholder="APRO"/>
                    </div>
                </div>

                <input type="hidden" id="paymentMethodId" name="paymentMethodId"/>
                <button id="btnPaymentMPSubmit" type="button" class="btn btn-outline-info btn-sm">Realizar pago</button>
            </form>
        </div>
        <div class="col-lg-4"></div>
    </div>

</div>

<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>

<!-- scripts de MP -->
<script src="https://secure.mlstatic.com/sdk/javascript/v1/mercadopago.js"></script>
<script src="js/indexmp.js"></script>

</body>
</html>