$(document).ready(function(){
    $('#btn_procesar_form_rapipago').on('click',function(){
        Rapipago.procesarDatosFormulario();
    });
});

var Rapipago = {
    procesarDatosFormulario : function (){
        $.ajax({
            method: 'post',
            url : 'private/procesar_formulario.php',
            dataType: 'json',
            data : {},
            success : function (response) {
                if(response.success){
                    Rapipago.armarFormulario(response);
                    alert('se procesaron los datos del formulario');
                }else{
                    alert('No pudimos generar los datos del formulario');
                }
            },
            error : function () {
                alert('hubo un error uuuu dile al programador');
            }
        });
    },

    armarFormulario : function(response){
        $('#GS_USERNAME').val(response.form_rapipago.gs_username);
        $('#GS_PASSWORD').val(response.form_rapipago.gs_password);
        $('#GS_EMAIL').val(response.form_rapipago.gs_email);
        $('#GS_CLIENT_ID').val(response.form_rapipago.gs_client_id);
        $('#GS_TX_ID').val(response.form_rapipago.gs_tx_id);
        $('#GS_MONTO_BASE').val(response.form_rapipago.gs_monto_base);
        $('#GS_MONTO_ADICIONAL').val(response.form_rapipago.gs_monto_adicional);
        $('#GS_IMPUESTOS').val(response.form_rapipago.gs_impuestos);
        $('#GS_IMPORTE').val(response.form_rapipago.gs_importe);
        $('#GS_MERCHANT_ID').val(response.form_rapipago.gs_merchant_id);
        $('#GS_REF_01').val(response.form_rapipago.gs_ref_01);
        $('#GS_REF_02').val(response.form_rapipago.gs_ref_02);
        $('#GS_REF_03').val(response.form_rapipago.gs_ref_03);
        $('#GS_MONEDA').val(response.form_rapipago.gs_moneda);
        $('#GS_CUOTAS').val(response.form_rapipago.gs_cuotas);
        $('#GS_RECARGO').val(response.form_rapipago.gs_recargo);
        $('#GS_AMBIENTE').val(response.form_rapipago.ambiente);
        $('#GS_URL_HOME').val(base_url);
        $('#GS_URL_CONFIRM').val(base_url+'pago_procesado.php');
        $('#GS_PRODUCTO').val(response.form_rapipago.gs_producto);
        $('#GS_DIAS_VENCIMIENTO').val(response.form_rapipago.gs_dias_vencimiento);
        $('#GS_TIPO_OPERACION').val(response.form_rapipago.gs_tipo_operacion);
        $('#GS_SHASIGN').val(response.form_rapipago.gs_shasing);
    }
};