<?php

//Testing::cifradoBitoo();
//Testing::dateISO8601();
$funcion = $_GET['funcion'];
$testing = new Testing();
$testing->$funcion();

class Testing {

    public function cifradoBitoo(){
        $strleng = '1173';
        $passphrase = 'bitoo2023Softura';
        $b64pp = base64_encode($passphrase);

        $encryp = openssl_encrypt($strleng, 'AES-256-CBC',$passphrase,false,base64_decode($b64pp));
        $encryp = base64_encode($encryp);
        $decryp = openssl_decrypt(base64_decode($encryp),'AES-256-CBC',$passphrase,false,base64_decode($b64pp));
        var_dump($strleng,$encryp,$decryp);exit;
    }

    public function implodeArray(){
        $array = [10,30,870,198,4987,238,10];
        var_dump($array,implode(',',$array));exit;
    }

    public function dateISO8601(){
        //date_default_timezone_set('America/Argentina/Buenos_Aires');
        $date = date('Y-m-d H:i:s',strtotime('+6 hours'));
        $dateTime = new DateTime($date,new DateTimeZone('America/Argentina/Buenos_Aires'));
        var_dump($dateTime->format('c'));
    }

    public function openApp(){
        $html = '<!DOCTYPE html>
            <html lang="es">
            <head>
                <meta charset="UTF-8">
                <title>Mercado pago</title>
                <meta charset="utf-8">
            
                <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
            
                <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
                      integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
            
                <link rel="shortcut icon" href="https://http2.mlstatic.com/ui/navigation/2.0.3/mercadopago/favicon.ico"/>
            
            </head>
            <body>
                <h1>Probando abrir una app movil</h1>
                <br>
                <button id="abrir_app" class="btn btn-sm btn-info">Abrir app</button>
                
                <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
                <script>
                    $(document).ready(function(){
                        
                        $("#abrir_app").click(function (){
                            App.start();
                        });
                        
                    });
                    
                    var App = {
                        start :function(){
                            //var url_open = "intent://bitoo.com.mx/pago-realizado/SGhNK0JXSGhGR0ZJSkF6VFhCOThidz09#Intent;scheme=https;package=mx.com.softura.bitoo.produccion;end";
                            //var url_open = "intent://bitoo.com.mx/centroeducativocrecer1#Intent;scheme=https;package=mx.com.softura.bitoo.produccion;end";
                            //var url_open = "intent://instagram.com/perfil#Intent;scheme=https;package=com.instagram.android;end";
                            //var url_open = "bitoo://https://apps.apple.com/mx/app/bitoo/id1586676298";
                            //para probar el abrir en iphone una app
                            alert("abriendo bitoo ios");var url_open = "bitoo://";
                            //alert("abriendo instagram ios");var url_open = "instagram://profile";
                            //alert("abriendo mp ios");var url_open = "mercadopago://";
                            //alert("abriendo maps ios");var url_open = "maps://";
                            //window.location.replace("bitoo://centroeducativocrecer1");
                            alert(url_open);
                            setTimeout(function(){
                                window.location.replace(url_open);
                            },1000);
                        }
                    };
                    
                </script>
            </body>
            
            </html>
            ';
        echo $html;
    }

    public function formatNumero(){
        $numero = '100.98';
        var_dump($numero,$numero*100);
    }

}