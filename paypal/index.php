<?php include_once ('private/helper/ComunHelper.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <link rel="icon" sizes="32x32" href="https://www.paypalobjects.com/webstatic/developer/favicons/pp32.png">

    <title>Probando pago PayPal</title>
</head>
<body>

<div class="container">
    <div class="row mt-1">
        <div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
            <div id="conteiner-btn-paypal"></div>
        </div>
    </div>
    <div class="row mt-1">
        <div class="form-group col-lg-12 col-md-12 col-sm-12" id="response_paypal">

        </div>
    </div>
</div>

<!--<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>-->
<script src="js/jquery-3.4.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>
<!-- scritps para el pago -->
<script src="https://www.paypal.com/sdk/js?client-id=Af-yarH2_LYxebYrY8w5rbVwklhjjQzI7AjMzpSqwcY4gkWBhWbO8JTNrzVA3HRUfqrjpUzPpUCzKctv&currency=MXN"></script>
<script src="js/paypal.js"></script>
<script>
    var base_url = '<?=ComunHelper::base_url()?>';
</script>

</body>
</html>