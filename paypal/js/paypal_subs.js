$(document).ready(function(){

    $(document).on('click','#btn-buscar-productos',function(){
        PayPal.listado_productos();
    });

    $(document).on('click','#btn_guardar_producto',function(){
        PayPal.guardar_producto();
    });

    $(document).on('click','.btn_crear_plan_producto',function(){
        var id_producto = $(this).data('id_producto');
        var nombre_producto = $(this).data('nombre_producto');
        $('#btn_acordion_plan_subs').trigger('click');
        $('#btn-nuevo-plan').removeAttr('disabled');
        $('#span_nombre_producto').html(nombre_producto);
        $('#input_id_producto').val(id_producto);
    });

    $(document).on('click','#btn-buscar-planes',function(){
        PayPal.listado_planes();
    });

    $(document).on('click','#btn_guardar_plan',function(){
        PayPal.guardar_plan();
    });

    $(document).on('click','.btn_crear_subscripcion',function(){
        // $('#paypal-button-container').html(PayPal.html_spinner());
        var plan_id = $(this).data('plan_id');
        var nombre_plan = $(this).data('nombre_plan');
        $('#btn_acordion_subscripcion').trigger('click');
        $('#btn-nuevo-plan').removeAttr('disabled');
        $('#plan_seleccionado_subscripcion').html(nombre_plan);
        // $('#input_id_producto').val(id_producto);
        PayPal.subscribir_a_plan(plan_id);
    });
    // PayPal.start_validation_form_plan();

});

var PayPal = {

    start_validation_form_plan : function(){
        // Example starter JavaScript for disabling form submissions if there are invalid fields
        (() => {
                'use strict'

                // Fetch all the forms we want to apply custom Bootstrap validation styles to
                const forms = document.querySelectorAll('.needs-validation')

                // Loop over them and prevent submission
                Array.from(forms).forEach(form => 
                    {
                        var form_valid
                        form.addEventListener('submit', event => {
                            if (!form.checkValidity()) {
                                event.preventDefault()
                                event.stopPropagation()
                            }

                            form.classList.add('was-validated')
                        }, false)
                    }
                )
            }
        )()
    },

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
                if(response.status == 'ok' || response.status == 'success'){
                    $('#rows_productos_paypal').html(PayPal.parse_html_productos(response.data.productos));
                }else{
                    PayPal.mensajes_sistema(response.message);
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
                    '<button class="btn btn-sm btn-info btn_crear_plan_producto" data-id_producto="'+p.id+'" data-nombre_producto="'+p.name+'">Crear Plan</button>'+
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
                if(response.status == 'ok' || response.status == 'success'){
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
                if(response.status == 'ok' || response.status == 'success'){
                    $('#rows_planes_paypal').html(PayPal.parse_html_planes(response.data.planes));
                }else{
                    PayPal.mensajes_sistema(response.message);
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
                    '<button class="btn btn-sm btn-success btn_crear_subscripcion" data-plan_id="'+p.id+'" data-nombre_plan="'+p.name+'">Subscribirse</button>'+
                '</td>'+
            '</tr>';
        });
        return html;
    },

    guardar_plan : function(){
        //realizamos la omision de validacion del formulario, es meramente prueba
        $.ajax({
            type : 'post',
            url : 'private/subscripcion.php',
            dataType : 'json',
            data : $('#form_plan').serialize()+'&operacion=agregar_plan',
            success : function(response){
                if(response.status == 'ok' || response.status == 'success'){
                    PayPal.modal_process('#modal_form_plan',false);
                    PayPal.listado_planes();
                }
                PayPal.mensajes_sistema(response.message);
            },
            error : function(error){
                console.log(error);
                PayPal.mensajes_sistema(['ocurrio un error, avisa al desarrollador']);
            }
        });
    },

    subscribir_a_plan : function(plan_id){
        paypal.Buttons({
            createSubscription: function (data, actions) {
                console.log(data);
                console.log(actions);
                return actions.subscription.create({
                    'plan_id': plan_id// Creates the subscription
                });
            },
            onApprove: function (data, actions) {
                console.log(data);
                console.log(actions);
                // alert('You have successfully subscribed to ' + data.subscriptionID); // Optional message given to subscriber
                PayPal.mensajes_sistema(['Se subscribio correctamente al plan.' + data.subscriptionID]);
                $('#paypal-button-container').html('');
            }
        }).render('#paypal-button-container'); // Renders the PayPal button
    },

};