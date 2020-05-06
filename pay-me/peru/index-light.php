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
    <script id="PaymeFormScriptStarter" src="https://integracion.alignetsac.com/VPOS2/js/PF/PF.js" ></script>

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

    <button class="btn btn-info" id="btn-payme">Payme</button>

    <div class="row">
        <div id="alg-paymeform-container" class="form-group col-lg-12">
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>

<?php
$acquirerId = 144;
$idCommerce = 10432;
$purchaseOperationNumber = '000001';
$purchaseAmount = 105.38;
$purchaseCurrencyCode = 604;
$codeMoneyCountry = 'PE';
$claveWallet = 'GqmQzeJtNWAtHmpHnEh*373935773723';
$clavePasarela = 'gHVKCnhWQTMKDqdNzx?79493534422';
$signature = hash('sha512',$purchaseOperationNumber.$purchaseAmount.$codeMoneyCountry.$clavePasarela);
?>

<script>

    $(document).ready(function(){
        $(document).on('click','#btn-payme',function(){
            Payme.startFormulario();
        });
    });

    var Payme = {

        startFormulario : function (){
            var params = Payme.paramsForm();
            PF.Init.execute(params);
        },

        paramsForm : function(){
            var params = {
                data : {
                    operation : {
                        operationNumber : '<?=$purchaseOperationNumber?>',
                        amount : <?=$purchaseAmount?>,
                        currency : {
                            code : 'PEN',
                                symbol : 'S/.'
                        },
                        productDescription : 'Test payment with Pay-Me'
                    },
                    customer : {
                        name : 'Enrique',
                            lastname : 'Corona Prueba',
                            email : 'enriquecr1990@gmail.com',
                            address : 'Una calle de Perú',
                            zip : '07016',
                            city : 'Lima',
                            state : 'Lima',
                            country : 'Peru',
                            phone : '2467575099'
                    },
                    //se usa el hash por sha-512
                    signature : '<?=$signature?>',
                },
                listeners : {
                    afterPay : function(response){
                        console.log('aqui toy todo bien');
                        console.log(response);
                    }
                },
                settings : {
                    identifier : '<?=$idCommerce?>',
                        key : '<?=$clavePasarela?>',
                        locale : 'es_PE',
                        brands : ['VISA','MSCD','AMEX','DINC'],
                        responseType : 'extended'
                }
            };
            return params;
        }

    };

</script>

</body>
</html>