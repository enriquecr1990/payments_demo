<?php

include "PayPal.php";

$paypal = new PayPal();
//generamos el access token para las operaciones
$responseToken = json_decode($paypal->getAccessToken());
//se crea primero el identificador de riesgo
$risk_process = $paypal->risk_transaction($responseToken->access_token);
//se crea la orden respectiva
$order = $paypal->createOrder($responseToken->access_token);

$data['access_token'] = $responseToken->access_token;
$data['order'] = json_decode($order);
$data['risk'] = json_decode($risk_process);
echo json_encode($data);exit;