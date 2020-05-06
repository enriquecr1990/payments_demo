<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>Método Payme - Safari</title>
    <!-- scritps para el pago -->

</head>
<body>

<div class="container">
    <div class="row">
        <div class="form-group col-xlg-12 col-lg-12">
            <div class="alert alert-info">
                Metodo de pago Decidir Safari
            </div>
        </div>

        <!--<iframe id="frame_to_cokies" src="https://vpayment.verifika.com/VPOS2/faces/pages/safariEntry.xhtml" style="width: 100px; height: 150px;"></iframe>-->

        <button type="button" onclick="window.open('https://vpayment.verifika.com/VPOS2/faces/pages/safariEntry.xhtml','height=100px,width=100px,top=9999px,left=9999px','_blank');window.close()">win cokies</button>

        <form id="form_data_payme"></form>

    </div>
</div>

<script src="js/plugins/jquery-3.4.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>

<script type="text/javascript" src="https://integracion.alignetsac.com/VPOS2/js/modalcomercio.js"></script>
<script type="text/javascript" src="js/payme_js.js"></script>

</body>
</html>