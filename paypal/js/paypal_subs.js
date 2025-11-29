$(document).ready(function(){

    $(document).on('click','#btn-buscar-productos',function(){
        PayPal.listado_productos();
    });

    $(document).on('click','#btn_guardar_producto',function(){
        PayPal.guardar_producto();
    });

    $(document).on('click','#btn-buscar-planes',function(){
        PayPal.listado_planes();
    });

    

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
        var html = '<tr><td colspan="5" class="text-center">'+PayPal.html_spinner()+'</td></tr>';
        return html;
    },

    modal_process : function(id_modal,mostrar){
        if(mostrar){
            $(id_modal).modal('show');
        }else{
            $(id_modal).modal('hide');
        }
    },

    mensajes_sistema : function(mensajes){
        var html_msgs = ''+
            '<div id="msg_toats" class="toast" role="alert" aria-live="polite" aria-atomic="true">'+
                '<div class="toast-header">'+
                    '<strong class="me-auto">Mensajes del sistema</strong>'+
                    '<small class="text-body-secondary">11 mins ago</small>'+
                '</div>'+
                '<div class="toast-body">';
        mensajes.forEach(function(msg){
            html_msgs += '<li>'+msg+'</li>';
        });
        html_msgs += '</div>'+
            '</div>';
        $('#contenedor_mensajes_toast').html(html_msgs);
        $('#msg_toats').show();
        setTimeout(function(){
            $('#msg_toats').hide();
            setTimeout(function(){$('#contenedor_mensajes_toast').html('');},500);
        },7000);
    },

    listado_productos : function(){
        $('#rows_productos_paypal').html(PayPal.html_spinner_listsubs());
        $.ajax({
            method: 'post',
            url : 'private/subscripcion.php',
            dataType: 'json',
            data : {
                operacion : 'listado_producto'
            },
            success : function (response) {
                if(response.status != 'ok'){
                    PayPal.mensajes_sistema(response.message);
                }else{
                    $('#rows_productos_paypal').html(PayPal.parse_html_productos(response.data.productos));
                }
            },
            error : function () {
                alert('hubo un error uuuu dile al programador');
            }
        });
    },

    parse_html_productos : function(products){
        var html = '';
        products.forEach(function(p){
            html += 
            '<tr>'+
                '<td>'+p.id+'</td>'+
                '<td>'+p.name+'</td>'+
                '<td>'+p.description+'</td>'+
                '<td>'+p.create_time+'</td>'+
                '<td>'+
                    '<button class="btn btn-sm btn-warning mr-1">Editar</button>'+
                    '<button class="btn btn-sm btn-danger">Eliminar</button>'+
                    '<button class="btn btn-sm btn-info" data-id_producto="'+p.id+'">Crear Plan</button>'+
                '</td>'+
            '</tr>';
        });
        return html;
    },

    guardar_producto : function(){
        $.ajax({
            type : 'post',
            url : 'private/subscripcion.php',
            dataType : 'json',
            data : $('#form_producto').serialize()+'&operacion=agregar_producto',
            success : function(response){
                if(response.status == 'ok'){
                    PayPal.modal_process('#modal_form_producto',false);
                    PayPal.listado_subscripciones();
                }
                PayPal.mensajes_sistema(response.message);
            },
            error : function(error){
                console.log(error);
                PayPal.mensajes_sistema(['ocurrio un error, avisa al desarrollador']);
            }
        });
    },

    html_spinner_listaplanes : function(){
        var html = '<tr><td colspan="7" class="text-center">'+PayPal.html_spinner()+'</td></tr>';
        return html;
    },

    listado_planes : function(){
        $('#rows_planes_paypal').html(PayPal.html_spinner_listaplanes());
        $.ajax({
            method: 'post',
            url : 'private/subscripcion.php',
            dataType: 'json',
            data : {
                operacion : 'listado_plan'
            },
            success : function (response) {
                if(response.status != 'ok'){
                    PayPal.mensajes_sistema(response.message);
                }else{
                    $('#rows_planes_paypal').html(PayPal.parse_html_planes(response.data.planes));
                }
            },
            error : function () {
                alert('hubo un error uuuu dile al programador');
            }
        });
    },

    parse_html_planes : function(planes){
        var html = '';
        planes.forEach(function(p){
            html += 
            '<tr>'+
                '<td>'+p.id+'</td>'+
                '<td>'+p.product_id+'</td>'+
                '<td>'+p.name+'</td>'+
                '<td>'+p.description+'</td>'+
                '<td>'+p.status+'</td>'+
                '<td>'+p.create_time+'</td>'+
                '<td>'+
                    '<button class="btn btn-sm btn-warning mr-1">Editar</button>'+
                    '<button class="btn btn-sm btn-danger">Eliminar</button>'+
                '</td>'+
            '</tr>';
        });
        return html;
    },

};