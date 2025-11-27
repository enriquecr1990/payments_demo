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

     <title>PayPal - vaulting</title>
</head>
<body>

<div class="container">
     <div class="row mt-1">
          <div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
               <div id="conteiner-list-brokers">
                    <div class="list-group">
                         <li class="list-group-item" aria-current="true">
                              <input type="radio" name="banco"> <img src="https://images.stripeassets.com/fzn2n1nzq965/4vVgZi0ZMoEzOhkcv7EVwK/8cce6fdcf2733b2ec8e99548908847ed/favicon.png?w=96&h=96" alt="" width="20px"> Stripe
                         </li>
                         <li class="list-group-item">
                              <input type="radio" name="banco" checked="checked"> <img src="https://www.paypalobjects.com/webstatic/developer/favicons/pp32.png" alt="" width="20px"> Paypal
                         </li>
                         <li class="list-group-item">
                              <input type="radio" name="banco"> <img src="https://tse2.mm.bing.net/th/id/OIP.1K1ESshpSWIn040P1g0RqwAAAA?rs=1&pid=ImgDetMain&o=7&rm=3" alt="" width="20px"> Mercado pago
                         </li>
                    
                    </div>
               </div>
          </div>
     </div>
     <div class="row mt-1">
          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6 text-right" id="response_paypal">
               <button type="button" id="btn_paypal_vault" class="btn" style="color: white; background-color: blueviolet;">Continuar</button>
          </div>
     </div>

     <div class="row mt-1" id="pago_vault_success" style="display:none">
          <div class="alert alert-info">
               Se genero satisfactoriamente el vaulting
               <span class="badge badge-info" id="url_redirect"></span>
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
<script src="js/paypal_vault.js"></script>
<script>
    var base_url = '<?=ComunHelper::base_url()?>';
</script>

</body>
</html>