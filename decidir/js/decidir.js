$(document).ready(function(){

    $(document).on('click','.tipo_tarjeta',function(){
        Decidir.tipos_tarjeta($(this).val());
    });

    $(document).on('click','#btn_pagar',function(){
        if(Decidir.validar_form_pago()){
            Decidir.procesar_token();
        }
    });

    Decidir.inicializar_form();
    Decidir.iniciar_cybersourcev2();
    Decidir.obtenerIPCliente();
});

var Decidir = {

    html_spinner : function (){
        var html = '' +
            '<div class="spinner-border text-success" role="status">' +
            '<span class="sr-only">Loading...</span>' +
            '</div>';
        return html;
    },

    inicializar_form : function(){
        Decidir.tipos_tarjeta($('input[name="tipo_tarjeta"]:checked').val());
    },

    inicializar_cybersource : function (){
        console.log(new Date());
        var org_id = '1snn5n9w';
        var merchant_id = 'decidir_agregador';
        var deviceFingerprintId = 100000 + Math.floor(Math.random() * 999999);
        var session_id = merchant_id + deviceFingerprintId;

        var urlpng = "https://h.online-metrix.net/fp/clear.png?org_id=" + org_id + "&amp;session_id=" + session_id;
        var urlflash = "https://h.online-metrix.net/fp/fp.swf?org_id=" + org_id + "&amp;session_id=" + session_id;
        var urljs = "https://h.online-metrix.net/fp/tags.js?org_id=" + org_id + "&amp;session_id=" + session_id;

        setTimeout(function(){
            console.log(new Date());
            console.log('se cargo el DF al servicio');
            $('body').prepend(
                '<p style="background:url(' + urlpng + '&amp;m=1)"/><img src="' + urlpng + '&amp;m=2" alt="">'
                + '<object type="application/x-shockwave-flash" data="' + urlflash +'" width="1" height="1" id="thm_fp"><param name="movie" value="' + urlflash + '"/>'
                + '<script type="text/javascript" src="' + urljs + '" />'
            );
            $('#section_form_decidir').append('<div class="alert alert-danger">Se cargo el DF del cybersource</div>');
        },15000);
        $('#csdfid').val(deviceFingerprintId);
    },

    iniciar_cybersourcev2 : function (){
        var org_id = '1snn5n9w'; //test
        //var org_id = 'k8vif92e'; //produccion
        var merchant_id = 'decidir_agregador';
        var deviceFingerprintId = 100000000000 + Math.floor(Math.random() * 999999999999);
        var session_id = merchant_id + deviceFingerprintId;
        var urljs = "https://h.online-metrix.net/fp/tags.js?org_id=" + org_id + "&session_id=" + session_id;
        var urlframe = "https://h.online-metrix.net/fp/tags.js?org_id=" + org_id + "&session_id=" + session_id;
        /**
         * <noscript>
         <iframe style="width: 100px; height: 100px; border: 0; position:
         absolute; top: -5000px;" src="https://h.online-metrix.net/fp/tags?org_
         id=sample_orgID&session_id=sample_merchantIDsample_sessionID"></iframe>
         </noscript>
         */
        var htmlnoscript = '<noscript>\n' +
            '         <iframe style="width: 100px; height: 100px; border: 0; position:\n' +
            '         absolute; top: -5000px;" src="'+urlframe+'"></iframe>\n' +
            '         </noscript>';
        setTimeout(function(){
            $('head').prepend(
                '<script type="text/javascript" src="' + urljs + '" />'
            );
            $('body').prepend(htmlnoscript);
            $('#section_form_decidir').append('<div class="alert alert-danger">Se cargo el DF v2 del cybersource</div>');
        },15000);
        $('#csdfid').val(deviceFingerprintId);
    },

    tipos_tarjeta : function (tipo) {
        var opciones = '<option value="">-- Seleccione --</option>';
        switch (tipo) {
            case 'debito':
                opciones += '<option value="31">Visa</option>';
                opciones += '<option value="105">Mastercard</option>';
                opciones += '<option value="106">Maestro</option>';
                opciones += '<option value="108">Cabal</option>';
                break;
            case 'credito':
                opciones += '<option value="1">Visa</option>';
                opciones += '<option value="8">Diners Club</option>';
                opciones += '<option value="104">Mastercard</option>';
                opciones += '<option value="24">Tarjeta naranja</option>';
                opciones += '<option value="27">Cabal</option>';
                opciones += '<option value="30">ArgenCard</option>';
                opciones += '<option value="65">American Express</option>';
                break;
        }
        $('#select_opciones_tarjeta').html(opciones);
    },

    validar_form_pago : function (){
        var rules = {
            errorElement: "span",
            errorPlacement: function ( error, element ) {
                // Add the `help-block` class to the error element
                error.addClass( "help-block invalid-feedback" );

                // Add `has-feedback` class to the parent div.form-group
                // in order to add icons to inputs
                element.parents( ".form-group" ).addClass( "has-feedback" );

                if ( element.prop( "type" ) === "checkbox" ) {
                    error.insertAfter( element.parent( "label" ) );
                } else {
                    error.insertAfter( element );
                }

                // Add the span element, if doesn't exists, and apply the icon classes to it.
            },
            success: function ( label, element ) {
                // Add the span element, if doesn't exists, and apply the icon classes to it.
            },
            highlight: function ( element, errorClass, validClass ) {
                $( element ).addClass( "is-invalid" ).removeClass( "is-valid" );
                //$( element ).next( "span" ).addClass( "fa-exclamation" ).removeClass( "fa-check" );
            },
            unhighlight: function ( element, errorClass, validClass ) {
                $( element ).addClass( "is-valid" ).removeClass( "is-invalid" );
                //$( element ).next( "span" ).addClass( "fa-check" ).removeClass( "fa-exclamation" );
            }
        }
        var validator = $('#form_pago_decidir').validate(rules);
        validator.form();
        return validator.valid();
    },

    procesar_token : function (){
        $('#json_envio_token').html(Decidir.html_spinner());
        $('#json_resultado_token').html(Decidir.html_spinner());
        $.ajax({
            method: 'post',
            url: 'private/process_token.php',
            dataType : 'json',
            data : {
                post_fields : Decidir.obtener_data_form(),
                type_payment_in : 'shopping',
                order_number : $('#site_transaction_id').val()
            },
            success : function (response) {
                if(response.status){
                    response.response_curl = JSON.parse(response.response_curl);
                    renderJson(JSON.parse(Decidir.obtener_data_form()),'#json_envio_token');
                    renderJson(response,'#json_resultado_token');
                    Decidir.procesar_pago(response.response_curl)
                }
            },
            error :function(){
                alert('hubo un error uuuu dile al programador');
            }
        });
    },

    procesar_pago : function (curl_response){
        $('#json_envio_pago').html(Decidir.html_spinner());
        $('#json_resultado_pago').html(Decidir.html_spinner());
        $.ajax({
            method: 'post',
            url : 'private/process_payment',
            dataType: 'json',
            data : {
                post_fields : Decidir.obtener_data_form_payment(curl_response),
                type_payment_in : 'shopping',
                order_number : $('#site_transaction_id').val()
            },
            success : function (response) {
                response.response_curl = JSON.parse(response.response_curl);
                renderJson(JSON.parse(Decidir.obtener_data_form_payment(curl_response)),'#json_envio_pago');
                renderJson(response,'#json_resultado_pago');
                var msg = 'El pago no pudo ser procesado';
                if(response.status_sale){
                    var msg = 'El pago se valido correctemente';
                }
                $('#msg_operacion').html(msg);
                $('#alert_msg').fadeIn();
                setTimeout(function(){
                    $('#alert_msg').fadeOut(500);
                },1500);
            },
            error : function () {
                alert('hubo un error uuuu dile al programador');
            }
        });
    },

    obtener_data_form : function (){
        var dataJsonToken = {
            'card_holder_name' : $('#card_holder_name').val(),
            'card_number' : $('#card_number').val(),
            'security_code' : $('#security_code').val(),
            'card_expiration_month' : $('#card_expiration_month').val(),
            'card_expiration_year' : $('#card_expiration_year').val(),
            'card_holder_identification' : {
                'type' : $('#card_holder_doc_type').val(),
                'number' : $('#card_holder_doc_number').val()
            },
            'fraud_detection' : {
                'device_unique_identifier' : $('#csdfid').val()
            },
        };
        return JSON.stringify(dataJsonToken);
    },

    obtener_data_form_sin_cs : function  (){
        var dataJsonToken = {
            'card_holder_name' : $('#card_holder_name').val(),
            'card_number' : $('#card_number').val(),
            'security_code' : $('#security_code').val(),
            'card_expiration_month' : $('#card_expiration_month').val(),
            'card_expiration_year' : $('#card_expiration_year').val(),
            'card_holder_identification' : {
                'type' : $('#card_holder_doc_type').val(),
                'number' : $('#card_holder_doc_number').val()
            },
        };
        return JSON.stringify(dataJsonToken);
    },

    obtener_data_form_payment : function(responseTk){
        var dataJson = {
            /*"customer" : {
                "id" : "",
                "email" : "",
                "ip_address": "127.0.0.1"
            },*/
            "token" : responseTk.id,
            "payment_method_id" : parseInt($('#select_opciones_tarjeta').val()),
            "bin" : responseTk.bin,
            "currency" : "ARS",
            "installments": 1,
            "description": "",
            "payment_type": "single",
            "establishment_name" : "Omnilife Pruebas",
            "sub_payments": [],
            "fraud_detection" : {
                "send_to_cs" : true,
                "channel" : "Web",
                'device_unique_identifier' : $('#csdfid').val(),
                "bill_to" : {
                    "city": "Buenos Aires",
                    "country": "AR",
                    "customer_id": "000515VCJ",
                    "email": "enriquecr1990@gmail.com",
                    "first_name": "martin",
                    "last_name": "paoletta",
                    "phone_number": "2467575099",
                    "postal_code": "1035",
                    "state": "BA",
                    "street1": "GARCIA DEL RIO 4041",
                    "street2": "GARCIA DEL RIO 4041"
                },
                "purchase_totals": {
                    "currency": "ARS",
                    "amount": 2 //el monto debera actualizarce en el controlador o modelo
                },
                /*
                 * la documentacion menciona que son campos opcionales el customer_in_site
                 * aunque el retail pide el customer in site
                */
                /*"customer_in_site": {
                    "days_in_site": 243,
                    "is_guest": false,
                    "password": "abracadabra",
                    "num_of_transactions": 1,
                    "cellphone_number": "12121",
                    "date_of_birth": "129412",
                    "street": "RIO 4041"
                },*/
                "retail_transaction_data": {
                    "ship_to": {
                        "city": "Buenos Aires",
                        "country": "AR",
                        "customer_id": "000515VCJ",
                        "email": "enriquecr1990@gmail.com",
                        "first_name": "martin",
                        "last_name": "paoletta",
                        "phone_number": "2467575099",
                        "postal_code": "1035",
                        "state": "BA",
                        "street1": "GARCIA DEL RIO 4041",
                        "street2": "GARCIA DEL RIO 4041"
                    },
                    //"days_to_delivery": "55",
                    //"dispatch_method": "storepickup",
                    //"tax_voucher_required": true,
                    //"customer_loyality_number": "123232",
                    //"coupon_code": "cupon22",
                    "items": [
                        {
                            "code": "popblacksabbat2016",
                            "description": "Popular Black Sabbath 2016",
                            "name": "popblacksabbat2016ss",
                            "sku": "asas",
                            "total_amount": 30000,
                            "quantity": 1,
                            "unit_price": 30000
                        },
                        {
                            "code": "popblacksdssabbat2016",
                            "description": "Popular Blasdsck Sabbath 2016",
                            "name": "popblacksabbatdsds2016ss",
                            "sku": "aswewas",
                            "total_amount": 19575,
                            "quantity": 1,
                            "unit_price": 19575
                        }
                    ]
                },
                "csmdds": [
                    {
                        "code": 17,
                        "description": "Campo MDD17"
                    },
                    {
                        "code": 18,
                        "description": "Campo MDD18"
                    },
                    {
                        "code": 19,
                        "description": "Campo MDD19"
                    },
                    {
                        "code": 20,
                        "description": "Campo MDD20"
                    },
                    {
                        "code": 21,
                        "description": "Campo MDD21"
                    },
                    {
                        "code": 22,
                        "description": "Campo MDD22"
                    },
                    {
                        "code": 23,
                        "description": "Campo MDD23"
                    },
                    {
                        "code": 24,
                        "description": "Campo MDD24"
                    },
                    {
                        "code": 25,
                        "description": "Campo MDD25"
                    },
                    {
                        "code": 26,
                        "description": "Campo MDD26"
                    },
                    {
                        "code": 27,
                        "description": "Campo MDD27"
                    },
                    {
                        "code": 28,
                        "description": "Campo MDD28"
                    },
                    {
                        "code": 29,
                        "description": "Campo MDD29"
                    },
                    {
                        "code": 30,
                        "description": "Campo MDD30"
                    },
                    {
                        "code": 31,
                        "description": "Campo MDD31"
                    },
                    {
                        "code": 32,
                        "description": "Campo MDD32"
                    },
                    {
                        "code": 33,
                        "description": "Campo MDD33"
                    },
                    {
                        "code": 34,
                        "description": "Campo MDD34"
                    },
                    {
                        "code": 43,
                        "description": "Campo MDD43"
                    },
                    {
                        "code": 44,
                        "description": "Campo MDD44"
                    },
                    {
                        "code": 45,
                        "description": "Campo MDD45"
                    },
                    {
                        "code": 46,
                        "description": "Campo MDD46"
                    },
                    {
                        "code": 47,
                        "description": "Campo MDD47"
                    },
                    {
                        "code": 48,
                        "description": "Campo MDD48"
                    },
                    {
                        "code": 49,
                        "description": "Campo MDD49"
                    },
                    {
                        "code": 50,
                        "description": "Campo MDD50"
                    },
                    {
                        "code": 51,
                        "description": "Campo MDD51"
                    },
                    {
                        "code": 52,
                        "description": "Campo MDD52"
                    },
                    {
                        "code": 53,
                        "description": "Campo MDD53"
                    },
                    {
                        "code": 54,
                        "description": "Campo MDD54"
                    },
                    {
                        "code": 55,
                        "description": "Campo MDD55"
                    },
                    {
                        "code": 56,
                        "description": "Campo MDD56"
                    },
                    {
                        "code": 57,
                        "description": "Campo MDD57"
                    },
                    {
                        "code": 58,
                        "description": "Campo MDD58"
                    },
                    {
                        "code": 59,
                        "description": "Campo MDD59"
                    },
                    {
                        "code": 60,
                        "description": "Campo MDD60"
                    },
                    {
                        "code": 61,
                        "description": "Campo MDD61"
                    },
                    {
                        "code": 62,
                        "description": "Campo MDD62"
                    },
                    {
                        "code": 63,
                        "description": "Campo MDD63"
                    },
                    {
                        "code": 64,
                        "description": "Campo MDD64"
                    },
                    {
                        "code": 65,
                        "description": "Campo MDD65"
                    },
                    {
                        "code": 66,
                        "description": "Campo MDD66"
                    },
                    {
                        "code": 67,
                        "description": "Campo MDD67"
                    },
                    {
                        "code": 68,
                        "description": "Campo MDD68"
                    },
                    {
                        "code": 69,
                        "description": "Campo MDD69"
                    },
                    {
                        "code": 70,
                        "description": "Campo MDD70"
                    },
                    {
                        "code": 71,
                        "description": "Campo MDD71"
                    },
                    {
                        "code": 72,
                        "description": "Campo MDD72"
                    },
                    {
                        "code": 73,
                        "description": "Campo MDD73"
                    },
                    {
                        "code": 74,
                        "description": "Campo MDD74"
                    },
                    {
                        "code": 75,
                        "description": "Campo MDD75"
                    },
                    {
                        "code": 76,
                        "description": "Campo MDD76"
                    },
                    {
                        "code": 77,
                        "description": "Campo MDD77"
                    },
                    {
                        "code": 78,
                        "description": "Campo MDD78"
                    },
                    {
                        "code": 79,
                        "description": "Campo MDD79"
                    },
                    {
                        "code": 87,
                        "description": "Campo MDD87"
                    },
                    {
                        "code": 88,
                        "description": "Campo MDD88"
                    },
                    {
                        "code": 89,
                        "description": "Campo MDD89"
                    },
                    {
                        "code": 90,
                        "description": "Campo MDD90"
                    },
                    {
                        "code": 91,
                        "description": "Campo MDD91"
                    },
                    {
                        "code": 92,
                        "description": "Campo MDD92"
                    },
                    {
                        "code": 93,
                        "description": "Campo MDD93"
                    },
                    {
                        "code": 94,
                        "description": "Campo MDD94"
                    },
                    {
                        "code": 95,
                        "description": "Campo MDD95"
                    },
                    {
                        "code": 96,
                        "description": "Campo MDD96"
                    },
                    {
                        "code": 97,
                        "description": "Campo MDD97"
                    },
                    {
                        "code": 98,
                        "description": "Campo MDD98"
                    },
                    {
                        "code": 99,
                        "description": "Campo MDD99"
                    }
                ],
            },
        };
        return JSON.stringify(dataJson);
    },

    obtener_data_form_payment_sin_cs : function(responseTk){
        var dataJson = {
            "token" : responseTk.id,
            "payment_method_id" : parseInt($('#select_opciones_tarjeta').val()),
            "bin" : responseTk.bin,
            "currency" : "ARS",
            "installments": 1,
            "description": "",
            "payment_type": "single",
            "sub_payments": [],
        };
        return JSON.stringify(dataJson);
    },

    obtenerIPCliente : function (){
        $.getJSON("https://api.ipify.org/?format=json", function(e) {
            console.log(e);
            console.log(JSON.stringify(e));
        });
    },

};

function assing_array (array_firts,array_second){
    var objs = [array_firts,array_second],
        result =  objs.reduce(function (r, o) {
            Object.keys(o).forEach(function (k) {
                r[k] = o[k];
            });
            return r;
        }, {});
    return result;
}

function renderJson(json,preToJSON){
    var opciones = {
        collapsed : false,
        rootCollapsable : true,
        withQuotes : false,
        withLinks : true
    };
    $(preToJSON).jsonViewer(json,opciones);
}