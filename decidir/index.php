<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <link rel="stylesheet" href="js/plugins/json-viewer/jquery.json-viewer.css">
    <title>Método Decidir</title>
    <!-- scritps para el pago -->

</head>
<body>

<div class="container">

    <div class="row col-xlg-12">
        <div class="form-group">
            <div class="alert alert-info">
                Metodo de pago DECIDIR
            </div>
        </div>
    </div>

    <div class="form-row" >
        <div class="form-group col-xlg-6 col-lg-6 col-md-12 col-sm-12 col-xs-12" id="section_form_decidir">
            <form id="form_pago_decidir">

                <input id="csdfid" type="hidden" name="csdevicefingerprintid" value="">

                <div class="form-row" id="alert_msg" style="display: none;">
                    <div class="form-group col-xlg-12 col-lg-12">
                        <div class="alert alert-info" id="msg_operacion"></div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-xlg-4 col-lg-4">
                        <label>Tipo de tarjeta</label>
                    </div>
                    <div class="form-group col-xlg-4 col-lg-4">
                        <div class="custom-control custom-radio">
                            <input type="radio" id="tipo_tarjeta_d" name="tipo_tarjeta" data-rule-required="true" class="custom-control-input tipo_tarjeta" value="debito">
                            <label class="custom-control-label"  for="tipo_tarjeta_d">Débito</label>
                        </div>
                    </div>
                    <div class="form-group col-xlg-4 col-lg-4">
                        <div class="custom-control custom-radio">
                            <input type="radio" id="tipo_tarjeta_c" name="tipo_tarjeta" class="custom-control-input tipo_tarjeta" value="credito">
                            <label class="custom-control-label" for="tipo_tarjeta_c">Crédito</label>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-xlg-12 col-lg-12">
                        <label for="select_opciones_tarjeta">Opcion de tarjeta</label>
                        <select class="form-control" data-rule-required="true" id="select_opciones_tarjeta" name="opcion_tarjeta_slt">
                            <option value="">-- Seleccione --</option>
                        </select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-xlg-8 col-lg-8">
                        <label for="card_number">Número de tarjeta</label>
                        <input id="card_number" data-rule-required="true"
                               data-rule-number="true" data-rule-minlength="15" data-rule-maxlength="18"
                               name="card_number" class="form-control" placeholder="9999-9999-9999-9999" >
                    </div>
                    <div class="form-group col-xlg-4 col-lg-4">
                        <label for="security_code">CVV</label>
                        <input id="security_code" name="security_code" type="password" data-rule-required="true"
                               data-rule-minlength="3" data-rule-maxlength="4"
                               placeholder="CVV" class="form-control">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-xlg-4 col-lg-4">
                        <label for="fecha_anio">Expiración (Mes y Año)</label>
                    </div>
                    <div class="form-group col-xlg-4 col-lg-4">
                        <label for="titular">Titular de la tarjeta</label>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-xlg-2 col-lg-2">
                        <input id="card_expiration_month" name="card_expiration_month" data-rule-required="true"
                               data-rule-min="1" data-rule-max="12"
                               class="form-control" placeholder="MM">
                    </div>
                    <div class="form-group col-xlg-2 col-lg-2">
                        <input id="card_expiration_year" name="card_expiration_year" data-rule-required="true"
                               class="form-control" placeholder="YY">
                    </div>
                    <div class="form-group col-xlg-8 col-lg-8">
                        <input id="card_holder_name" name="card_holder_name" data-rule-required="true" class="form-control" placeholder="Titular de la tarjeta">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-xlg-12 col-lg-12">
                        <label for="card_holder_doc_type">Tipo de documento</label>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-xlg-6 col-lg-6">
                        <select id="card_holder_doc_type" class="form-control" name="card_holder_doc_type">
                            <option value="">-- Seleccione --</option>
                            <option value="dni">DNI</option>
                            <option value="cuil">CUIL</option>
                        </select>
                    </div>
                    <div class="form-group col-xlg-6 col-lg-6">
                        <input id="card_holder_doc_number" name="card_holder_doc_number" class="form-control" placeholder="Valor del documento">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-xlg-12 col-lg-12 text-center">
                        <button type="button" id="btn_pagar" class="btn btn-sm btn-outline-success">Pagar</button>
                    </div>
                </div>

            </form>
        </div>
    </div>

    <div class="form-row">
        <div class="form-group col-xlg-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="form-row">
                <div class="form-group col-lg-6 col-xlg-6">
                    <div id="resultado_token">
                        <pre id="json_envio_token"></pre>
                        <pre id="json_resultado_token"></pre>
                    </div>
                </div>
                <div class="form-group col-lg-6 col-xlg-6">
                    <div id="resultado_pago">
                        <pre id="json_envio_pago"></pre>
                        <pre id="json_resultado_pago"></pre>
                    </div>
                </div>
            </div>
        </div>
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

<script src="js/decidir.js"></script>

</body>
</html>