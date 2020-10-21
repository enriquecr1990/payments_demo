$(document).ready(function(){

    $(document).on('click','#get_data_form_payme',function(){
        Payme.getDataFormPayme();
    });

});

var Payme = {

    getDataFormPayme : function(){
        $.ajax({
            header: {
                'X-CSRF-TOKEN' : 'eyJpdiI6ImZvalFhZ0pDN0hxbTBoWVJUdkxjM2c9PSIsInZhbHVlIjoiNlYrSElkSm5cL1h1Tjl0TnBsUE1XUk8ySEVVNlBoakpPTE1PV25BV1JNMFwvMno1YWlUVW9tNmgrdEN5dVpWYnoxIiwibWFjIjoiM2IxNDQ0OTU5ZDI1ZGQ5NTFiOGE0NDc1MWU0YzJjMTBhNGMwNjk3MzQ0MTEwZTk2YTVjYmZjM2U1ZWZjMGJiNCJ9'
            },
            url : 'http://portallocal.omnilife.com/payme/data-form',
            dataType : 'json',
            data : {
                order_number : '1000001050', //order number
                country_id: '16', //glob countries ID
                type_payment_in : 'shipping' //shipping,register
            },
            success : function (response) {
                console.log(response);
            },
            error :function(response){
                console.log(response);
                alert('hubo un error uuuu dile al programador');
            }
        });
    },

    processFormPayme : function(){
        $.ajax({
            url : 'private/PaymePHP.php',
            dataType : 'json',
            data : {},
            success : function (response) {
                if(response.status){
                    $('#form_data_payme').html(response.html_form);
                }
            },
            error :function(){
                alert('hubo un error uuuu dile al programador');
            }
        });
    }
};