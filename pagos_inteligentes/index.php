<?php

//se definen parametros.
$parameters = [
    "generateTransaction" => [
        "security" => [
            "accountId" => 30423,
            "token" => "kPlQkheYXIxxFxmJp08@",
        ],
        "infoPayment" => [
            "amount" => 1000,
            "tax" => 0,
            "description" => "Prueba php",
            "toolId" => 5,
            "registryToolId" => 0,
            "currency" => "COP",
        ],
        "infoClient" => [
            "name" => "Pagos Inteligentes",
            "idType" => "",
            "idNumber" => "",
            "email" => "comprobantes@pagosinteligentes.com",
            "phone" => "573213285290",
        ],
        "infoAdditional" => [
            "disabledPaymentMethod" => "20,21,24",
            "infoAdditional" => 0,
            "urlResponseOk" => "https://sag.pagosinteligentes.com:8140/",
            "urlResponseFail" => "https://sag.pagosinteligentes.com:8140/",
            "urlResponsePending" => "https://sag.pagosinteligentes.com:8140/",
            "urlNotificationPost" => "https://sag.pagosinteligentes.com:8140/",
            "photo" => "https://dl.dropboxusercontent.com/s/jghrtm678do5fts/carrito.jpg?dl=0",
            //"cashDiscount" => 0,
            //"expiredCashDiscount" => "2021/12/31",
            "deliveryAddres" => false,
            "ammountShipping" => 0,
        ],
    ]
];
$strParameters = '
{
  "generateTransaction": {
    "security": {
      "accountId": 30423,
      "token": "cRaOPkSSdnvswnLvI59#"
    },
    "infoPayment": {
      "amount": 1000,
      "totalAmount": 1000,
      "tax": 0,
      "description": "Prueba Swagger",
      "toolId": 5,
      "registryToolId": 0,
      "currency": "COP"
    },
    "infoClient": {
      "name": "Pagos Inteligentes",
      "idType": "CC",
      "idNumber": "123456789",
      "email": "comprobantes@pagosinteligentes.com",
      "phone": "573213285290"
    },
    "infoAdditional": {
      "disabledPaymentMethod": "20,21,24",
      "infoAdditional": 0,
      "urlResponseOk": "https://sag.pagosinteligentes.com:8140/",
      "urlResponseFail": "https://sag.pagosinteligentes.com:8140/",
      "urlResponsePending": "https://sag.pagosinteligentes.com:8140/",
      "urlNotificationPost": "https://sag.pagosinteligentes.com:8140/",
      "photo": "https://dl.dropboxusercontent.com/s/jghrtm678do5fts/carrito.jpg?dl=0",
      "cashDiscount": 0,
      "expiredCashDiscount": "2021/12/31",
      "deliveryAddres": true,
      "ammountShipping": 0,
      "custom1": "string"
    }
  }
}
';


// Se codifica a formato Json
$datosCodificados = json_encode($parameters);
//var_dump($datosCodificados,$strParameters);exit;

// Comenzar a crear el objeto de curl
# Url donde se hace la petición...
$url = "https://apiecommerce.pagosinteligentes.com:8070/CheckOut/MethodGenerateTransaction";
$ch = curl_init($url);
$dataCh = array(
    // Indicar que vamos a hacer una petición POST
    CURLOPT_CUSTOMREQUEST => "POST",
    // Justo aquí ponemos los datos dentro del cuerpo
    CURLOPT_POSTFIELDS => $datosCodificados,
    CURLOPT_SSL_VERIFYHOST => false,
    CURLOPT_SSL_VERIFYPEER => false,
    // Encabezados
    //CURLOPT_HEADER => true,
    CURLOPT_HTTPHEADER => array(
        'Content-Type: application/json',
        'Content-Length: ' . strlen($datosCodificados), // Abajo podríamos agregar más encabezados
    ),
    # indicar que regrese los datos, no que los imprima directamente
    CURLOPT_RETURNTRANSFER => true,
);
# Ahora le ponemos todas las opciones
curl_setopt_array($ch, $dataCh);
# Se realiza la peticion
$resultado = curl_exec($ch);
echo '<pre>';
print_r($dataCh);
echo '</pre><br>*****<br>';
echo '<pre>';
print_r(json_decode($resultado));
# Si el código es 200, es decir, HTTP_OK
$codigoRespuesta = curl_getinfo($ch, CURLINFO_HTTP_CODE);
if($codigoRespuesta === 200){
    $respuestaDecodificada = json_decode($resultado);
    var_dump($respuestaDecodificada);
}else{
    # Error
    echo "Error consultando. Código de respuesta: $codigoRespuesta";
}
curl_close($ch);