<?php
//parametros
$parametros = array(
    'accountId' => 30423,
    'token' => 'cRaOPkSSdnvswnLvI59#',
    'transactionId' => 50001097
);

$datosCodificados = json_encode($parametros);

// Comenzar a crear el objeto de curl
$url = "https://apiecommerce.pagosinteligentes.com:8070/CheckOut/GetStatusTransaction";
$ch = curl_init($url);

# Ahora le ponemos todas las opciones
curl_setopt_array($ch, array(
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
));
# Se realiza la peticion
$resultado = curl_exec($ch);
var_dump(json_decode($resultado));
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