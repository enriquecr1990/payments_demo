<?php

$userId = '8a8294185a65bf5e015a6c8c728c0d95';
$authPass = 'bfqGqwQ32X';
//$entityId = '8a82941865aee2820165af643b570208';
$entityId = '8a82941865aee2820165af643b570208';
//$token = 'OGE4Mjk0MTg1MzNjZjMxZDAxNTMzZDA2ZmQwNDA3NDh8WHQ3RjIyUUVOWA==';
$token = 'OGE4Mjk0MTg1YTY1YmY1ZTAxNWE2YzhjNzI4YzBkOTV8YmZxR3F3UTMyWA==';
$mid = '1000000505';
$tid = 'PD100406';

$montoTotal = '9';
$base12 = number_format($montoTotal / 1.12,2,'.','');
$iva = number_format($montoTotal - $base12,2,'.','');

$iva = str_replace('.','',$iva);
$base12 = str_replace('.','',$base12);
$monto = str_replace('.','',$montoTotal);

$ivaDatafast = str_pad($iva,12,'0',STR_PAD_LEFT);
$base12DataFast = str_pad($base12,12,'0',STR_PAD_LEFT);
$montoDataFast = str_pad($monto,12,'0',STR_PAD_LEFT);

$paramComercio = '0030070103910';
$paramProveedor = '05100817913101';
$paramIva = '004012'.$ivaDatafast;
$paramBase = '052012'.$base12DataFast;
$paramMonto = '053012'.$montoDataFast;

$customParams = '0081'.$paramComercio.$paramIva.$paramProveedor.$paramBase.$paramMonto;

$url = "https://test.oppwa.com/v1/checkouts";
$data = "".
    //"authentication.userId=".$userId.
    //"&authentication.password=".$authPass.
    "authentication.entityId=".$entityId.
    "&amount=".$montoTotal.
    "&currency=USD" .
    "&paymentType=DB".
    "&customer.givenName=Enrique".
    "&customer.middleName=".
    "&customer.surname=Corona".
    "&customer.ip=127.0.0.1".
    "&customer.merchantCustomerId=000000000001".
    "&customer.email=enrique_cr1990@hotmail.com".
    "&customer.identificationDocType=IDCARD".
    "&customer.identificationDocId=2467575099".
    "&customer.phone=2464682362".
    "&merchantTransactionId=7000000001".
    "&customParameters[".$mid."_".$tid."]=".$customParams.
    "&shipping.street1=una calle de ecuador".
    "&billing.street1=una calle de ecuador".
    "&shipping.country=EC".
    "&billing.country=EC".
    "&risk.parameters[USER_DATA2]= Pruebas locales integrar DataFast".
    "&testMode=EXTERNAL".
    "&cart.items[0].name=laptop".
    "&cart.items[0].description=una laptop".
    "&cart.items[0].price=5".
    "&cart.items[0].quantity=1".
    "&cart.items[1].name=impresora 3 en 1".
    "&cart.items[1].description=una impresora para la laptop".
    "&cart.items[1].price=3".
    "&cart.items[1].quantity=1"
;

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, 1);
//este campo en el header es necesario para el banco
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization:Bearer '.$token));
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);// this should be set to true in production
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$responseData = json_decode(curl_exec($ch),true);
if(curl_errno($ch)) {
    return curl_error($ch);
}
curl_close($ch);

$respuesta['status'] = false;
$respuesta['msg'] = 'No se pudo cargar los datos bancarios';
$respuesta['data_post_fields'] = $data;
$respuesta['json_response'] = json_encode($responseData);

if(isset($responseData['result']['code']) && $responseData['result']['code'] == "000.200.100"){
    $respuesta['status'] = true;
    $respuesta['msg'] = '';
    $respuesta['checkoutId'] = $responseData['id'];
}
echo json_encode($respuesta);exit;