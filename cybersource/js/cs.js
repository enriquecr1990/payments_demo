$(document).ready(function(){

    $('#btn_lanzar_form_cs').on('click',function(){
        Cs.procesar_formulario();
    });

});

var Cs = {

    html_spinner : function (){
        var html = '' +
            '<div class="spinner-border text-success" role="status">' +
            '<span class="sr-only">Loading...</span>' +
            '</div>';
        return html;
    },

    procesar_formulario : function (){
        $('#json_envio_pago').html(Cs.html_spinner());
        $('#json_resultado_pago').html(Cs.html_spinner());
        $.ajax({
            method: 'post',
            url : 'private/process_payment.php',
            dataType: 'json',
            data : {},
            success : function (response) {
                console.log(response);
                var html_form_cspayme = '' +
                    '<form id="payment_confirmation" action="'+response.data.form_action+'" method="post">' +
                    '<input id="access_key" type="hidden" name="access_key" value="'+response.data.access_key+'">' +
                    '<input id="profile_id" type="hidden" name="profile_id" value="'+response.data.profile_id+'">' +
                    '<input id="transaction_uuid" type="hidden" name="transaction_uuid" value="'+response.data.transaction_uuid+'">' +
                    '<input id="signed_field_names" type="hidden" name="signed_field_names" value="'+response.data.signed_field_names+'">' +
                    '<input id="unsigned_field_names" type="hidden" name="unsigned_field_names" >' +
                    '<input id="signed_date_time" type="hidden" name="signed_date_time" value="'+response.data.signed_date_time+'">' +
                    '<input id="locale" type="hidden" name="locale" value="'+response.data.locale+'">' +
                    '<input id="transaction_type" type="hidden" name="transaction_type" value="'+response.data.transaction_type+'">' +
                    '<input id="reference_number" type="hidden" name="reference_number" value="'+response.data.reference_number+'">' +
                    '<input id="amount" type="hidden" name="amount" value="'+response.data.amount+'">' +
                    '<input id="currency" type="hidden" name="currency" value="'+response.data.currency+'">' +
                    '<input id="bill_to_forename" type="hidden" name="bill_to_forename" value="'+response.data.bill_to_forename+'">' +
                    '<input id="bill_to_surname" type="hidden" name="bill_to_surname" value="'+response.data.bill_to_surname+'">' +
                    '<input id="bill_to_address_line1" type="hidden" name="bill_to_address_line1" value="'+response.data.bill_to_address_line1+'">' +
                    '<input id="bill_to_address_city" type="hidden" name="bill_to_address_city" value="'+response.data.bill_to_address_city+'">' +
                    '<input id="bill_to_address_state" type="hidden" name="bill_to_address_state" value="'+response.data.bill_to_address_state+'">' +
                    '<input id="bill_to_address_postal_code" type="hidden" name="bill_to_address_postal_code" value="'+response.data.bill_to_address_postal_code+'">' +
                    '<input id="bill_to_address_country" type="hidden" name="bill_to_address_country" value="'+response.data.bill_to_address_country+'">' +
                    '<input id="bill_to_phone" type="hidden" name="bill_to_phone" value="'+response.data.bill_to_phone+'">' +
                    '<input id="bill_to_email" type="hidden" name="bill_to_email" value="'+response.data.bill_to_email+'">' +
                    '<input id="merchant_defined_data3" type="hidden" name="merchant_defined_data3" value="'+response.data.merchant_defined_data3+'">' +
                    '<input id="merchant_defined_data4" type="hidden" name="merchant_defined_data4" value="'+response.data.merchant_defined_data4+'">' +
                    '<input id="merchant_defined_data6" type="hidden" name="merchant_defined_data6" value="'+response.data.merchant_defined_data6+'">' +
                    '<input id="merchant_defined_data11" type="hidden" name="merchant_defined_data11" value="'+response.data.merchant_defined_data11+'">' +
                    '<input id="merchant_defined_data16" type="hidden" name="merchant_defined_data16" value="'+response.data.merchant_defined_data16+'">' +
                    '<input id="merchant_defined_data17" type="hidden" name="merchant_defined_data17" value="'+response.data.merchant_defined_data17+'">' +
                    '<input id="merchant_defined_data18" type="hidden" name="merchant_defined_data18" value="'+response.data.merchant_defined_data18+'">' +
                    '<input id="merchant_defined_data24" type="hidden" name="merchant_defined_data24" value="'+response.data.merchant_defined_data24+'">' +
                    '<input id="device_fingerprint_id" type="hidden" name="device_fingerprint_id" value="'+response.data.device_fingerprint_id+'">' +
                    '<input id="signature" type="hidden" name="signature" value="'+response.data.signature+'">' +
                    '<input type="submit" class="button small" id="submit" style="display: none" value="pagar"/>' +
                    //'<input type="submit" class="button small" id="btn_submit_form_cspayme" value="{{trans("shopping::register.checkout_button")}}"/>' +
                    '</form>';
                $('#section_form_cs_payme').html(html_form_cspayme);
                var url_js_dfp = 'https://h.online-metrix.net/fp/tags.js?org_id=1snn5n9w&session_id=redenlace_414442'+response.data.transaction_uuid;
                $('#extra_js_dfp').html('<script type="text/javascript" src="'+url_js_dfp+'"></script>');
                // $.getScript(url_js_dfp)
                //     .done(function( script, textStatus ) {
                //         console.log( textStatus );
                //     })
                //     .fail(function( jqxhr, settings, exception ) {
                //         console.log(jqxhr,settings,exception);
                //         alert('No fue posible cargar el scriptse cargo el script correctamente');
                //     });
                setTimeout(function(){
                    $('#submit').fadeIn();
                },500);
            },
            error : function () {
                alert('hubo un error uuuu dile al programador');
            }
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