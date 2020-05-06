$(document).ready(function(){

    Payme.showFormPayMe();

});

var Payme = {

    showFormPayMe : function(){
        if(AlignetVPOS2.isSafari()){
            setTimeout(function(){
                //$('#frame_to_cokies').remove();
                Payme.processFormPayme();
            },2000);
        }else{
            Payme.processFormPayme();
        }
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