<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <link rel="stylesheet" href="js/plugins/json-viewer/jquery.json-viewer.css">
    <title>Método cybersource Visa Payme</title>
    <!-- scritps para el pago -->

</head>
<body>

<div class="container">

    <div class="row col-xlg-12">
        <div class="form-group">
            <div class="alert alert-info">
                Metodo de pago CS visa Payme
            </div>
        </div>
    </div>

    <button type="button" id="btn_lanzar_form_cs" class="btn btn-info">Formulario CS</button>

    <div class="form-row" >
        <div class="form-group col-xlg-6 col-lg-6 col-md-12 col-sm-12 col-xs-12" id="section_form_cs_payme">

        </div>
        <div id="extra_js_dfp" style="display: none"></div>
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

<script src="js/plugins/json-viewer/jquery.json-viewer.js"></script>

<script src="js/cs.js"></script>

</body>
</html>