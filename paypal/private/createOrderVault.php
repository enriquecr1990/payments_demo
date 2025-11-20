<?php
include "PayPal.php";

$paypal = new PayPal();
//generamos el access token para las operaciones, validar dado que esta se utiliza la version 2 y no 3 de paypal
$responseToken = json_decode($paypal->getAccessToken());
//se crea primero 
$vault = $paypal->vaultPayment($responseToken->access_token);
//se crea la orden respectiva

$data['access_token'] = $responseToken->access_token;
$data['vault'] = json_decode($vault);
echo json_encode($data);exit;