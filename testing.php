<?php

//Testing::cifradoBitoo();
//Testing::dateISO8601();
$funcion = $_GET['funcion'];

if(isset($_GET['funcion'])){
    $params = $_GET;
    $funcion = $params['funcion'];
    unset($params['funcion']);
    $testing = new Testing($params);
    $formato = $testing->$funcion($params);
    var_dump($formato);
}else{
    echo 'Error 400 - falta funcion en la URL';
}

$testing->$funcion();
class Testing {

    private $params;

    function __construct($params = array()){
        $this->params = $params;
    }

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
        var_dump($numero,(int)($numero*100),$numero*100);
    }

    public function implodePays(){
        $string = '/carpeta/sub_carpeta/otra_mas/archivo.jpg|/carpeta/sub_carpeta/otra_mas/archivo2.jpg|/carpeta/sub_carpeta/otra_mas/archivo.png';
        $stamps = explode('|',$string);
        var_dump($stamps);
    }

    public function img_png(){
        try{
            $pathApp = __DIR__;
            $pathImgOriginal = $pathApp.'/extras/imagenes/12_24_34-diapositiva1.png';
            $pathImgEdit = $pathApp.'/extras/imagenes/12_24_34-diapositiva1editPHP.png';
            //validamos el tipo de extension del archivo
            $dataImg = pathinfo($pathImgOriginal);
            
            // Cargar la imagen original
            //swith para el tipo de imagen
            switch($dataImg['extension']){
                case 'jpg':case 'JPG':case 'jpeg': case 'JPEG':
                    $originalImage = imagecreatefromjpeg($pathImgOriginal);
                    break;
                case 'png':case 'PNG':
                    $originalImage = imagecreatefrompng($pathImgOriginal);
                    break;
                case 'bmp':case 'BMP':
                    $originalImage = imagecreatefrombmp($pathImgOriginal);
                    break;
            }

            // Crear una nueva imagen con las mismas dimensiones
            $blanco = imagecolorallocate($originalImage,255,255,255);
            imagecolortransparent($originalImage,$blanco);
            imagepng($originalImage,$pathImgEdit);
            imagedestroy($originalImage);

            echo 'Se tranformo la imagen con exito';
            echo '<br>Archivo '.$dataImg['basename']. ' -> '.$dataImg['filename'].'editPHP.png';
            echo '<br><a href="http://metodospago.local.com/extras/imagenes/'.$dataImg['basename'].'" target="_blank">original</a>';
            echo '<br><a href="http://metodospago.local.com/extras/imagenes/'.$dataImg['filename'].'editPHP.png" target="_blank">editado</a>';
        }catch(Exception $ex){
            echo 'Error: -> '.$ex->getMessage(). ' - '.$ex->getFile(). ' - '.$ex->getLine();exit;
        }
    }

    public function formatoExpiracion($params = array()){
        $expiration = '';
        $timeQR = isset($params['tiempo']) ? (int)$params['tiempo'] : 5;
        $dias = floor($timeQR / (24*60)); //calculamos los dias contenidos en el 
        $diasFormat = str_pad($dias,2,"0",STR_PAD_LEFT);
        $minutosRestanteDias = $timeQR % (24*60);
        $horas = floor($minutosRestanteDias / 60);
        $horasFormat = str_pad($horas,2,"0",STR_PAD_LEFT);
        $minutos = $timeQR % 60;
        $minutosFormat = str_pad($minutos,2,"0",STR_PAD_LEFT);
        $expiration = $diasFormat.'/'.$horasFormat.':'.$minutosFormat;
        return $expiration;
    }
}