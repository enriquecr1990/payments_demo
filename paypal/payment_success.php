<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <link rel="icon" sizes="32x32" href="https://www.paypalobjects.com/webstatic/developer/favicons/pp32.png">

    <link rel="stylesheet" href="js/plugins/json-viewer/jquery.json-viewer.css">
    <title>Pago correcto - paypal vault</title>
</head>
<body>

<br>

<div class="container text-center">
    <div class="row">
        <div class="col">
            <div class="alert alert-success">
                Pago exitoso
            </div>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-12 text-left">
            <input type="hidden" id="approval_token_id" value="<?=$_GET['approval_token_id']?>">
            <button id="btn_validar_pago" class="btn btn-success">Validar</button>
            <a href="/paypal/vaulting.php" class="btn btn-dark">Otro pago</a>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-12 text-left">
            <pre id="json_resultado_pago"></pre>
        </div>
    </div>
</div>

<!-- <div class="container-fluid">
    <div class="row mt-1">
        <div class="alert alert-success">
            Pago exitoso
        </div>
    </div>
    <div class="row">
        <input type="hidden" id="approval_token_id" value="<?=$_GET['approval_token_id']?>">
        <div class="form-group col-1"><button id="btn_validar_pago" class="btn btn-success">Validar</button></div>
        <div class="form-group col-11">
            <textarea id="txt_response_vault" cols="12"></textarea>
        </div>
    </div>
</div> -->

<script src="js/jquery-3.4.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>
<script src="js/plugins/json-viewer/jquery.json-viewer.js"></script>
<!-- scritps para el pago -->
 <script src="js/paypal_vs.js"></script>

</body>
</html>