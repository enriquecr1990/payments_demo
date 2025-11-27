$(document).ready(function(){

    $(document).on('click','#btn-listado-subscripciones',function(){
    });

    PayPal.listado_subscripciones();

});

var PayPal = {

    html_spinner : function (){
        var html = '' +
            '<div class="spinner-border text-success" role="status">' +
            '<span class="sr-only"></span>' +
            '</div>';
        return html;
    },

    html_spinner_listsubs : function(){
        var html = '<tr><td cols="5" class="text-center">'+PayPal.html_spinner()+'</td></tr>';
        return html;
    },

    listado_subscripciones : function(){
        $('#rows_productos_paypal').html(PayPal.html_spinner_listsubs());
        $.ajax({
            method: 'post',
            url : 'private/subscripcion.php',
            dataType: 'json',
            data : {
                operacion : 'listado'
            },
            success : function (response) {
                console.log(response);
            },
            error : function () {
                alert('hubo un error uuuu dile al programador');
            }
        });
    }

};

function renderJson(json,preToJSON){
    var opciones = {
        collapsed : false,
        rootCollapsable : true,
        withQuotes : false,
        withLinks : true
    };
    $(preToJSON).jsonViewer(json,opciones);
}